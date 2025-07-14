<?php
// views/financials/index.php

// Mapeamento para traduzir status financeiro
$financialStatuses = [
  'paid'    => 'Pago',
  'open'    => 'Em aberto',
  'overdue' => 'Vencido'
];
?>
<style>
    @media (max-width: 767.98px) {
    .topbar {
      height: 50px !important;
    }
  }
  </style>
<main class="p-4 flex-fill overflow-auto">
  <!-- Cabeçalho responsivo igual ao de empresas -->
  <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
    <h4 class="mb-2 mb-md-0">Finanças:</h4>
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center">
      <form method="get" action="?c=financial&a=index" class="d-flex align-items-center me-md-2 mb-2 mb-md-0">
        <input type="hidden" name="c" value="financial">
        <input type="hidden" name="a" value="index">

        <input
          type="search"
          name="search"
          class="form-control form-control-sm me-2"
          placeholder="Buscar lançamentos..."
          value="<?= htmlspecialchars($search ?? '', ENT_QUOTES) ?>"
        >

        <select
          name="status"
          class="form-select form-select-sm"
          onchange="this.form.submit()"
        >
          <option value="">Todos</option>
          <?php foreach ($financialStatuses as $key => $label): ?>
            <option value="<?= $key ?>" <?= (isset($status) && $status === $key) ? 'selected' : '' ?>>
              <?= $label ?>
            </option>
          <?php endforeach; ?>
        </select>
      </form>
      <a href="?c=financial&a=create" class="btn btn-success btn-sm flex-shrink-0">
        <i class="fas fa-plus"></i> Nova Entrada
      </a>
    </div>
  </div>

  <!-- Tabela responsiva com scroll interno -->
  <div class="table-responsive">
    <table class="table table-hover table-bordered mb-0">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Empresa</th>
          <th>Tipo</th>
          <th>Valor</th>
          <th>Vencimento</th>
          <th>Status</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($entries as $e): ?>
        <tr class="<?= $e['status'] === 'overdue' ? 'table-danger' : '' ?>">
          <td><?= $e['id'] ?></td>
          <td><?= htmlspecialchars($e['company_name'], ENT_QUOTES) ?></td>
          <td><?= ucfirst($e['tipo']) ?></td>
          <td>R$ <?= number_format($e['valor'], 2, ',', '.') ?></td>
          <td><?= $e['due_date'] ?></td>
          <td><?= $financialStatuses[$e['status']] ?></td>
          <td>
            <a
              href="?c=financial&a=delete&id=<?= $e['id'] ?>"
              class="btn btn-sm btn-outline-danger"
              onclick="return confirm('Deseja realmente excluir este lançamento financeiro?');"
            >
              <i class="fas fa-trash"></i> Excluir
            </a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</main>
