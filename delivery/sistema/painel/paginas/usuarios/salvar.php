<?php 
$tabela = 'usuarios';
require_once("../../../conexao.php");

$nome         = $_POST['nome'];
$email        = $_POST['email'];
$telefone     = $_POST['telefone'];
$nivel        = $_POST['nivel'];
$endereco     = $_POST['endereco'];
$id           = $_POST['id'];
$numero       = @$_POST['numero'];
$bairro       = @$_POST['bairro'];
$cidade       = @$_POST['cidade'];
$estado       = @$_POST['estado'];
$cep          = @$_POST['cep'];
$data_nasc    = @$_POST['data_nasc'];
$cpf          = @$_POST['cpf'];
$pix          = @$_POST['pix'];
$tipo_chave   = @$_POST['tipo_chave'];
$complemento  = @$_POST['complemento'];
$senha_input  = trim($_POST['senha'] ?? '');

// Validação de CPF
if ($cpf != "") {
	require_once("../../validar_cpf.php");
}

// Determina senha e criptografia
$senha_final = $senha_input !== '' ? $senha_input : '1020';
$senha_crip = password_hash($senha_final, PASSWORD_DEFAULT);

// Valida e-mail
$query = $pdo->query("SELECT * from $tabela where email = '$email'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if(@count($res) > 0 and $id != $id_reg){
	echo 'Email já Cadastrado!';
	exit();
}

// Valida telefone
$query = $pdo->query("SELECT * from $tabela where telefone = '$telefone'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if(@count($res) > 0 and $id != $id_reg){
	echo 'Telefone já Cadastrado!';
	exit();
}

// Data de nascimento
$nasc = ($data_nasc != "") ? ", data_nasc = '$data_nasc'" : '';

if($id == "") {
	// Novo usuário
	$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, email = :email, senha = :senha, senha_crip = :senha_crip, nivel = '$nivel', ativo = 'Sim', foto = 'sem-foto.jpg', telefone = :telefone, data = curDate(), endereco = :endereco, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, cep = :cep $nasc, cpf = :cpf, pix = :pix, acessar_painel = 'Sim', tipo_chave = '$tipo_chave', complemento = :complemento");

	// WhatsApp
	if($api_whatsapp != 'Não' and $telefone != ''){
		$telefone_envio = '55' . preg_replace('/[ ()-]+/', '', $telefone);
		$mensagem_whatsapp = '*'.$nome_sistema.'*%0A';
		$mensagem_whatsapp .= '_Olá '.$nome.' Você foi Cadastrado no Sistema!!_ %0A';
		$mensagem_whatsapp .= '*Email:* '.$email.' %0A';
		$mensagem_whatsapp .= '*Senha:* '.$senha_final.' %0A';
		$mensagem_whatsapp .= '*Url Acesso:* %0A'.$url_sistema.' %0A%0A';
		$mensagem_whatsapp .= '_Ao entrar no sistema, troque sua senha!_';
		require('../../apis/texto.php');
	}

	// E-mail
	if($email != ''){
		$url_logo = $url_sistema.'img/logo.png';
		$destinatario = $email;
		$assunto = 'Cadastrado no sistema '. $nome_sistema;
		$mensagem_email = 'Olá '.$nome.' você foi cadastrado no sistema <br>';
		$mensagem_email .= '<b>Usuário</b>: '.$email.'<br>';
		$mensagem_email .= '<b>Senha: </b>'.$senha_final.'<br><br>';
		$mensagem_email .= 'Url Acesso: <br><a href="'.$url_sistema.'">'.$url_sistema. '</a><br><br>';
		$mensagem_email .= '<i>Ao entrar no sistema, troque sua senha!</i><br><br>';
		$mensagem_email .= "<img src='".$url_logo."' width='200px'>";
		require('../../apis/disparar_email.php');
	}

} else {
	// Atualização
	if ($senha_input !== '') {
		// Atualiza também a senha
		$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, email = :email, senha = :senha, senha_crip = :senha_crip, nivel = '$nivel', telefone = :telefone, endereco = :endereco, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, cep = :cep $nasc, cpf = :cpf, pix = :pix, acessar_painel = 'Sim', tipo_chave = '$tipo_chave', complemento = :complemento where id = '$id'");
	} else {
		// Atualiza sem senha
		$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, email = :email, nivel = '$nivel', telefone = :telefone, endereco = :endereco, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, cep = :cep $nasc, cpf = :cpf, pix = :pix, acessar_painel = 'Sim', tipo_chave = '$tipo_chave', complemento = :complemento where id = '$id'");
	}
}

// Bind comum
$query->bindValue(":nome", $nome);
$query->bindValue(":email", $email);
$query->bindValue(":telefone", $telefone);
$query->bindValue(":endereco", $endereco);
$query->bindValue(":numero", $numero);
$query->bindValue(":bairro", $bairro);
$query->bindValue(":cidade", $cidade);
$query->bindValue(":estado", $estado);
$query->bindValue(":cep", $cep);
$query->bindValue(":cpf", $cpf);
$query->bindValue(":pix", $pix);
$query->bindValue(":complemento", $complemento);

// Bind da senha (se for novo ou atualização com senha)
if($id == "" || $senha_input !== '') {
	$query->bindValue(":senha", $senha_final);
	$query->bindValue(":senha_crip", $senha_crip);
}

$query->execute();

echo 'Salvo com Sucesso';
?>
