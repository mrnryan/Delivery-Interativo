<?php
// Segurança de sessão
@session_set_cookie_params(['httponly' => true]);
@session_start();
@session_regenerate_id(true);

// **Limpa tenant anterior para que o login seja puro**
unset($_SESSION['company_id']);

require_once("conexao.php");

// 1) SSO via SaaS_Painel (entrada por ID)
$id_usu = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_STRING);

if ($id_usu) {
    // Aqui a query NÃO será filtrada por company_id, pois unset acima
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id LIMIT 1");
    $stmt->bindValue(':id', $id_usu, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // ✅ Verifica se está ativo
        if ($user['ativo'] !== 'Sim') {
            $_SESSION['msg'] = 'Seu Acesso foi desativado!';
            echo '<script>window.location="index.php";</script>';
            exit;
        }

        // Agora sim, seta o tenant correto na sessão
        $_SESSION['company_id']     = $user['company_id'];
        $_SESSION['nome']           = $user['nome'];
        $_SESSION['id']             = $user['id'];
        $_SESSION['nivel']          = $user['nivel'];
        $_SESSION['aut_token_SaL1P']= '25tNX1L1MSaL1P';

        $dest = $pagina ? htmlspecialchars($pagina, ENT_QUOTES) : 'index.php';
        echo "<script>window.location=\"{$dest}\"</script>";
        exit;
    }

    // Se falhar, limpa e volta ao login
    echo '<script>
            localStorage.removeItem("id_usu");
            window.location="index.php";
          </script>';
    exit;
}

// 2) Login tradicional (e-mail + senha)
$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_EMAIL);
$senha   = filter_input(INPUT_POST, 'senha',   FILTER_DEFAULT);
$salvar  = filter_input(INPUT_POST, 'salvar',  FILTER_SANITIZE_STRING);

if ($usuario && $senha) {
    // Query pura, sem filtro de tenant
    $stmt = $pdo->prepare("
        SELECT * 
          FROM usuarios 
         WHERE email = :email 
         LIMIT 1
    ");
    $stmt->bindValue(':email', $usuario);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($senha, $user['senha_crip'])) {
        // ✅ Verifica se está ativo
        if ($user['ativo'] !== 'Sim') {
            $_SESSION['msg'] = 'Seu Acesso foi desativado!';
            echo '<script>window.location="index.php";</script>';
            exit;
        }

        // Seta o tenant após autenticar
        $_SESSION['company_id']     = $user['company_id'];
        $_SESSION['nome']           = $user['nome'];
        $_SESSION['id']             = $user['id'];
        $_SESSION['nivel']          = $user['nivel'];
        $_SESSION['aut_token_SaL1P']= '25tNX1L1MSaL1P';

        // Armazena no browser se pedido
        if ($salvar === 'Sim') {
            echo "<script>
                    localStorage.setItem('email_usu', '". addslashes($usuario) ."');
                    localStorage.setItem('senha_usu',  '". addslashes($senha) ."');
                    localStorage.setItem('id_usu',      '". $user['id'] ."');
                  </script>";
        } else {
            echo "<script>
                    localStorage.removeItem('email_usu');
                    localStorage.removeItem('senha_usu');
                    localStorage.removeItem('id_usu');
                  </script>";
        }

        echo '<script>window.location="painel"</script>';
        exit;
    }
}

// Se chegar aqui, falha de autenticação
$_SESSION['msg'] = 'Dados incorretos!';
echo '<script>window.location="index.php";</script>';
exit;
?>
