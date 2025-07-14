<?php
// definir fuso horário
date_default_timezone_set('America/Sao_Paulo');

// Inicia sessão apenas se não houver uma ativa
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Base URL do sistema
$url_sistema = "https://{$_SERVER['HTTP_HOST']}/";
if (strpos($url_sistema, 'localhost') !== false) {
    $url_sistema = "http://{$_SERVER['HTTP_HOST']}/delivery/";
}

/**
 * Retorna o ID do tenant (company_id) definido:
 *   1) Se houver GET['tenant'], usa esse valor e grava na sessão
 *   2) Senão, se já houver $_SESSION['company_id'], usa-o
 *   3) Caso contrário, retorna null
 *
 * @return int|null
 */
function getTenantId() {
    // 1) checa URL
    if (isset($_GET['tenant']) && is_numeric($_GET['tenant'])) {
        $t = (int) $_GET['tenant'];
        $_SESSION['company_id'] = $t;
        return $t;
    }
    // 2) checa sessão
    if (isset($_SESSION['company_id']) && is_numeric($_SESSION['company_id'])) {
        return (int) $_SESSION['company_id'];
    }
    // 3) nenhum definido
    return null;
}

/**
 * Extensão de PDO que injeta automaticamente company_id em consultas
 */
class TenantPDO extends PDO {
    protected $tenantId = null;

    public function setTenantId($id) {
        $this->tenantId = $id !== null ? (int) $id : null;
    }

    public function prepare($statement, $options = []) {
        if (is_string($statement)) {
            $statement = $this->injectTenant($statement);
        }
        $stmt = parent::prepare($statement, $options);
        if ($this->tenantId !== null && strpos($statement, ':cid') !== false) {
            $stmt->bindValue(':cid', $this->tenantId, PDO::PARAM_INT);
        }
        return $stmt;
    }

    public function query(...$args) {
        $sql = $args[0] ?? '';
        if (is_string($sql)) {
            $stmt = $this->prepare($sql);
            $stmt->execute();
            return $stmt;
        }
        return parent::query(...$args);
    }

    protected function injectTenant(string $sql): string
{
    // Se ainda não sabemos o tenant, não mexe na query
    if ($this->tenantId === null) {
        return $sql;
    }

    $hasSemicolon = substr(rtrim($sql), -1) === ';';
    $clean        = rtrim($sql, " \t\n\r\0\x0B;");

    /* ---------- INSERTS (no tenant → injeta coluna) ---------- */
    if (preg_match('/^\s*INSERT\s+INTO\s+`?\w+`?\s+SET\s+/i', $clean)) {
        return $clean . ', company_id = :cid' . ($hasSemicolon ? ';' : '');
    }
    if (preg_match('/^\s*INSERT\s+INTO\s+(`?\w+`?)\s*\(([^)]+)\)\s*VALUES\s*\(([^)]+)\)/i', $clean, $m)) {
        $cols = trim($m[2]) . ', company_id';
        $vals = trim($m[3]) . ', :cid';
        return "INSERT INTO {$m[1]} ({$cols}) VALUES ({$vals})" . ($hasSemicolon ? ';' : '');
    }

    /* ---------- Apenas SELECT / UPDATE / DELETE passam daqui ---------- */
    if (!preg_match('/^\s*(SELECT|UPDATE|DELETE)\b/i', $clean)) {
        return $clean . ($hasSemicolon ? ';' : '');
    }

    /* ---------- Tabelas realmente sem company_id ficam na exceção ---------- */
    if (preg_match('/\bFROM\s+(usuarios_permissoes)\b/i', $clean)) {
        return $clean . ($hasSemicolon ? ';' : '');
    }

    /* ---------- Se a query já filtra por company_id, deixa como está ---------- */
    if (stripos($clean, 'company_id') !== false) {
        return $clean . ($hasSemicolon ? ';' : '');
    }

    /* ---------- Injeta (company_id = :cid OR company_id = 1) ---------- */
    $cond = '(company_id = :cid OR company_id = 1)';

    if (stripos($clean, 'WHERE') !== false) {
        // já existe WHERE → coloca logo após
        $clean = preg_replace('/\bWHERE\b/i', "WHERE {$cond} AND", $clean, 1);
    } else {
        // não há WHERE → inserir antes de ORDER BY / GROUP BY / …, ou no fim
        $clauses   = ['ORDER BY','GROUP BY','HAVING','LIMIT'];
        $positions = [];
        foreach ($clauses as $cl) {
            $pos = stripos($clean, ' ' . $cl);
            if ($pos !== false) $positions[$pos] = $cl;
        }
        if ($positions) {
            ksort($positions);
            $first  = key($positions);
            $before = substr($clean, 0, $first);
            $after  = substr($clean, $first);
            $clean  = "{$before} WHERE {$cond} {$after}";
        } else {
            $clean .= " WHERE {$cond}";
        }
    }

    return $clean . ($hasSemicolon ? ';' : '');
}

}

// —— configurações de conexão ——
$servidor = 'localhost';
$banco    = 'painel-delivery-completo';
$usuario  = 'root';
$senha    = '';

try {
    $pdo = new TenantPDO(
        "mysql:host={$servidor};dbname={$banco};charset=utf8",
        $usuario,
        $senha,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
    // injeta tenant PELO PARÂMETRO DA URL ou sessão
    $pdo->setTenantId(getTenantId());
} catch (Exception $e) {
    echo 'Erro ao conectar ao banco de dados!<br>' . $e->getMessage();
    exit();
}

// … resto do seu código …


// configurações de conexão
$servidor = 'localhost';
$banco    = 'painel-delivery-completo';
$usuario  = 'root';
$senha    = '';

try {
    $pdo = new TenantPDO(
        "mysql:host={$servidor};dbname={$banco};charset=utf8",
        $usuario,
        $senha,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
    // injeta tenant apenas se estiver logado
    $pdo->setTenantId(getTenantId());
} catch (Exception $e) {
    echo 'Erro ao conectar ao banco de dados!<br>' . $e->getMessage();
    exit();
}

// Variáveis globais padrão
define('NOME_SISTEMA', 'Nome do Sistema');
define('EMAIL_SISTEMA', 'contato@hugocursos.com.br');
define('TELEFONE_SISTEMA', '(31)97527-5084');
define('INSTAGRAM_SISTEMA', 'portalhugocursos');

// 1) Carrega config do tenant atual
//    TenantPDO já injeta automaticamente "WHERE company_id = X"
$cfg = $pdo
    ->query("SELECT * FROM config") // já vira: SELECT * FROM config WHERE company_id = :cid
    ->fetch(PDO::FETCH_ASSOC);

// 2) Se vier vazio, usa defaults; caso contrário, preenche as variáveis
if (!$cfg) {
    // Nenhum registro encontrado? Define defaults hard-coded
    $cfg = [
      'nome'               => 'Nome do Sistema',
      'email'              => 'contato@seudominio.com',
      'telefone'           => '(84) 99165-7076',
      'instagram'          => '@inforprime_',
      'logo'               => 'foto-painel-full1.png',
      'icone'              => 'icone1.png',
      'previsao_entrega'   => 60,
      'horario_abertura'   => '08:00:00',
      'horario_fechamento' => '18:00:00',
      'ativo'              => 'Sim', 
      'mostrar_preloader'  => 'sim', 
      'tempo_atualizar'    => 30,
      'abertura_caixa'     => 'Sim',
      
      // … adicione os demais defaults aqui …
    ];
}

// 3) Agora preencha suas variáveis/constantes como antes:
$nome_sistema         = $cfg['nome'];
$email_sistema        = $cfg['email'];
$telefone_sistema     = $cfg['telefone'];
$instagram_sistema    = $cfg['instagram'];
$logo_sistema         = $cfg['logo'];
$icone_sistema        = $cfg['icone'];
$logo_rel             = $cfg['logo_rel']   ?? '';
$logo_assinatura      = $cfg['logo_assinatura'] ?? 'assinatura.jpg';
$previsao_entrega     = $cfg['previsao_entrega'];
$horario_abertura     = $cfg['horario_abertura'];
$horario_fechamento   = $cfg['horario_fechamento'];
$ativo_sistema        = $cfg['ativo'];
$ocultar_mobile       = $cfg['ocultar_mobile'] ?? 'Não';
$mostrar_preloader    = $cfg['mostrar_preloader'];
$tempo_atualizar      = $cfg['tempo_atualizar']  ?? 30;
$abertura_caixa       = $cfg['abertura_caixa']   ?? 'Sim';
$mostrar_aberto     = $cfg['mostrar_aberto'] ?? 'Sim';
$endereco_sistema   = $cfg['endereco']       ?? '';
// dias para apagar (se for nulo no banco, você pode tratar como “infinitos”)
$dias_apagar = isset($cfg['dias_apagar'])
    ? (int) $cfg['dias_apagar']
    : PHP_INT_MAX;   // ou algum default que faça sentido para você
$banner_rotativo = $cfg['banner_rotativo'] ?? 'Sim';
// ————— Todas as chaves de config que você usa nas suas views —————

$status_estabelecimento  = $cfg['status_estabelecimento']   ?? 'Aberto';
$texto_fechamento        = $cfg['texto_fechamento']         ?? '';
$texto_fechamento_horario= $cfg['texto_fechamento_horario'] ?? 'Estamos fechados no momento';
$tel_whats               = $cfg['api_whatsapp']             ?? '';
$api_whatsapp            = $cfg['api_whatsapp']             ?? 'menuia';
$token_whatsapp          = $cfg['token_whatsapp']           ?? '';
$instancia_whatsapp      = $cfg['instancia_whatsapp']       ?? '';
$entrega_distancia       = $cfg['entrega_distancia']        ?? 'Não';
$chave_api_maps          = $cfg['chave_api_maps']           ?? 'AIzaSyDh2ZVIcqEeBpI7LFyV2U1m63KYjNBkd9A ';
$distancia_entrega_km    = $cfg['distancia_entrega_km']     ?? 0;
$valor_km                = $cfg['valor_km']                 ?? 0;
$latitude_rest           = $cfg['latitude_rest']            ?? 0;
$longitude_rest          = $cfg['longitude_rest']           ?? 0;
$abrir_comprovante       = $cfg['abrir_comprovante']        ?? 'Não';
$pedido_minimo           = $cfg['pedido_minimo']            ?? 0.00;
$mensagem_auto           = $cfg['mensagem_auto']            ?? '';
$banner_rotativo         = $cfg['banner_rotativo']          ?? 'Sim';
$mostrar_aberto          = $cfg['mostrar_aberto']           ?? 'Sim';
$dados_pagamento         = $cfg['dados_pagamento']          ?? '';
$api_merc                = $cfg['api_merc']                 ?? 'APP_USR-5155455831525633-110710-8ff24066b7152213c6ebd7eaf92b3628-30518896';
$mais_sabores            = $cfg['mais_sabores']             ?? '';
$mostrar_acessos         = $cfg['mostrar_acessos']          ?? 'Sim';
$impressao_automatica = $cfg['impressao_automatica'] ?? 'Sim';
$data_cobranca        = $cfg['data_cobranca'] ?? '';
$comissao_garcon = isset($cfg['comissao_garcon']) 
    ? (float) $cfg['comissao_garcon'] 
    : 0.0;
$couvert = isset($cfg['couvert']) 
    ? (float) $cfg['couvert'] 
    : 0.0;
$tipo_chave           = $cfg['tipo_chave']       ?? '';
$chave_pix            = $cfg['dados_pagamento']   ?? '';
$tipo_rel             = $cfg['tipo_rel ']         ?? '';
$cnpj_sistema           = $cfg['cnpj']   ?? '';
$entrar_automatico      = $cfg['entrar_automatico']      ?? 'Não';
$assinatura_recibo      = $cfg['assinatura_recibo']      ?? 'Não';
$marca_dagua            = $cfg['marca_dagua']            ?? 'Sim';
// — Comissões e encargos de atraso — 
$multa_atraso    = isset($cfg['multa_atraso'])    ? (float)$cfg['multa_atraso']    : 0.00;
$juros_atraso    = isset($cfg['juros_atraso'])    ? (float)$cfg['juros_atraso']    : 0.00;

// … e por aí vai para todas as colunas que você precisa …

// Pronto! Daqui em diante, em qualquer parte do painel você
// usa essas variáveis e nunca mais cai no undefined array key.