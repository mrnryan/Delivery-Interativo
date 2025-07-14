<?php
session_start();

// 0) Inclua sua conexão multi-tenant (ajuste o path se necessário)
require_once __DIR__ . '/../conexao.php';  // aqui $pdo e getTenantId()

$tabela    = 'usuarios';
$companyId = getTenantId();  // pega o company_id da sessão

// 1) Recebe e saneia todos os campos do formulário
$id_usuario = (int)($_POST['id_usuario'] ?? 0);
$nome       = trim($_POST['nome']        ?? '');
$telefone   = trim($_POST['telefone']    ?? '');
$data_nasc  = trim($_POST['data_nasc']   ?? '');
$cep        = trim($_POST['cep']         ?? '');
$endereco   = trim($_POST['endereco']    ?? '');
$numero     = trim($_POST['numero']      ?? '');
$complemento= trim($_POST['complemento'] ?? '');
$bairro     = trim($_POST['bairro']      ?? '');
$cidade     = trim($_POST['cidade']      ?? '');
$estado     = trim($_POST['estado']      ?? '');

// 2) Valida telefone duplicado dentro da mesma empresa
$stmt = $pdo->prepare("
  SELECT COUNT(*) 
    FROM {$tabela}
   WHERE telefone   = ?
     AND company_id = ?
     AND id <> ?
");
$stmt->execute([$telefone, $companyId, $id_usuario]);
if ($stmt->fetchColumn() > 0) {
    exit('Telefone já cadastrado!');
}

// 3) Recupera foto atual do usuário (dessa company)
$stmt = $pdo->prepare("
  SELECT foto 
    FROM {$tabela} 
   WHERE company_id = ? 
     AND id          = ?
");
$stmt->execute([$companyId, $id_usuario]);
$foto = $stmt->fetchColumn() ?: 'sem-foto.jpg';

// 4) Se houver novo upload, processa a imagem
if (!empty($_FILES['foto']['name'])) {
    $tmp     = $_FILES['foto']['tmp_name'];
    $ext     = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
    $allow   = ['png','jpg','jpeg','gif','webp'];
    if (!in_array($ext, $allow)) {
        exit('Extensão de imagem não permitida!');
    }

    // gera nome único e pasta destino
    $novoNome = time() . '-' . bin2hex(random_bytes(4)) . '.' . $ext;
    $destino  = __DIR__ . '/images/perfil/' . $novoNome;

    // apaga a anterior (se não for placeholder)
    if ($foto !== 'sem-foto.jpg' && file_exists(__DIR__ . '/images/perfil/' . $foto)) {
        unlink(__DIR__ . '/images/perfil/' . $foto);
    }

    if (!move_uploaded_file($tmp, $destino)) {
        exit('Falha ao enviar a imagem.');
    }
    $foto = $novoNome;
}

// 5) Monta o UPDATE com placeholders posicionais
$sql = "
  UPDATE {$tabela} SET
    nome        = ?,
    telefone    = ?,
    data_nasc   = ?,
    cep         = ?,
    endereco    = ?,
    numero      = ?,
    complemento = ?,
    bairro      = ?,
    cidade      = ?,
    estado      = ?,
    foto        = ?
  WHERE company_id = ? AND id = ?
";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $nome,
    $telefone,
    $data_nasc,
    $cep,
    $endereco,
    $numero,
    $complemento,
    $bairro,
    $cidade,
    $estado,
    $foto,
    $companyId,
    $id_usuario
]);

echo 'Editado com Sucesso';
exit;
