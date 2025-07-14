<?php // views/users/form.php ?>
<style>
  .form-container { padding: 2rem; }
  .card {
    background: #fff;
    border-radius: 8px;
    padding: 1.5rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    max-width: 600px;
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
  .form-group input:focus,
  .form-group select:focus {
    border-color: #e64a19;
    outline: none;
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
  .btn-primary:hover { background: #d84315; }
  small { color: #7f8c8d; }
  @media (max-width: 500px) {
    .card { padding: 1rem; }
    .form-row { grid-template-columns: 1fr; }
    .btn-primary { width: 100%; }
  }
</style>
<style>
    @media (max-width: 767.98px) {
    .topbar {
      height: 50px !important;
    }
  }
  </style>

<div class="form-container">
  <div class="card">
    <div class="card-header">
      <h2><?= isset($user) ? 'Editar' : 'Novo' ?> Usuário</h2>
    </div>
    <div class="card-body">
      <form method="post" action="?c=user&a=<?= isset($user) ? 'update' : 'store' ?>">
        <?php if(isset($user)): ?>
          <input type="hidden" name="id" value="<?= htmlspecialchars($user['id'], ENT_QUOTES) ?>">
        <?php endif; ?>

        <div class="form-row">
          <div class="form-group">
            <label for="nome">Nome</label>
            <input id="nome" type="text" name="nome" value="<?= htmlspecialchars($user['nome'] ?? '', ENT_QUOTES) ?>" required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '', ENT_QUOTES) ?>" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="password">Senha</label>
            <input id="password" type="password" name="password" <?= isset($user) ? '' : 'required' ?> >
            <?php if(isset($user)): ?>
              <small>Deixe em branco para manter a atual</small>
            <?php endif; ?>
          </div>
          <div class="form-group">
            <label for="role">Role</label>
            <select id="role" name="role">
              <option value="master" <?= (isset($user['role']) && $user['role']=='master')?'selected':'' ?>>Master</option>
              <option value="admin" <?= (isset($user['role']) && $user['role']=='admin')?'selected':'' ?>>Admin</option>
            </select>
          </div>
        </div>

        <button type="submit" class="btn-primary">Salvar Usuário</button>
      </form>
    </div>
  </div>
</div>
