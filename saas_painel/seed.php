<?php
require __DIR__ . '/app/helpers.php';
$pdo = getPDO();
$hash = password_hash('admin123', PASSWORD_BCRYPT);
$stmt = $pdo->prepare("
  INSERT IGNORE INTO users (nome, email, password, role)
  VALUES (?, ?, ?, ?)
");
$stmt->execute([
  'Master',           // nome
  'master@exemplo.com', // e-mail de login
  $hash,              // senha hashed
  'master'            // role
]);
echo "✅ Usuário master criado: master@exemplo.com / admin123\n";
