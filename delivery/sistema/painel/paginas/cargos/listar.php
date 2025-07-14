<?php
$tabela = 'cargos';
require_once("../../../conexao.php");

$query   = $pdo->query("SELECT id, nome, company_id FROM $tabela ORDER BY id DESC");
$res     = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas  = count($res);

if ($linhas > 0) {
    echo <<<HTML
<small>
<table class="table table-hover table-bordered text-nowrap border-bottom dt-responsive" id="tabela">
<thead>
<tr>
  <th align="center" width="5%" class="text-center">Selecionar</th>
  <th class="width80">Nome</th>
  <th>Ações</th>
</tr>
</thead>
<tbody>
HTML;

    foreach ($res as $row) {
        $id        = $row['id'];
        $nome      = htmlspecialchars($row['nome'], ENT_QUOTES);
        $companyId = (int)$row['company_id'];

        // Se company_id != 1, exibe checkbox; caso contrário, deixa em branco
        $checkboxCell = '';
        if ($companyId !== 1) {
            $checkboxCell = <<<CHK
<td align="center">
  <div class="custom-checkbox custom-control">
    <input type="checkbox"
           class="custom-control-input"
           id="seletor-{$id}"
           onchange="selecionar('{$id}')">
    <label for="seletor-{$id}"
           class="custom-control-label mt-1 text-dark"></label>
  </div>
</td>
CHK;
        } else {
            $checkboxCell = '<td></td>';
        }

        // Se company_id != 1, exibe editar/excluir; senão, deixa em branco
        $acoes = '';
        if ($companyId !== 1) {
            $acoes = <<<BTN
<big>
  <a class="btn btn-info-light btn-sm"
     href="#"
     onclick="editar('{$id}','{$nome}')"
     title="Editar Dados">
    <i class="fa fa-edit"></i>
  </a>
</big>
<big>
  <a href="#"
     class="btn btn-danger-light btn-sm"
     onclick="excluir('{$id}')"
     title="Excluir">
    <i class="fa fa-trash-can text-danger"></i>
  </a>
</big>
BTN;
        }

        echo <<<HTML
<tr>
  {$checkboxCell}
  <td>{$nome}</td>
  <td>{$acoes}</td>
</tr>
HTML;
    }

    echo <<<HTML
</tbody>
<small><div align="center" id="mensagem-excluir"></div></small>
</table>
</small>
HTML;
} else {
    echo '<small>Nenhum Registro Encontrado!</small>';
}
?>




<script type="text/javascript">
	$(document).ready(function() {
		$('#tabela').DataTable({
			"language": {
				//"url" : '//cdn.datatables.net/plug-ins/1.13.2/i18n/pt-BR.json'
			},
			"ordering": false,
			"stateSave": true
		});
	});
</script>

<script type="text/javascript">
	function editar(id, nome) {
		$('#mensagem').text('');
		$('#titulo_inserir').text('Editar Registro');

		$('#id').val(id);
		$('#nome').val(nome);

		$('#modalForm').modal('show');
	}



	function limparCampos() {
		$('#id').val('');
		$('#nome').val('');


		$('#ids').val('');
		$('#btn-deletar').hide();
	}
</script>

