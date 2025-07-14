<?php
require __DIR__ . '/../app/helpers.php';  // ou o caminho correto para getPDO()
$pdo = getPDO();

// expira assinaturas vencidas
$pdo->exec("
  UPDATE companies
    SET status = 'expired'
  WHERE subscription_end < CURDATE()
    AND status != 'expired'
");
