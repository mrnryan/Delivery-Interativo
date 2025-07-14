<?php
// painel/paginas/acessos/listar.php
$tabela = 'acessos';
require_once("../../../conexao.php");

// Seleciona todos os campos, incluindo company_id
$query = $pdo->query("
    SELECT 
      id,
      nome,
      chave,
      grupo,
      pagina,
      company_id
    FROM {$tabela}
    ORDER BY id DESC
");
$res    = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = count($res);
?>
<?php if ($linhas > 0): ?>
<small>
  <table
    class="table table-striped table-hover table-bordered text-nowrap border-bottom dt-responsive"
    id="tabela"
  >
    <thead>
      <tr>
        <th align="center" width="5%" class="text-center">Selecionar</th>
        <th>Nome</th>
        <th>Chave</th>
        <th>Grupo</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($res as $row): 
      $id        = $row['id'];
      $nome      = htmlspecialchars($row['nome'], ENT_QUOTES);
      $chave     = htmlspecialchars($row['chave'], ENT_QUOTES);
      $grupo     = (int)$row['grupo'];
      $pagina    = htmlspecialchars($row['pagina'], ENT_QUOTES);
      $companyId = (int)$row['company_id'];

      // Busca nome do grupo usando named parameter
      $stmt2 = $pdo->prepare("
        SELECT nome 
          FROM grupo_acessos 
         WHERE id = :grp_id
      ");
      $stmt2->bindValue(':grp_id', $grupo, PDO::PARAM_INT);
      $stmt2->execute();
      $nome_grupo = $stmt2->fetchColumn() ?: 'Sem Grupo';

      // Só exibe checkbox se não for registro global
      if ($companyId !== 1) {
          $checkbox = <<<CHK
<td align="center">
  <div class="custom-checkbox custom-control">
    <input
      type="checkbox"
      class="custom-control-input"
      id="seletor-{$id}"
      onchange="selecionar('{$id}')"
    >
    <label
      for="seletor-{$id}"
      class="custom-control-label mt-1 text-dark"
    ></label>
  </div>
</td>
CHK;
      } else {
          $checkbox = '<td></td>';
      }

      // Só exibe editar/excluir se não for registro global
      if ($companyId !== 1) {
          $acoes = <<<BTN
<big>
  <a
    class="btn btn-info btn-sm"
    href="#"
    onclick="editar('{$id}','{$nome}','{$chave}','{$grupo}','{$pagina}')"
    title="Editar Dados"
  >
    <i class="fa fa-edit"></i>
  </a>
</big>
<div class="dropdown" style="display: inline-block;">
  <a
    class="btn btn-danger btn-sm"
    href="#"
    data-bs-toggle="dropdown"
    title="Excluir"
  >
    <i class="fa fa-trash"></i>
  </a>
  <div class="dropdown-menu tx-13">
    <div class="dropdown-item-text botao_excluir">
      <p>
        Confirmar Exclusão?
        <a href="#" onclick="excluir('{$id}')">
          <span class="text-danger">Sim</span>
        </a>
      </p>
    </div>
  </div>
</div>
BTN;
      } else {
          $acoes = '';
      }
    ?>
      <tr>
        <?= $checkbox ?>
        <td><?= $nome ?></td>
        <td class="esc"><?= $chave ?></td>
        <td class="esc"><?= htmlspecialchars($nome_grupo, ENT_QUOTES) ?></td>
        <td><?= $acoes ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="5">
          <div id="mensagem-excluir" class="text-center"></div>
        </td>
      </tr>
    </tfoot>
  </table>
</small>
<?php else: ?>
  <small>Nenhum Registro Encontrado!</small>
<?php endif; ?>

<script>
  $(document).ready(function() {
    $('#tabela').DataTable({
      language: {
        // url: '//cdn.datatables.net/plug-ins/1.13.2/i18n/pt-BR.json'
      },
      ordering: false,
      stateSave: true
    });
  });

  function editar(id, nome, chave, grupo, pagina) {
    $('#mensagem').text('');
    $('#titulo_inserir').text('Editar Registro');
    $('#id').val(id);
    $('#nome').val(nome);
    $('#chave').val(chave);
    $('#grupo').val(grupo).change();
    $('#pagina').val(pagina).change();
    $('#modalForm').modal('show');
  }

  function limparCampos() {
    $('#id').val('');
    $('#nome').val('');
    $('#chave').val('');
    $('#grupo').val('0').change();
    $('#ids').val('');
    $('#btn-deletar').hide();
  }
</script>
