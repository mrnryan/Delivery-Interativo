<?php
// views/companies/index.php

// Mapeamento para traduzir status
$companyStatuses = [
  'active'  => 'Ativo',
  'expired' => 'Expirada'
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

  <!-- Cabeçalho com busca e botão: empilha no mobile, horizontal no desktop -->
  <div class="
      d-flex
      flex-column flex-md-row
      justify-content-between
      align-items-start align-items-md-center
      mb-3
    ">
    <h4 class="mb-2 mb-md-0">Empresas Cadastradas:</h4>

    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center">
      <form method="get" action="?c=company&a=index"
            class="d-flex align-items-center me-md-2 mb-2 mb-md-0">
        <input type="hidden" name="c" value="company">
        <input type="hidden" name="a" value="index">

        <input
          type="search"
          name="search"
          class="form-control form-control-sm me-2"
          placeholder="Buscar empresas..."
          value="<?= htmlspecialchars($search ?? '') ?>"
        >
        <select
          name="status"
          class="form-select form-select-sm"
          onchange="this.form.submit()"
        >
          <option value="">Todos</option>
          <?php foreach($companyStatuses as $key => $label): ?>
            <option value="<?= $key ?>"
              <?= (isset($status) && $status === $key) ? 'selected' : '' ?>>
              <?= $label ?>
            </option>
          <?php endforeach; ?>
        </select>
      </form>

      <a href="?c=company&a=create"
         class="btn btn-primary btn-sm flex-shrink-0">
        <i class="fas fa-plus"></i> Nova Empresa
      </a>
    </div>
  </div>

  <!-- Tabela responsiva com scroll horizontal apenas no contêiner -->
  <div class="table-responsive">
    <table class="table table-hover table-bordered mb-0">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Trial (dias)</th>
          <th>Início</th>
          <th>Fim</th>
          <th>Status</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($companies as $c): ?>
          <tr class="<?= $c['status'] === 'expired' ? 'table-danger' : '' ?>">
            <td><?= $c['id'] ?></td>
            <td>
              <?= htmlspecialchars($c['nome']) ?>
              <?php if ($c['status'] === 'expired'): ?>
                <span class="badge bg-danger ms-1">Expirada</span>
              <?php endif; ?>
            </td>
            <td><?= $c['trial_days'] ?> dias</td>
            <td><?= $c['subscription_start'] ?></td>
            <td><?= $c['subscription_end'] ?></td>
            <td><?= $companyStatuses[$c['status']] ?></td>
            <td>
              <div class="btn-group" role="group">
                <a href="?c=company&a=show&id=<?= $c['id'] ?>" class="btn btn-sm btn-info" title="Ver">
                  <i class="fas fa-eye"></i> Ver
                </a>
                <a href="?c=company&a=edit&id=<?= $c['id'] ?>" class="btn btn-sm btn-outline-secondary" title="Editar">
                  <i class="fas fa-edit"></i> Editar
                </a>
                <a
                  href="?c=company&a=delete&id=<?= $c['id'] ?>"
                  class="btn btn-sm btn-outline-danger"
                  onclick="return confirm('Deseja realmente excluir esta empresa?');"
                  title="Excluir"
                >
                  <i class="fas fa-trash"></i> Excuir 
                </a>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</main>
