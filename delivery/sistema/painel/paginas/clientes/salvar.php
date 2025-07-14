<?php
$tabela = 'clientes';
require_once("../../../conexao.php");

@session_start();
$id_usuario = @$_SESSION['id'];


$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$endereco = $_POST['endereco'];
$data_nasc = $_POST['data_nasc'];
$cpf = $_POST['cpf'];
$numero = $_POST['numero'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$cep = $_POST['cep'];
$id = $_POST['id'];
$complemento = $_POST['complemento'];


if($cpf != "") {
    require_once("../../validar_cpf.php");
}


//validacao email
if($email != "") {
    $query = $pdo->query("SELECT * from $tabela where email = '$email'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $id_reg = @$res[0]['id'];
    if(@count($res) > 0 and $id != $id_reg) {
        echo 'Email já Cadastrado!';
        exit();
    }
}


//validacao telefone
if($telefone != "") {
    $query = $pdo->query("SELECT * from $tabela where telefone = '$telefone'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $id_reg = @$res[0]['id'];
    if(@count($res) > 0 and $id != $id_reg) {
        echo 'Telefone já Cadastrado!';
        exit();
    }
}

if($data_nasc == "") {
    $nasc = '';
} else {
    $nasc = " ,data_nasc = '$data_nasc'";

}

if($id == "") {
    $query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, email = :email, telefone = :telefone, data_cad = curDate(), endereco = :endereco, cpf = :cpf $nasc, usuario = '$id_usuario', numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, cep = :cep, complemento = :complemento");

} else {


    $query = $pdo->prepare("UPDATE $tabela SET nome = :nome, email = :email, telefone = :telefone, endereco = :endereco, cpf = :cpf $nasc , numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, cep = :cep, complemento = :complemento where id = '$id'");
}


$query->bindValue(":nome", "$nome");
$query->bindValue(":email", "$email");
$query->bindValue(":telefone", "$telefone");
$query->bindValue(":endereco", "$endereco");
$query->bindValue(":cpf", "$cpf");
$query->bindValue(":numero", "$numero");
$query->bindValue(":bairro", "$bairro");
$query->bindValue(":cidade", "$cidade");
$query->bindValue(":estado", "$estado");
$query->bindValue(":cep", "$cep");
$query->bindValue(":complemento", "$complemento");
$query->execute();

echo 'Salvo com Sucesso';


?>
