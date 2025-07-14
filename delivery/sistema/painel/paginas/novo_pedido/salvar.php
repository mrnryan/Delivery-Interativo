<?php 
require_once("../../../conexao.php");
$tabela = 'abertura_mesa';

$id = $_POST['id']; // ID da mesa
$nome = $_POST['nome']; // Nome do cliente
$garcon = $_POST['garcon'];
$obs = $_POST['obs'];
$id_ab = $_POST['id_ab'];
$pessoas = $_POST['pessoas'];

// Buscar nome da mesa
$stmt = $pdo->prepare("SELECT nome FROM mesas WHERE id = :id");
$stmt->bindValue(':id', $id);
$stmt->execute();
$dados_mesa = $stmt->fetch(PDO::FETCH_ASSOC);
$nomee_mesa = $dados_mesa ? $dados_mesa['nome'] : '';

if ($id_ab == "") {
    // INSERÇÃO NOVA
    $query = $pdo->prepare("INSERT INTO $tabela 
        (mesa, nomee_mesa, cliente, data, horario_abertura, garcon, status, obs, pessoas) 
        VALUES 
        (:mesa, :nomee_mesa, :cliente, :data, :horario_abertura, :garcon, :status, :obs, :pessoas)");

    $query->bindValue(":mesa", $id);
    $query->bindValue(":nomee_mesa", $nomee_mesa);
    $query->bindValue(":cliente", $nome);
    $query->bindValue(":data", date("Y-m-d"));
    $query->bindValue(":horario_abertura", date("H:i:s"));
    $query->bindValue(":garcon", $garcon);
    $query->bindValue(":status", "Aberta");
    $query->bindValue(":obs", $obs);
    $query->bindValue(":pessoas", $pessoas);

    $query->execute();
} else {
    // EDIÇÃO
    $query = $pdo->prepare("UPDATE $tabela SET 
        cliente = :cliente, 
        garcon = :garcon, 
        obs = :obs, 
        pessoas = :pessoas 
        WHERE id = :id_ab");

    $query->bindValue(":cliente", $nome);
    $query->bindValue(":garcon", $garcon);
    $query->bindValue(":obs", $obs);
    $query->bindValue(":pessoas", $pessoas);
    $query->bindValue(":id_ab", $id_ab);

    $query->execute();
}

// Atualiza o status da mesa
$pdo->query("UPDATE mesas SET status = 'Aberta' WHERE id = '$id'");

echo 'Salvo com Sucesso';
