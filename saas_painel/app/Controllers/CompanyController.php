<?php
// app/Controllers/CompanyController.php

class CompanyController {
    public function __construct() {
        if (!isset($_SESSION['user'])) {
            redirect('?c=auth&a=showLogin');
        }
    }

    public function index() {
    $pdo    = getPDO();
    // expira tudo que já venceu
    $pdo->exec("
        UPDATE companies
            SET status = 'expired'
        WHERE subscription_end < CURDATE()
            AND status != 'expired'
    ");

    $search = trim($_GET['search'] ?? '');
    $status = trim($_GET['status'] ?? '');

    // Condições: sempre excluir id = 1
    $conds  = ["id != ?"];
    $params = [1];

    // Filtro de busca por nome
    if ($search !== '') {
        $conds[]  = "nome LIKE ?";
        $params[] = "%{$search}%";
    }

    // Filtro de status
    if ($status !== '') {
        $conds[]  = "status = ?";
        $params[] = $status;
    }

    // Monta SQL final
    $sql = "SELECT * FROM companies";
    if ($conds) {
        $sql .= " WHERE " . implode(" AND ", $conds);
    }

    // Executa e busca resultados
    $stmt      = $pdo->prepare($sql);
    $stmt->execute($params);
    $companies = $stmt->fetchAll(PDO::FETCH_ASSOC);

    view('companies/index', [
        'companies' => $companies,
        'search'    => $search,
        'status'    => $status
    ]);
}


    public function create() {
        view('companies/form', ['company' => null]);
    }

    public function store() {
    $pdo = getPDO();

    // ===== 1) Monta slug único =====
    $baseSlug = strtolower(preg_replace('/\s+/', '-', $_POST['nome']));
    $slug     = $baseSlug;
    $i        = 1;
    $check    = $pdo->prepare("SELECT COUNT(*) FROM companies WHERE slug = ?");
    while (true) {
        $check->execute([$slug]);
        if ($check->fetchColumn() == 0) break;
        $slug = "{$baseSlug}-" . $i++;
    }

    // ===== 2) Dados da assinatura =====
    $trial   = (int) $_POST['trial_days'];
    $start   = $_POST['subscription_start'];
    $end     = $_POST['subscription_end'];
    $semNum  = !empty($_POST['sem_numero']) ? 1 : 0;
    $numero  = $semNum ? null : $_POST['numero'];
    $price   = (float) $_POST['subscription_price'];
    $status  = $_POST['status'];

    // ===== 3) Insere na tabela companies =====
    $stmt = $pdo->prepare("
        INSERT INTO companies
          (nome, slug, admin_password,
           trial_days, subscription_start, subscription_end, status,
           whatsapp, cidade, cep, rua, numero, sem_numero, documento, subscription_price)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([
        $_POST['nome'],
        $slug,
        $_POST['admin_password'],  // plain-text no companies
        $trial,
        $start,
        $end,
        $status,
        $_POST['whatsapp']   ?? null,
        $_POST['cidade']     ?? null,
        $_POST['cep']        ?? null,
        $_POST['rua']        ?? null,
        $numero,
        $semNum,
        $_POST['documento']  ?? null,
        $price
    ]);
    $companyId = $pdo->lastInsertId();

    // ===== 4) Insere configuração padrão (config) =====
    // defaults - sem dias_apagar
    $defaults = [
      'company_id'             => $companyId,
      'nome'                   => 'Nome do Sistema',
      'email'                  => $_POST['admin_email'],
      'telefone'               => $_POST['telefone_sistema'] ?? $_POST['whatsapp'] ?? null,
      'endereco'               => '',
      'instagram'              => '',
      'logo'                   => 'foto-painel-full1.png',
      'icone'                  => 'icone1.png',
      'logo_rel'               => 'foto-painel-full1.jpg',
      'ativo'                  => 'Sim',
      'multa_atraso'           => '0.00',
      'juros_atraso'           => '0.00',
      'marca_dagua'            => 'Sim',
      'assinatura_recibo'      => 'Sim',
      'impressao_automatica'   => 'Não',
      'cnpj'                   => null,
      'entrar_automatico'      => 'Não',
      'mostrar_preloader'      => 'Sim',
      'ocultar_mobile'         => null,
      'api_whatsapp'           => 'menuia',
      'token_whatsapp'         => null,
      'instancia_whatsapp'     => null,
      'dados_pagamento'        => null,
      'telefone_fixo'          => null,
      'tipo_rel'               => 'PDF',
      'tipo_miniatura'         => 'Cores',
      'previsao_entrega'       => 60,
      'horario_abertura'       => '18:00:00',
      'horario_fechamento'     => '00:00:00',
      'texto_fechamento_horario'=> null,
      'status_estabelecimento'=> 'Aberto',
      'texto_fechamento'       => null,
      'tempo_atualizar'        => 30,
      'tipo_chave'             => 'CNPJ',
      'banner_rotativo'        => 'Sim',
      'pedido_minimo'          => 0.00,
      'mostrar_aberto'         => 'Sim',
      'entrega_distancia'      => 'Não',
      'chave_api_maps'         => 'AIzaSyDh2ZVIcqEeBpI7LFyV2U1m63KYjNBkd9A',
      'latitude_rest'          => -6.481806735136624,
      'longitude_rest'         => -35.43337938289553,
      'distancia_entrega_km'   => 50,
      'valor_km'               => 1,
      'mais_sabores'           => 'Média',
      'abrir_comprovante'      => 'Não',
      'mostrar_acessos'        => 'Não',
      'fonte_comprovante'      => null,
      'mensagem_auto'          => null,
      'data_cobranca'          => date('Y-m-d'),
      'api_merc'               => 'APP_USR-5155455831525633-110710-8ff24066b7152213c6ebd7eaf92b3628-30518896',
      'couvert'                => null,
      'comissao_garcon'        => null,
      'abertura_caixa'         => 'Sim',
    ];

    // monta colunas + placeholder para dias_apagar
    $cols = array_keys($defaults);
    $cols[] = 'dias_apagar';
    $phs  = array_map(fn($c)=>":{$c}", array_keys($defaults));
    $phs[] = "DATEDIFF(:subscription_end, :subscription_start) + :trial";

    $sql = sprintf(
      "INSERT INTO config (%s) VALUES (%s)",
      implode(',', $cols),
      implode(',', $phs)
    );
    $stmtCfg = $pdo->prepare($sql);

    // bind neutral
    $params = [];
    foreach ($defaults as $col=>$val) {
      $params[":{$col}"] = $val;
    }
    // bind extras para dias_apagar
    $params[':subscription_start'] = $start;
    $params[':subscription_end']   = $end;
    $params[':trial']              = $trial;

    $stmtCfg->execute($params);

    // ===== 5) Upload da foto do administrador =====
    $fotoNome = 'sem-foto.jpg';
    if (!empty($_FILES['foto']['name']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $ext      = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $fotoNome = time() . '-' . bin2hex(random_bytes(5)) . ".{$ext}";
        move_uploaded_file(
          $_FILES['foto']['tmp_name'],
          __DIR__ . '/../../public/uploads/usuarios/' . $fotoNome
        );
    }

    // ===== 6) Deriva nível e status do usuário =====
    if ($status === 'active') {
      $nivel         = 'Administrador';
      $ativoUser     = 'Sim';
      $acessarPainel = 'Sim';
    } else {
      $nivel         = null;
      $ativoUser     = 'Não';
      $acessarPainel = 'Não';
    }

    // ===== 7) Insere em delivery_users =====
    $pdo->prepare("
      INSERT INTO delivery_users
        (company_id, name, email, password)
      VALUES (?, ?, ?, ?)
    ")->execute([
      $companyId,
      $_POST['nome'],
      $_POST['admin_email'],
      password_hash($_POST['admin_password'], PASSWORD_BCRYPT)
    ]);

    // ===== 8) Insere em usuarios =====
    $pdo->prepare("
      INSERT INTO usuarios
        (company_id, nome, email, senha_crip, nivel, ativo, data, id_ref, acessar_painel, foto)
      VALUES (?, ?, ?, ?, ?, ?, CURDATE(), ?, ?, ?)
    ")->execute([
      $companyId,
      $_POST['nome'],
      $_POST['admin_email'],
      password_hash($_POST['admin_password'], PASSWORD_BCRYPT),
      $nivel,
      $ativoUser,
      $companyId,      // id_ref
      $acessarPainel,
      $fotoNome
    ]);

    // ===== 9) Redireciona de volta =====
    redirect('?c=company&a=index');
}


    public function edit() {
        $pdo = getPDO();
        $stmt = $pdo->prepare("SELECT * FROM companies WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $company = $stmt->fetch(PDO::FETCH_ASSOC);

        // Load delivery_users email
        $du = $pdo->prepare("SELECT email FROM delivery_users WHERE company_id = ?");
        $du->execute([$_GET['id']]);
        $company['admin_email'] = $du->fetchColumn();

        // Load usuarios fields
        $u = $pdo->prepare("SELECT foto, nivel, ativo, acessar_painel FROM usuarios WHERE id_ref = ?");
        $u->execute([$_GET['id']]);
        $aux = $u->fetch(PDO::FETCH_ASSOC);
        if ($aux) {
            $company['foto']           = $aux['foto'];
            $company['nivel']          = $aux['nivel'];
            $company['ativo_user']     = $aux['ativo'];
            $company['acessar_painel'] = $aux['acessar_painel'];
        }

        view('companies/form', ['company' => $company]);
    }

    public function show() {
        $pdo = getPDO();
        $stmt = $pdo->prepare("SELECT * FROM companies WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $company = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$company) redirect('?c=company&a=index');

        $du = $pdo->prepare("SELECT email FROM delivery_users WHERE company_id = ?");
        $du->execute([$_GET['id']]);
        $company['admin_email'] = $du->fetchColumn();

        $u = $pdo->prepare("SELECT foto, nivel, ativo, acessar_painel FROM usuarios WHERE id_ref = ?");
        $u->execute([$_GET['id']]);
        $aux = $u->fetch(PDO::FETCH_ASSOC);
        if ($aux) {
            $company['foto']           = $aux['foto'];
            $company['nivel']          = $aux['nivel'];
            $company['ativo_user']     = $aux['ativo'];
            $company['acessar_painel'] = $aux['acessar_painel'];
        }

        view('companies/show', ['company' => $company]);
    }

    public function update() {
        $pdo = getPDO();

        // Update companies
        $semNum            = !empty($_POST['sem_numero']) ? 1 : 0;
        $numero            = $semNum ? null : $_POST['numero'];
        $subscriptionPrice = (float) $_POST['subscription_price'];
        $status            = $_POST['status'];

        $stmt = $pdo->prepare("
        UPDATE companies SET
            nome              = ?,
            admin_password    = ?,   -- aqui
            trial_days        = ?,
            subscription_start= ?,
            subscription_end  = ?,
            status            = ?,
            whatsapp          = ?,
            cidade            = ?,
            cep               = ?,
            rua               = ?,
            numero            = ?,
            sem_numero        = ?,
            documento         = ?,
            subscription_price= ?
        WHERE id = ?
        ");
        $stmt->execute([
        $_POST['nome'],
        $_POST['admin_password'], // plain-text
        $_POST['trial_days'],
        $_POST['subscription_start'],
        $_POST['subscription_end'],
        $_POST['status'],
        $_POST['whatsapp']     ?? null,
        $_POST['cidade']       ?? null,
        $_POST['cep']          ?? null,
        $_POST['rua']          ?? null,
        $numero,
        $semNum,
        $_POST['documento']    ?? null,
        $subscriptionPrice,
        $_POST['id']
        ]);

        // Update delivery_users
        $fields = ["email = ?"];
        $params = [
            $_POST['admin_email']
        ];
        if (!empty($_POST['admin_password'])) {
            $fields[]  = "password = ?";
            $params[] = password_hash($_POST['admin_password'], PASSWORD_BCRYPT);
        }
        $params[] = $_POST['id'];
        $pdo->prepare("UPDATE delivery_users SET " . implode(", ", $fields) . " WHERE company_id = ?")
            ->execute($params);

        // Handle photo upload
        // $newFoto = null;
        // if (!empty($_FILES['foto']['name']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        //     $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        //     $newFoto = time() . '-' . bin2hex(random_bytes(5)) . '.' . $ext;
        //     move_uploaded_file(
        //         $_FILES['foto']['tmp_name'],
        //         __DIR__ . '/../../public/uploads/usuarios/' . $newFoto
        //     );
        // }

        // Derive user fields
        if ($status === 'active') {
            $ativoUser       = 'Sim';
            $acessarPainel   = 'Sim';
        } else {
            $ativoUser       = 'Não';
            $acessarPainel   = 'Não';
        }

        // --- UP Config recalcula dias_apagar e atualiza email/telefone em config ---
        // pega os dados do form
        $companyId         = (int) $_POST['id'];
        $newEmail          = $_POST['admin_email']     ?? '';
        $newPhone          = $_POST['telefone_sistema']?? '';
        $trialDays         = (int) $_POST['trial_days'];
        $subscriptionStart = $_POST['subscription_start'];
        $subscriptionEnd   = $_POST['subscription_end'];

        // prepara o SQL
        $sql = "
        UPDATE config
            SET email       = :email,
                telefone    = :telefone,
                dias_apagar = DATEDIFF(:end, :start) + :trial
        WHERE company_id = :cid
        ";
        $stmtCfg = $pdo->prepare($sql);

        // vincula valores
        $stmtCfg->execute([
        ':email'   => $newEmail,
        ':telefone'=> $newPhone,
        ':end'     => $subscriptionEnd,
        ':start'   => $subscriptionStart,
        ':trial'   => $trialDays,
        ':cid'     => $companyId,
        ]);

        // --- fim do update de config ---

        // Update usuarios
        // Montar os campos dinâmicos para o usuário principal (id_ref)
        $fields_main = [
            "email = ?",
            "ativo = ?",
            "acessar_painel = ?"
        ];
        $params_main = [
            $_POST['admin_email'],
            $ativoUser,
            $acessarPainel
        ];

        if (!empty($_POST['admin_password'])) {
            $fields_main[]  = "senha_crip = ?";
            $params_main[] = password_hash($_POST['admin_password'], PASSWORD_BCRYPT);
        }

        // Atualiza o usuário principal
        $params_main[] = $_POST['id'];
        $sql_main = "UPDATE usuarios SET " . implode(", ", $fields_main) . " WHERE id_ref = ?";
        $pdo->prepare($sql_main)->execute($params_main);


        // Agora monta os campos para os demais usuários (company_id)
        // Atenção: não inclui o email aqui!
        $fields_company = [
            "ativo = ?",
            "acessar_painel = ?"
        ];
        $params_company = [
            $ativoUser,
            $acessarPainel
        ];

        if (!empty($_POST['admin_password'])) {
            $fields_company[]  = "senha_crip = ?";
            $params_company[] = password_hash($_POST['admin_password'], PASSWORD_BCRYPT);
        }

        // Atualiza os demais usuários vinculados ao company_id
        $params_company[] = $_POST['id'];
        $sql_company = "UPDATE usuarios SET " . implode(", ", $fields_company) . " WHERE company_id = ?";
        $pdo->prepare($sql_company)->execute($params_company);

        // Redireciona
        redirect('?c=company&a=index');

    }

    public function delete() {
        $pdo = getPDO();
        // delete all related users for this tenant
        $pdo->prepare("DELETE FROM config WHERE company_id = ?")->execute([$_GET['id']]);
        $pdo->prepare("DELETE FROM categorias WHERE company_id = ?")->execute([$_GET['id']]);
        $pdo->prepare("DELETE FROM produtos WHERE company_id = ?")->execute([$_GET['id']]);
        $pdo->prepare("DELETE FROM bordas  WHERE company_id = ?")->execute([$_GET['id']]);
        $pdo->prepare("DELETE FROM grades  WHERE company_id = ?")->execute([$_GET['id']]);
        $pdo->prepare("DELETE FROM itens_grade WHERE company_id = ?")->execute([$_GET['id']]);
        $pdo->prepare("DELETE FROM variacoes_cat WHERE company_id = ?")->execute([$_GET['id']]);
        $pdo->prepare("DELETE FROM variacoes WHERE company_id = ?")->execute([$_GET['id']]);
        $pdo->prepare("DELETE FROM usuarios WHERE company_id = ?")->execute([$_GET['id']]);
        $pdo->prepare("DELETE FROM clientes WHERE company_id = ?")->execute([$_GET['id']]);
        $pdo->prepare("DELETE FROM caixas WHERE company_id = ?")->execute([$_GET['id']]);
        $pdo->prepare("DELETE FROM anotacoes WHERE company_id = ?")->execute([$_GET['id']]);
        $pdo->prepare("DELETE FROM abertura_mesa WHERE company_id = ?")->execute([$_GET['id']]);
        $pdo->prepare("DELETE FROM carrinho WHERE company_id = ?")->execute([$_GET['id']]);
        $pdo->prepare("DELETE FROM cupons WHERE company_id = ?")->execute([$_GET['id']]);
        $pdo->prepare("DELETE FROM entradas WHERE company_id = ?")->execute([$_GET['id']]);
        $pdo->prepare("DELETE FROM fornecedores WHERE company_id = ?")->execute([$_GET['id']]);
        $pdo->prepare("DELETE FROM mesas WHERE company_id = ?")->execute([$_GET['id']]);
        $pdo->prepare("DELETE FROM pagar WHERE company_id = ?")->execute([$_GET['id']]);
        $pdo->prepare("DELETE FROM receber WHERE company_id = ?")->execute([$_GET['id']]);
        $pdo->prepare("DELETE FROM saidas WHERE company_id = ?")->execute([$_GET['id']]);
        $pdo->prepare("DELETE FROM sangrias WHERE company_id = ?")->execute([$_GET['id']]);
        $pdo->prepare("DELETE FROM tarefas WHERE company_id = ?")->execute([$_GET['id']]);
        $pdo->prepare("DELETE FROM vendas WHERE company_id = ?")->execute([$_GET['id']]);
        $pdo->prepare("DELETE FROM delivery_users WHERE company_id = ?")->execute([$_GET['id']]);
        // delete company itself
        $pdo->prepare("DELETE FROM companies WHERE id = ?")->execute([$_GET['id']]);
        // após remover tudo do banco:
        unset($_SESSION['company_id']);

        redirect('?c=company&a=index');
    }
}
?>
