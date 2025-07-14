<?php 
$tabela = 'grupo_acessos';
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
	<th>Nome</th>	
	<th>Acessos</th>
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$nome = $res[$i]['nome'];
	$company_id = $res[$i]['company_id'];

	$query2 = $pdo->query("SELECT * from acessos where grupo = '$id' ");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$total_acessos = @count($res2);

echo <<<HTML
<tr>
HTML;

	// Checkbox de seleção (somente se não for company_id 1)
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
<td class="esc">{$total_acessos}</td>
<td>
HTML;

	if ($company_id != 1) {
		echo <<<HTML
		<big><a class="btn btn-info btn-sm" href="#" onclick="editar('{$id}','{$nome}')" title="Editar Dados"><i class="fa fa-edit "></i></a></big>

		<div class="dropdown" style="display: inline-block;">                      
			<a class="btn btn-danger btn-sm" href="#" aria-expanded="false" aria-haspopup="true" data-bs-toggle="dropdown" class="dropdown"><i class="fa fa-trash "></i> </a>
			<div  class="dropdown-menu tx-13">
			<div class="dropdown-item-text botao_excluir">
			<p>Confirmar Exclusão? <a href="#" onclick="excluir('{$id}')"><span class="text-danger">Sim</span></a></p>
			</div>
			</div>
		</div>
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

}else{
	echo 'Nenhum Registro Encontrado!';
}
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

	function editar(id, nome){
		$('#mensagem').text('');
    	$('#titulo_inserir').text('Editar Registro');

    	$('#id').val(id);
    	$('#nome').val(nome);
    
    	$('#modalForm').modal('show');
	}

	function limparCampos(){
		$('#id').val('');
    	$('#nome').val('');
    	$('#ids').val('');
    	$('#btn-deletar').hide();	
	}
</script>
