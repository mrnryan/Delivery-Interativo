<?php
class NoteController {
    public function __construct() {
        if (!isset($_SESSION['user'])) redirect('?c=auth&a=showLogin');
    }
    public function index() {
    $pdo = getPDO();
    $search = trim($_GET['search'] ?? '');

    if ($search !== '') {
        $stmt = $pdo->prepare("
          SELECT n.id, n.user_id, u.nome AS user_name,
                 n.texto, n.created_at
          FROM notes n
          JOIN users u ON n.user_id = u.id
          WHERE n.texto LIKE ? OR u.nome LIKE ?
          ORDER BY n.created_at DESC
        ");
        $stmt->execute(["%{$search}%","%{$search}%"]);
        $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $notes = $pdo->query("
          SELECT n.id, n.user_id, u.nome AS user_name,
                 n.texto, n.created_at
          FROM notes n
          JOIN users u ON n.user_id = u.id
          ORDER BY n.created_at DESC
        ")->fetchAll(PDO::FETCH_ASSOC);
    }

    view('notes/index', [
      'notes'  => $notes,
      'search' => $search
    ]);
}
    public function create() {
        view('notes/form', ['note' => null]);
    }
    public function store() {
        $pdo = getPDO();
        $stmt = $pdo->prepare("INSERT INTO notes (user_id, texto, created_at) VALUES (?, ?, NOW())");
        $stmt->execute([$_SESSION['user']['id'], $_POST['texto']]);
        redirect('?c=note&a=index');
    }
    public function delete() {
        $pdo = getPDO();
        $stmt = $pdo->prepare("DELETE FROM notes WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        redirect('?c=note&a=index');
    }
}
