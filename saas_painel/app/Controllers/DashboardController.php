<?php
// app/Controllers/DashboardController.php

class DashboardController {
    public function __construct() {
        if (!isset($_SESSION['user'])) {
            redirect('?c=auth&a=showLogin');
        }
    }

    public function index() {
        $pdo = getPDO();
        $excludedId = 1;

        // Total de empresas cadastradas (sem a id=1)
        $stmt = $pdo->prepare("
            SELECT COUNT(*) 
            FROM companies 
            WHERE id <> :exclude
        ");
        $stmt->execute(['exclude' => $excludedId]);
        $totalCompanies = (int) $stmt->fetchColumn();

        // Quantidade de empresas expiradas (sem a id=1)
        $stmt = $pdo->prepare("
            SELECT COUNT(*) 
            FROM companies 
            WHERE subscription_end < CURDATE()
              AND id <> :exclude
        ");
        $stmt->execute(['exclude' => $excludedId]);
        $expiredAmt = (int) $stmt->fetchColumn();

        // Soma das receitas vencidas (a receber), excluindo company_id = 1
        $stmt = $pdo->prepare("
            SELECT IFNULL(SUM(valor),0)
            FROM financials
            WHERE tipo      = 'receita'
              AND status    = 'overdue'
              AND company_id<> :exclude
        ");
        $stmt->execute(['exclude' => $excludedId]);
        $toReceive = (float) $stmt->fetchColumn();

        // Soma das assinaturas iniciadas no mês atual (empresas sem id=1)
        $stmt = $pdo->prepare("
            SELECT IFNULL(SUM(subscription_price),0)
            FROM companies
            WHERE MONTH(subscription_start) = MONTH(CURDATE())
              AND YEAR(subscription_start)  = YEAR(CURDATE())
              AND id <> :exclude
        ");
        $stmt->execute(['exclude' => $excludedId]);
        $sales = (float) $stmt->fetchColumn();

        // Última anotação registrada (mantém igual)
        $stmt = $pdo->query("
            SELECT texto
            FROM notes
            ORDER BY created_at DESC
            LIMIT 1
        ");
        $someNoteText = $stmt->fetchColumn() ?: 'Nenhuma anotação.';

        view('dashboard', compact(
            'totalCompanies',
            'expiredAmt',
            'toReceive',
            'sales',
            'someNoteText'
        ));
    }
}
