<?php
// validate_credentials.php
require 'conexao.php';  // seu PDO de conexão ao delivery_interativo

header('Content-Type: application/json');

// Recebe via POST
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

// Busca usuário na tabela delivery_user
$stmt = $pdo->prepare("SELECT password FROM delivery_user WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Verifica senha e retorna JSON
if ($user && password_verify($senha, $user['password'])) {
    echo json_encode(['valid' => true]);
} else {
    echo json_encode(['valid' => false]);
}
