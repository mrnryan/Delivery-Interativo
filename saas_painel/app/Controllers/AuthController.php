<?php
class AuthController {
    public function showLogin() {
        view('auth/login', [], false);
    }
    public function login() {
        $pdo = getPDO();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$_POST['email']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($_POST['password'], $user['password'])) {
            $_SESSION['user'] = $user;
            redirect('?c=dashboard&a=index');
        } else {
            $error = 'Credenciais inválidas';
            view('auth/login', ['error' => $error]);
        }
    }
    public function logout() {
        session_destroy();
        redirect('?c=auth&a=showLogin');
    }
}
