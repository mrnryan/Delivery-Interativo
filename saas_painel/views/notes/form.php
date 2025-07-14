<?php // views/notes/form.php ?>
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
  .form-group textarea {
    width: 100%;
    padding: 0.6rem;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 0.95rem;
    resize: vertical;
    min-height: 150px;
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
  @media (max-width: 500px) {
    .card { padding: 1rem; }
    .form-container { padding: 1rem; }
    .btn-primary { width: 100%; text-align: center; }
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
      <h2><?= isset($note) ? 'Editar Nota' : 'Nova Nota' ?></h2>
    </div>
    <div class="card-body">
      <form method="post" action="?c=note&a=<?= isset($note) ? 'update' : 'store' ?>">
        <?php if(isset($note)): ?>
          <input type="hidden" name="id" value="<?= htmlspecialchars($note['id'], ENT_QUOTES) ?>">
        <?php endif; ?>

        <div class="form-group">
          <label for="texto">Texto</label>
          <textarea id="texto" name="texto" required><?= htmlspecialchars($note['texto'] ?? '', ENT_QUOTES) ?></textarea>
        </div>
        <button type="submit" class="btn-primary">Salvar Nota</button>
      </form>
    </div>
  </div>
</div>
