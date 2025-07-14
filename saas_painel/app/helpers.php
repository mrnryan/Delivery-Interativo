<?php
function getPDO() {
    $config = require __DIR__ . '/../config/config.php';
    $dsn = "mysql:host={$config['db']['host']};dbname={$config['db']['dbname']};charset=utf8mb4";
    return new PDO($dsn, $config['db']['user'], $config['db']['pass'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
}
function redirect($url) {
    header("Location: $url");
    exit;
}
function view($path, $data = [], $layout = true) {
    extract($data);

    // Se layout estiver desativado, carrega só a view
    if (!$layout) {
        require __DIR__ . "/../views/$path.php";
        return;
    }

    // Senão mantém o comportamento antigo
    require __DIR__ . '/../views/header.php';
    require __DIR__ . "/../views/$path.php";
    require __DIR__ . '/../views/footer.php';
}
