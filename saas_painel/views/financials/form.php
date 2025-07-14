<?php // views/financials/form.php ?>
<style>
  .form-container { padding: 2rem; }
  .card {
    background: #fff;
    border-radius: 8px;
    padding: 1.5rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    max-width: 700px;
    margin: auto;
    width: 100%;
  }
  .card-header h2 {
    color: #333;
    font-size: 1.8rem;
    border-bottom: 3px solid #e64a19;
    display: inline-block;
    padding-bottom: 0.5rem;
  }
  .form-group { margin-bottom: 1rem; }
  .form-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 0.3rem;
    color: #34495e;
  }
  .form-group input,
  .form-group select {
    width: 100%;
    padding: 0.6rem;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 0.95rem;
  }
  .form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
  }
  .btn-primary {
    background: #e64a19;
    color: #fff;
    padding: 0.7rem 1.5rem;
    border: none;
    border-radius: 4px;
    font-size: 1rem;
    cursor: pointer;
    transition: background 0.2s;
  }
  .btn-primary:hover {
    background: #d84315;
  }
  @media (max-width: 500px) {
    .card { padding: 1rem; }
    .form-row { grid-template-columns: 1fr; }
  }
</style>
<style>
    @media (max-width: 767.98px) {
    .topbar {
      height: 70px !important;
    }
  }
  </style>

<div class="form-container">
  <div class="card">
    <div class="card-header">
      <h2><?= isset($entry) ? 'Editar Entrada Financeira' : 'Nova Entrada Financeira' ?></h2>
    </div>
    <div class="card-body">
      <form method="post" action="?c=financial&a=<?= isset($entry) ? 'update' : 'store' ?>">
        <?php if(isset($entry)): ?>
          <input type="hidden" name="id" value="<?= $entry['id'] ?>">
        <?php endif; ?>

        <div class="form-row">
          <div class="form-group">
            <label for="company_id">Empresa</label>
            <select id="company_id" name="company_id" class="form-select" required>
              <?php foreach($companies as $c): ?>
                <option value="<?= $c['id'] ?>" <?= (isset($entry['company_id']) && $entry['company_id']==$c['id']) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($c['nome'], ENT_QUOTES) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="tipo">Tipo</label>
            <select id="tipo" name="tipo" class="form-select" required>
              <option value="receita" <?= (isset($entry['tipo']) && $entry['tipo']==='receita')?'selected':'' ?>>Receita</option>
              <option value="despesa" <?= (isset($entry['tipo']) && $entry['tipo']==='despesa')?'selected':'' ?>>Despesa</option>
            </select>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="valor">Valor (R$)</label>
            <input id="valor" type="number" name="valor" class="form-control" step="0.01" required
              value="<?= isset($entry['valor']) ? htmlspecialchars($entry['valor'], ENT_QUOTES) : '' ?>">
          </div>
          <div class="form-group">
            <label for="due_date">Vencimento</label>
            <input id="due_date" type="date" name="due_date" class="form-control" required
              value="<?= isset($entry['due_date']) ? htmlspecialchars($entry['due_date'], ENT_QUOTES) : date('Y-m-d') ?>">
          </div>
        </div>

        <div class="form-group">
          <label for="status">Status</label>
          <select id="status" name="status" class="form-select" required>
            <?php foreach($financialStatuses as $value => $label): ?>
              <option value="<?= $value ?>" <?= (isset($entry['status']) && $entry['status']===$value) ? 'selected' : '' ?>>
                <?= $label ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <button type="submit" class="btn-primary">Salvar Entrada</button>
      </form>
    </div>
  </div>
</div>
