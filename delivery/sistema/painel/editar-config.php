<?php
require_once("../conexao.php");
$cid = getTenantId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 📝 Coleta de campos do formulário
    $nome = $_POST['nome_sistema'] ?? '';
    $email = $_POST['email_sistema'] ?? '';
    $telefone = $_POST['telefone_sistema'] ?? '';
    $endereco = $_POST['endereco_sistema'] ?? '';
    $instagram = $_POST['instagram_sistema'] ?? '';
    $multa_atraso = str_replace(['%','.'], ['', '.'], $_POST['multa_atraso'] ?? '0');
    $juros_atraso = str_replace(['%','.'], ['', '.'], $_POST['juros_atraso'] ?? '0');
    $marca_dagua = $_POST['marca_dagua'] ?? 'Não';
    $assinatura_recibo = $_POST['assinatura_recibo'] ?? 'Não';
    $impressao_automatica = $_POST['impressao_automatica'] ?? 'Não';
    $cnpj_sistema = $_POST['cnpj_sistema'] ?? '';
    $entrar_automatico = $_POST['entrar_automatico'] ?? 'Não';
    $mostrar_preloader = $_POST['mostrar_preloader'] ?? 'Não';
    $ocultar_mobile = $_POST['ocultar_mobile'] ?? 'Não';
    $api_whatsapp = $_POST['api_whatsapp'] ?? '';
    $token_whatsapp = $_POST['token_whatsapp'] ?? '';
    $instancia_whatsapp = $_POST['instancia_whatsapp'] ?? '';
    $dados_pagamento = $_POST['dados_pagamento'] ?? '';
    $telefone_fixo = $_POST['telefone_fixo'] ?? '';
    $tipo_rel = $_POST['tipo_rel'] ?? 'PDF';
    $tipo_miniatura = $_POST['tipo_miniatura'] ?? 'Cores';
    $previsao_entrega = (int)($_POST['previsao_entrega'] ?? 0);
    $horario_abertura = $_POST['horario_abertura'] ?? '';
    $horario_fechamento = $_POST['horario_fechamento'] ?? '';
    $texto_fechamento_horario = $_POST['texto_fechamento_horario'] ?? '';
    $texto_fechamento = $_POST['texto_fechamento'] ?? '';
    $status_estabelecimento = $_POST['status_estabelecimento'] ?? 'Aberto';
    $tempo_atualizar = (int)($_POST['tempo_atualizar'] ?? 0);
    $tipo_chave = $_POST['tipo_chave'] ?? '';
    $dias_apagar = (int)($_POST['dias_apagar'] ?? 0);
    $banner_rotativo = $_POST['banner_rotativo'] ?? 'Não';
    $pedido_minimo = (float)($_POST['pedido_minimo'] ?? 0);
    $mostrar_aberto = $_POST['mostrar_aberto'] ?? 'Não';
    $entrega_distancia = (float)($_POST['entrega_distancia'] ?? 0);
    $chave_api_maps = $_POST['chave_api_maps'] ?? '';
    $latitude_rest = $_POST['latitude_rest'] ?? '';
    $longitude_rest = $_POST['longitude_rest'] ?? '';
    $distancia_entrega_km = (float)($_POST['distancia_entrega_km'] ?? 0);
    $valor_km = (float)($_POST['valor_km'] ?? 0);
    $abrir_comprovante = $_POST['abrir_comprovante'] ?? 'Não';
    $fonte_comprovante = $_POST['fonte_comprovante'] ?? '';
    $mensagem_auto = $_POST['mensagem_auto'] ?? '';
    $api_merc = $_POST['api_merc'] ?? '';
    $comissao_garcon = (float)($_POST['comissao_garcon'] ?? 0);
    $couvert = (float)($_POST['couvert'] ?? 0);
    $mostrar_acessos = $_POST['mostrar_acessos'] ?? 'Não';
    $abertura_caixa = $_POST['abertura_caixa'] ?? 'Sim';
    $mais_sabores = $_POST['mais_sabores'] ?? 'Não';

    // 🧾 Atualiza todos os campos na config
    $sql = "UPDATE config SET
        nome = :nome,
        email = :email,
        telefone = :telefone,
        endereco = :endereco,
        instagram = :instagram,
        multa_atraso = :multa_atraso,
        juros_atraso = :juros_atraso,
        marca_dagua = :marca_dagua,
        assinatura_recibo = :assinatura_recibo,
        impressao_automatica = :impressao_automatica,
        cnpj = :cnpj,
        entrar_automatico = :entrar_automatico,
        mostrar_preloader = :mostrar_preloader,
        ocultar_mobile = :ocultar_mobile,
        api_whatsapp = :api_whatsapp,
        token_whatsapp = :token_whatsapp,
        instancia_whatsapp = :instancia_whatsapp,
        dados_pagamento = :dados_pagamento,
        telefone_fixo = :telefone_fixo,
        tipo_rel = :tipo_rel,
        tipo_miniatura = :tipo_miniatura,
        previsao_entrega = :previsao_entrega,
        horario_abertura = :horario_abertura,
        horario_fechamento = :horario_fechamento,
        texto_fechamento_horario = :texto_fechamento_horario,
        texto_fechamento = :texto_fechamento,
        status_estabelecimento = :status_estabelecimento,
        tempo_atualizar = :tempo_atualizar,
        tipo_chave = :tipo_chave,
        dias_apagar = :dias_apagar,
        banner_rotativo = :banner_rotativo,
        pedido_minimo = :pedido_minimo,
        mostrar_aberto = :mostrar_aberto,
        entrega_distancia = :entrega_distancia,
        chave_api_maps = :chave_api_maps,
        latitude_rest = :latitude_rest,
        longitude_rest = :longitude_rest,
        distancia_entrega_km = :distancia_entrega_km,
        valor_km = :valor_km,
        abrir_comprovante = :abrir_comprovante,
        fonte_comprovante = :fonte_comprovante,
        mensagem_auto = :mensagem_auto,
        api_merc = :api_merc,
        comissao_garcon = :comissao_garcon,
        couvert = :couvert,
        mostrar_acessos = :mostrar_acessos,
        abertura_caixa = :abertura_caixa,
        mais_sabores = :mais_sabores
    WHERE company_id = :cid";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':telefone', $telefone);
    $stmt->bindValue(':endereco', $endereco);
    $stmt->bindValue(':instagram', $instagram);
    $stmt->bindValue(':multa_atraso', $multa_atraso);
    $stmt->bindValue(':juros_atraso', $juros_atraso);
    $stmt->bindValue(':marca_dagua', $marca_dagua);
    $stmt->bindValue(':assinatura_recibo', $assinatura_recibo);
    $stmt->bindValue(':impressao_automatica', $impressao_automatica);
    $stmt->bindValue(':cnpj', $cnpj_sistema);
    $stmt->bindValue(':entrar_automatico', $entrar_automatico);
    $stmt->bindValue(':mostrar_preloader', $mostrar_preloader);
    $stmt->bindValue(':ocultar_mobile', $ocultar_mobile);
    $stmt->bindValue(':api_whatsapp', $api_whatsapp);
    $stmt->bindValue(':token_whatsapp', $token_whatsapp);
    $stmt->bindValue(':instancia_whatsapp', $instancia_whatsapp);
    $stmt->bindValue(':dados_pagamento', $dados_pagamento);
    $stmt->bindValue(':telefone_fixo', $telefone_fixo);
    $stmt->bindValue(':tipo_rel', $tipo_rel);
    $stmt->bindValue(':tipo_miniatura', $tipo_miniatura);
    $stmt->bindValue(':previsao_entrega', $previsao_entrega);
    $stmt->bindValue(':horario_abertura', $horario_abertura);
    $stmt->bindValue(':horario_fechamento', $horario_fechamento);
    $stmt->bindValue(':texto_fechamento_horario', $texto_fechamento_horario);
    $stmt->bindValue(':texto_fechamento', $texto_fechamento);
    $stmt->bindValue(':status_estabelecimento', $status_estabelecimento);
    $stmt->bindValue(':tempo_atualizar', $tempo_atualizar);
    $stmt->bindValue(':tipo_chave', $tipo_chave);
    $stmt->bindValue(':dias_apagar', $dias_apagar);
    $stmt->bindValue(':banner_rotativo', $banner_rotativo);
    $stmt->bindValue(':pedido_minimo', $pedido_minimo);
    $stmt->bindValue(':mostrar_aberto', $mostrar_aberto);
    $stmt->bindValue(':entrega_distancia', $entrega_distancia);
    $stmt->bindValue(':chave_api_maps', $chave_api_maps);
    $stmt->bindValue(':latitude_rest', $latitude_rest);
    $stmt->bindValue(':longitude_rest', $longitude_rest);
    $stmt->bindValue(':distancia_entrega_km', $distancia_entrega_km);
    $stmt->bindValue(':valor_km', $valor_km);
    $stmt->bindValue(':abrir_comprovante', $abrir_comprovante);
    $stmt->bindValue(':fonte_comprovante', $fonte_comprovante);
    $stmt->bindValue(':mensagem_auto', $mensagem_auto);
    $stmt->bindValue(':api_merc', $api_merc);
    $stmt->bindValue(':comissao_garcon', $comissao_garcon);
    $stmt->bindValue(':couvert', $couvert);
    $stmt->bindValue(':mostrar_acessos', $mostrar_acessos);
    $stmt->bindValue(':abertura_caixa', $abertura_caixa);
    $stmt->bindValue(':mais_sabores', $mais_sabores);
    $stmt->bindValue(':cid', $cid, PDO::PARAM_INT);
    $stmt->execute();

   // 📁 Upload das imagens
$imgDir = '../img/';

if (!empty($_FILES['foto-logo']['name'])) {
    $ext = pathinfo($_FILES['foto-logo']['name'], PATHINFO_EXTENSION);
    $logo_nome = "logo_{$cid}_" . uniqid() . '.' . $ext;
    move_uploaded_file($_FILES['foto-logo']['tmp_name'], $imgDir . $logo_nome);

    // Atualiza no banco
    $pdo->prepare("UPDATE config SET logo = ? WHERE company_id = ?")->execute([$logo_nome, $cid]);
}

if (!empty($_FILES['foto-logo-rel']['name'])) {
    $ext = pathinfo($_FILES['foto-logo-rel']['name'], PATHINFO_EXTENSION);
    $logo_rel_nome = "logo_rel_{$cid}_" . uniqid() . '.' . $ext;
    move_uploaded_file($_FILES['foto-logo-rel']['tmp_name'], $imgDir . $logo_rel_nome);

    // Atualiza no banco
    $pdo->prepare("UPDATE config SET logo_rel = ? WHERE company_id = ?")->execute([$logo_rel_nome, $cid]);
}

// NOVO: ASSINATURA
    if (!empty($_FILES['foto-assinatura']['name'])) {
        $ext = pathinfo($_FILES['foto-assinatura']['name'], PATHINFO_EXTENSION);
        $assinatura_nome = "logo_assinatura_{$cid}_" . uniqid() . '.' . $ext;
        move_uploaded_file($_FILES['foto-assinatura']['tmp_name'], $imgDir . $assinatura_nome);
        $pdo->prepare("UPDATE config SET logo_assinatura = ? WHERE company_id = ?")->execute([$assinatura_nome, $cid]);
    }


    echo 'Editado com Sucesso';
    exit;
}
