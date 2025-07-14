<?php
// app/Controllers/UserController.php

class UserController {
    public function __construct() {
        // redireciona se não estiver logado
        if (!isset($_SESSION['user'])) {
            redirect('?c=auth&a=showLogin');
        }
    }

    // lista todos – aberto para master e admin
    public function index() {
    $pdo = getPDO();
    $search = trim($_GET['search'] ?? '');

    if ($search !== '') {
        $stmt = $pdo->prepare("SELECT id, nome, email, role FROM users WHERE nome LIKE ? OR email LIKE ?");
        $stmt->execute(["%{$search}%","%{$search}%"]);
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $users = $pdo->query("SELECT id, nome, email, role FROM users")->fetchAll(PDO::FETCH_ASSOC);
    }

    view('users/index', [
      'users'  => $users,
      'search' => $search
    ]);
}

    // form de criação – somente master
    public function create() {
        if ($_SESSION['user']['role'] !== 'master') {
            redirect('?c=user&a=index');
        }
        view('users/form', ['user' => null]);
    }

    // grava novo – somente master
    public function store() {
        if ($_SESSION['user']['role'] !== 'master') {
            redirect('?c=user&a=index');
        }
        $pdo = getPDO();
        $stmt = $pdo->prepare("
            INSERT INTO users (nome, email, password, role)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([
            $_POST['nome'],
            $_POST['email'],
            password_hash($_POST['password'], PASSWORD_BCRYPT),
            $_POST['role']
        ]);
        redirect('?c=user&a=index');
    }

    // form de edição – somente master
    public function edit() {
        if ($_SESSION['user']['role'] !== 'master') {
            redirect('?c=user&a=index');
        }
        $pdo = getPDO();
        $stmt = $pdo->prepare("SELECT id, nome, email, role FROM users WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        view('users/form', ['user' => $user]);
    }

    // grava edição – somente master
    public function update() {
        if ($_SESSION['user']['role'] !== 'master') {
            redirect('?c=user&a=index');
        }
        $pdo = getPDO();
        $sql = "UPDATE users SET nome = ?, email = ?, role = ?";
        $params = [$_POST['nome'], $_POST['email'], $_POST['role']];
        if (!empty($_POST['password'])) {
            $sql .= ", password = ?";
            $params[] = password_hash($_POST['password'], PASSWORD_BCRYPT);
        }
        $sql .= " WHERE id = ?";
        $params[] = $_POST['id'];
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        redirect('?c=user&a=index');
    }

    // exclusão – somente master
    public function delete() {
        if ($_SESSION['user']['role'] !== 'master') {
            redirect('?c=user&a=index');
        }
        $pdo = getPDO();
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        redirect('?c=user&a=index');
    }
}
