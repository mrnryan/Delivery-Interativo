<?php 
$tabela = 'fornecedores';
require_once("../../../../conexao.php");

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$endereco = $_POST['endereco'];
$chave_pix = $_POST['pix'];
$id = $_POST['id'];

//validacao email
$query = $pdo->query("SELECT * from $tabela where email = '$email'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if(@count($res) > 0 and $id != $id_reg){
	echo 'Email já Cadastrado!';
	exit();
}

//validacao telefone
$query = $pdo->query("SELECT * from $tabela where telefone = '$telefone'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if(@count($res) > 0 and $id != $id_reg){
	echo 'Telefone já Cadastrado!';
	exit();
}



if($id == ""){
$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, email = :email,  telefone = :telefone, data = curDate(), endereco = :endereco, pix = :chave_pix ");
	
}else{
$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, email = :email,  telefone = :telefone, data = curDate(), endereco = :endereco, pix = :chave_pix where id = '$id'");
}
$query->bindValue(":nome", "$nome");
$query->bindValue(":email", "$email");
$query->bindValue(":telefone", "$telefone");
$query->bindValue(":endereco", "$endereco");
$query->bindValue(":chave_pix", "$chave_pix");
$query->execute();

echo 'Salvo com Sucesso';
 ?>