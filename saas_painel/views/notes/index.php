<?php
// views/notes/index.php
?>
<style>
    @media (max-width: 767.98px) {
    .topbar {
      height: 50px !important;
    }
  }
  </style>
<main class="p-4 flex-fill overflow-auto">
  <!-- Cabeçalho responsivo igual a empresas -->
  <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-3 gap-2">
    <h4 class="mb-2 mb-sm-0">Anotações cadastradas:</h4>
    <div class="d-flex align-items-center gap-2">
      <form method="get" action="?c=note&a=index" class="d-flex align-items-center me-2 mb-2 mb-sm-0">
        <input type="hidden" name="c" value="note">
        <input type="hidden" name="a" value="index">
        <input
          type="search"
          name="search"
          class="form-control form-control-sm"
          placeholder="Buscar notas..."
          value="<?= htmlspecialchars($search ?? '') ?>"
        >
      </form>
      <a href="?c=note&a=create" class="btn btn-primary btn-sm flex-shrink-0">
        <i class="fas fa-plus"></i> Nova Nota
      </a>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-hover table-bordered mb-0">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Usuário</th>
          <th>Texto</th>
          <th>Criada</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($notes as $n): ?>
        <tr>
          <td><?= $n['id'] ?></td>
          <td><?= htmlspecialchars($n['user_name'], ENT_QUOTES) ?></td>
          <td><?= nl2br(htmlspecialchars($n['texto'], ENT_QUOTES)) ?></td>
          <td><?= $n['created_at'] ?></td>
          <td>
            <a
              href="?c=note&a=delete&id=<?= $n['id'] ?>"
              class="btn btn-sm btn-outline-danger"
              onclick="return confirm('Deseja realmente excluir esta anotação?');"
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
