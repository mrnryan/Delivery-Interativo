<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['tenant'])) {
    $_SESSION['tenant_id'] = (int) $_GET['tenant'];
}

$tenant_id = $_SESSION['tenant_id'] ?? null;

if (!$tenant_id) {
    die('Tenant não encontrado!');
}

define('BASE_URL_STATIC', '/delivery/');
define('TENANT_ID', $tenant_id);
define('BASE_URL_TENANT', "/delivery/" . TENANT_ID);

// Inicia output buffering para interceptar HTML
ob_start(function($buffer) {
    $base = BASE_URL_TENANT;

    // Corrige href="index" ou href="index.php"
    $buffer = preg_replace_callback(
        '/<a\s+([^>]*?)href="(?:\.\/)?index(?:\.php)?"/i',
        function ($matches) use ($base) {
            return '<a ' . $matches[1] . 'href="' . $base . '"';
        },
        $buffer
    );

    // Corrige todos os hrefs relativos
    $buffer = preg_replace_callback(
        '/<a\s+[^>]*href="(?!https?:\/\/|mailto:|tel:|#|\/|'.preg_quote($base, '/').')([^"]+)"/i',
        function ($matches) use ($base) {
            return str_replace($matches[1], $base . '/' . $matches[1], $matches[0]);
        },
        $buffer
    );

    return $buffer;
});
?>
