<?php
class FinancialController {
    public function __construct() {
        if (!isset($_SESSION['user'])) redirect('?c=auth&a=showLogin');
    }
    // dentro da classe FinancialController

public function index() {
    $pdo     = getPDO();
    $search  = trim($_GET['search'] ?? '');
    $status  = trim($_GET['status'] ?? '');

    // Monta base da query
    $sql    = "
      SELECT f.id, f.company_id, c.nome AS company_name,
             f.tipo, f.valor, f.due_date, f.status
      FROM financials f
      JOIN companies c ON f.company_id = c.id
    ";
    $conds  = [];
    $params = [];

    // Busca por texto (empresa ou tipo)
    if ($search !== '') {
        $conds[]  = "(c.nome LIKE ? OR f.tipo LIKE ?)";
        $params[] = "%{$search}%";
        $params[] = "%{$search}%";
    }

    // Filtra por status
    if ($status !== '') {
        $conds[]  = "f.status = ?";
        $params[] = $status;
    }

    if ($conds) {
        $sql .= " WHERE " . implode(" AND ", $conds);
    }

    $sql .= " ORDER BY f.due_date ASC";

    $stmt    = $pdo->prepare($sql);
    $stmt->execute($params);
    $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);

    view('financials/index', [
        'entries' => $entries,
        'search'  => $search,
        'status'  => $status
    ]);
}

    public function create() {
        $pdo = getPDO();
        $companies = $pdo->query("SELECT id, nome FROM companies")->fetchAll(PDO::FETCH_ASSOC);
        view('financials/form', ['entry' => null, 'companies' => $companies]);
    }
    public function store() {
        $pdo = getPDO();
        $stmt = $pdo->prepare("INSERT INTO financials (company_id, tipo, valor, due_date, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$_POST['company_id'], $_POST['tipo'], $_POST['valor'], $_POST['due_date'], $_POST['status']]);
        redirect('?c=financial&a=index');
    }
    public function delete() {
        $pdo = getPDO();
        $stmt = $pdo->prepare("DELETE FROM financials WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        redirect('?c=financial&a=index');
    }
}
