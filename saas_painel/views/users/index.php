<?php
// views/users/index.php
?>
<style>
    @media (max-width: 767.98px) {
    .topbar {
      height: 50px !important;
    }
  }
  </style>
<main class="p-4 flex-fill overflow-auto">
  <!-- Cabeçalho responsivo, igual a notas -->
  <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-3 gap-2">
    <h4 class="mb-2 mb-sm-0">Usuários Cadastrados</h4>
    <div class="d-flex align-items-center gap-2">
      <form method="get" action="?c=user&a=index" class="d-flex align-items-center me-sm-2 mb-2 mb-sm-0">
        <input type="hidden" name="c" value="user">
        <input type="hidden" name="a" value="index">
        <input
          type="search"
          name="search"
          class="form-control form-control-sm"
          placeholder="Buscar usuários..."
          value="<?= htmlspecialchars($search ?? '') ?>"
        >
      </form>
      <?php if ($_SESSION['user']['role'] === 'master'): ?>
        <a href="?c=user&a=create" class="btn btn-primary btn-sm flex-shrink-0">
          <i class="fas fa-plus"></i> Novo Usuário
        </a>
      <?php endif; ?>
    </div>
  </div>

  <!-- Tabela com scroll horizontal interno -->
  <div class="table-responsive">
    <table class="table table-hover table-bordered mb-0">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Email</th>
          <th>Role</th>
          <?php if ($_SESSION['user']['role'] === 'master'): ?>
            <th>Ações</th>
          <?php endif; ?>
        </tr>
      </thead>
      <tbody>
        <?php foreach($users as $u): ?>
        <tr>
          <td><?= $u['id'] ?></td>
          <td><?= htmlspecialchars($u['nome'], ENT_QUOTES) ?></td>
          <td><?= htmlspecialchars($u['email'], ENT_QUOTES) ?></td>
          <td><?= ucfirst($u['role']) ?></td>
          <?php if ($_SESSION['user']['role'] === 'master'): ?>
          <td>
            <div class="btn-group" role="group">
              <a href="?c=user&a=edit&id=<?= $u['id'] ?>" class="btn btn-sm btn-outline-secondary" title="Editar">
                <i class="fas fa-edit"></i> Editar
              </a>
              <a
                href="?c=user&a=delete&id=<?= $u['id'] ?>"
                class="btn btn-sm btn-outline-danger"
                onclick="return confirm('Deseja realmente excluir este usuário?');"
                title="Excluir"
              >
                <i class="fas fa-trash"></i> Excluir
              </a>
            </div>
          </td>
          <?php endif; ?>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</main>
