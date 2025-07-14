<?php // views/companies/form.php ?>
<style>
  .form-container { padding: 2rem; }
  .card {
    background: #fff;
    border-radius: 8px;
    padding: 1.5rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    max-width: 800px;
    margin: auto;
    width: 100%;
  }
  .card-header h2 {
    color: #2c3e50;
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
  /* Mantém duas colunas até 500px, depois uma coluna */
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
  small { color: #7f8c8d; }

  @media (max-width: 500px) {
    .card { padding: 1rem; }
    .form-row {
      grid-template-columns: 1fr;
    }
  }
</style>
<style>
    @media (max-width: 767.98px) {
    .topbar {
      height: 150px !important;
    }
  }
  </style>
<div class="form-container">
  <div class="card">
    <div class="card-header">
      <h2><?= $company ? 'Editar' : 'Nova' ?> Empresa</h2>
    </div>
    <div class="card-body">
      <form method="post" action="?c=company&a=<?= $company ? 'update' : 'store' ?>" enctype="multipart/form-data">
        <?php if($company): ?>
          <input type="hidden" name="id" value="<?= $company['id'] ?>">
        <?php endif; ?>

        <div class="form-group">
          <label for="nome">Nome da Empresa</label>
          <input id="nome" type="text" name="nome" value="<?= htmlspecialchars($company['nome'] ?? '', ENT_QUOTES) ?>" required>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="admin_email">Email (Delivery)</label>
            <input id="admin_email" type="email" name="admin_email" value="<?= htmlspecialchars($company['admin_email'] ?? '', ENT_QUOTES) ?>" required>
          </div>
          <div class="form-group">
            <label for="admin_password">Senha (Delivery)</label>
            <input id="admin_password" type="password" name="admin_password" <?= $company ? '' : 'required' ?>>
            <?php if($company): ?><small>Deixe em branco para manter a atual</small><?php endif; ?>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="whatsapp">WhatsApp</label>
            <input id="whatsapp" type="text" name="whatsapp" value="<?= htmlspecialchars($company['whatsapp'] ?? '', ENT_QUOTES) ?>" placeholder="(11) 91234-5678">
          </div>
          <div class="form-group">
            <label for="documento">CPF/CNPJ</label>
            <input id="documento" type="text" name="documento" value="<?= htmlspecialchars($company['documento'] ?? '', ENT_QUOTES) ?>">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="cidade">Cidade</label>
            <input id="cidade" type="text" name="cidade" value="<?= htmlspecialchars($company['cidade'] ?? '', ENT_QUOTES) ?>">
          </div>
          <div class="form-group">
            <label for="cep">CEP</label>
            <input id="cep" type="text" name="cep" value="<?= htmlspecialchars($company['cep'] ?? '', ENT_QUOTES) ?>" placeholder="12345-678">
          </div>
        </div>

        <div class="form-group">
          <label for="rua">Rua</label>
          <input id="rua" type="text" name="rua" value="<?= htmlspecialchars($company['rua'] ?? '', ENT_QUOTES) ?>">
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>
              <input id="sem_numero" type="checkbox" name="sem_numero" value="1" <?= !empty($company['sem_numero']) ? 'checked' : '' ?>> Sem número
            </label>
          </div>
          <div class="form-group">
            <label for="numero">Número</label>
            <input id="numero" type="text" name="numero" value="<?= htmlspecialchars($company['numero'] ?? '', ENT_QUOTES) ?>" <?= !empty($company['sem_numero']) ? 'disabled' : '' ?>>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="subscription_price">Preço da Assinatura (R$)</label>
            <input id="subscription_price" type="number" name="subscription_price" step="0.01" min="0" value="<?= htmlspecialchars($company['subscription_price'] ?? '', ENT_QUOTES) ?>" placeholder="Ex: 300.00" required>
          </div>
          <div class="form-group">
            <label for="trial_days">Trial (dias)</label>
            <input id="trial_days" type="number" name="trial_days" min="1" max="60" value="<?= htmlspecialchars($company['trial_days'] ?? 30, ENT_QUOTES) ?>" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="subscription_start">Data Início</label>
            <input id="subscription_start" type="date" name="subscription_start" value="<?= htmlspecialchars($company['subscription_start'] ?? date('Y-m-d'), ENT_QUOTES) ?>" required>
          </div>
          <div class="form-group">
            <label for="subscription_end">Data Fim</label>
            <input id="subscription_end" type="date" name="subscription_end" value="<?= htmlspecialchars($company['subscription_end'] ?? date('Y-m-d', strtotime('+'.($company['trial_days'] ?? 30).' days')), ENT_QUOTES) ?>" required>
          </div>
        </div>

        <div class="form-group">
          <label for="status">Status</label>
          <select id="status" name="status" required>
            <option value="active" <?= (isset($company['status']) && $company['status']=='active')?'selected':'' ?>>Ativo</option>
            <option value="expired" <?= (isset($company['status']) && $company['status']=='expired')?'selected':'' ?>>Expirada</option>
          </select>
        </div>

        <button type="submit" class="btn-primary">Salvar Empresa</button>
      </form>
    </div>
  </div>
</div>

<script>
  document.getElementById('sem_numero').addEventListener('change', function() {
    document.getElementById('numero').disabled = this.checked;
  });
</script>
