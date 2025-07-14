<?php 
$tabela = 'frequencias';
require_once("../../../conexao.php");

$query = $pdo->query("SELECT * from $tabela order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
echo <<<HTML
<small>
	<table class="table table-hover table-bordered text-nowrap border-bottom dt-responsive" id="tabela">
	<thead> 
	<tr> 
	<th align="center" width="5%" class="text-center">Selecionar</th>
	<th class="width60">Frequência</th>	
	<th>Dias</th>		
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;
}else{
	echo 'Não possui nenhum cadastro!';
}

for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$frequencia = $res[$i]['frequencia'];
	$dias = $res[$i]['dias'];
	$company_id = $res[$i]['company_id']; // precisa existir no banco

echo <<<HTML
<tr>
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
<td>{$frequencia}</td>
<td>{$dias}</td>
<td>
HTML;

	if ($company_id != 1) {
		echo <<<HTML
		<big><a class="btn btn-info-light btn-sm" href="#" onclick="editar('{$id}','{$frequencia}','{$dias}')" title="Editar Dados"><i class="fa fa-edit "></i></a></big>
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
?>


<script type="text/javascript">
	$(document).ready( function () {		
	    $('#tabela').DataTable({
	        "language" : {
	            //"url" : '//cdn.datatables.net/plug-ins/1.13.2/i18n/pt-BR.json'
	        },
	        "ordering": false,
			"stateSave": true
	    });
	} );

	function editar(id, frequencia, dias){
		$('#mensagem').text('');
    	$('#titulo_inserir').text('Editar Registro');

    	$('#id').val(id);
    	$('#frequencia').val(frequencia);
    	$('#dias').val(dias);

    	$('#modalForm').modal('show');
	}

	function limparCampos(){
		$('#id').val('');
    	$('#dias').val('');
    	$('#frequencia').val('');
    	$('#ids').val('');
    	$('#btn-deletar').hide();	
	}
</script>
