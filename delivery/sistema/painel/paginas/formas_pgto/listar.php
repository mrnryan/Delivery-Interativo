<?php
require_once("../../../conexao.php");
$tabela = 'formas_pgto';

$query = $pdo->query("SELECT * FROM $tabela ORDER BY id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if ($total_reg > 0) {

	echo <<<HTML
<small>
	<table class="table table-hover table-bordered text-nowrap border-bottom dt-responsive" id="tabela">
	<thead> 
	<tr> 
	<th align="center" width="5%" class="text-center">Selecionar</th>
	<th>Nome</th>		
	<th>Taxa</th>		
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

	for ($i = 0; $i < $total_reg; $i++) {
		$id = $res[$i]['id'];
		$nome = $res[$i]['nome'];
		$taxa = $res[$i]['taxa'];
		$company_id = $res[$i]['company_id'] ?? 1;

		if ($taxa == "") {
			$taxa = 0;
		}

		echo <<<HTML
<tr class="">
HTML;

		if ($company_id != 1) {
			echo <<<HTML
<td align="center">
<div class="custom-checkbox custom-control">
<input type="checkbox" class="custom-control-input" id="seletor-{$id}" onchange="selecionar('{$id}')">
<label for="seletor-{$id}" class="custom-control-label mt-1 text-dark"></label>
</div>
</td>
HTML;
		} else {
			echo "<td></td>";
		}

		echo <<<HTML
<td>{$nome}</td>
<td>{$taxa}%</td>
<td>
HTML;

		if ($company_id != 1) {
			echo <<<HTML
<big><a class="btn btn-info-light btn-sm" href="#" onclick="editar('{$id}','{$nome}','{$taxa}')" title="Editar Dados"><i class="fa fa-edit "></i></a></big>
<big><a href="#" class="btn btn-danger-light btn-sm" onclick="excluir('{$id}')" title="Excluir"><i class="fa fa-trash-can text-danger"></i></a></big>
HTML;
		}

		echo <<<HTML
</td>
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
	echo 'Não possui nenhum registro Cadastrado!';
}
?>


<script type="text/javascript">
	$(document).ready(function() {
		$('#tabela').DataTable({
			"ordering": false,
			"stateSave": true
		});
		$('#tabela_filter label input').focus();
	});

	function editar(id, nome, taxa) {
		$('#id').val(id);
		$('#nome').val(nome);
		$('#taxa').val(taxa);
		$('#titulo_inserir').text('Editar Registro');
		$('#modalForm').modal('show');
	}

	function limparCampos() {
		$('#nome').val('');
		$('#taxa').val('');
	}
</script>
