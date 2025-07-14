<?php // views/dashboard.php ?>
<main class="p-4 flex-fill overflow-auto">
  <!-- Banner de alerta para empresas expiradas -->
  <?php if (!empty($expiredAmt) && $expiredAmt > 0): ?>
    <div class="alert alert-danger d-flex justify-content-between align-items-center">
      <div>
        Existem <strong><?= $expiredAmt ?></strong> empresa(s) com assinatura expirada.
      </div>
      <a href="?c=company&a=index" class="btn btn-sm btn-light">
        Ver detalhes
      </a>
    </div>
  <?php endif; ?>

  <!-- Grid responsivo: 1 coluna em XS, 2 em SM, 4 em LG -->
  <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-3">
    <!-- Total Empresas -->
    <div class="col">
      <div class="card h-100 shadow-sm">
        <div class="card-body text-center">
          <i class="fas fa-building fa-2x text-primary mb-2"></i>
          <h6 class="card-subtitle mb-1">Total Empresas</h6>
          <h2 class="card-title"><?= $totalCompanies ?></h2>
          <a href="?c=company&a=create" class="btn btn-sm btn-primary mt-2">
            <i class="fas fa-plus"></i> Nova
          </a>
        </div>
      </div>
    </div>

    <!-- Empresas Expiradas -->
    <div class="col">
      <div class="card h-100 shadow-sm">
        <div class="card-body text-center">
          <i class="fas fa-exclamation-triangle fa-2x text-danger mb-2"></i>
          <h6 class="card-subtitle mb-1">Empresas Expiradas</h6>
          <h2 class="card-title"><?= $expiredAmt ?></h2>
          <a href="?c=company&a=index" class="btn btn-sm btn-outline-danger mt-2">
            <i class="fas fa-eye"></i> Ver
          </a>
        </div>
      </div>
    </div>

    <!-- Receber Vencidas -->
    <div class="col">
      <div class="card h-100 shadow-sm">
        <div class="card-body text-center">
          <i class="fas fa-clock fa-2x text-warning mb-2"></i>
          <h6 class="card-subtitle mb-1">Receber Vencidas</h6>
          <h2 class="card-title">R$ <?= number_format($toReceive,2,',','.') ?></h2>
          <a href="?c=financial&a=index" class="btn btn-sm btn-warning mt-2">
            <i class="fas fa-eye"></i> Ver
          </a>
        </div>
      </div>
    </div>

    <!-- Vendas este mês -->
    <div class="col">
      <div class="card h-100 shadow-sm">
        <div class="card-body text-center">
          <i class="fas fa-chart-line fa-2x text-success mb-2"></i>
          <h6 class="card-subtitle mb-1">Vendas este mês</h6>
          <h2 class="card-title">R$ <?= number_format($sales,2,',','.') ?></h2>
          <a href="?c=financial&a=create" class="btn btn-sm btn-success mt-2">
            <i class="fas fa-plus"></i> Nova
          </a>
        </div>
      </div>
    </div>
  </div>
</main>
