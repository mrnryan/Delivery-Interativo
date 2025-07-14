<?php
@session_start();
require_once("verificar.php");
require_once("../conexao.php");

if (@$mesas == 'ocultar') {
	echo "<script>window.location='../index.php'</script>";
	exit();
}


$pag = 'mesas';


$query2 = $pdo->query("SELECT * FROM usuarios where id = '$id_usuario'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if (@count($res2) > 0) {
	$nome_usuario = $res2[0]['nivel'];
}



?>

<div class="breadcrumb-header justify-content-between">
	<div class="left-content mt-2">
		<a class="btn ripple btn-primary text-white" onclick="inserir()" type="button"><i class="fe fe-plus me-1"></i>
			Adicionar <?php echo ucfirst($pag); ?></a>

		<a class="btn btn-danger" href="#" onclick="deletarSel()" title="Excluir" id="btn-deletar" style="display:none"><i class="fe fe-trash-2"></i> Deletar</a>

	</div>
</div>

<div class="bs-example widget-shadow" style="padding:15px" id="listar">

</div>



<input type="hidden" id="ids">


<!-- Modal Inserir-->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title"><span id="titulo_inserir"></span></h4>
				<button id="btn-fechar" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
			</div>

			<form id="form">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-9">
							<div class="form-group">

								<input type="number" class="form-control" id="nome" name="nome" placeholder="Digite o Número" required>
							</div>
						</div>
						<div class="col-md-3">
							<button type="submit" class="btn btn-primary" id="btn_salvar">Salvar<i class="fa fa-check ms-2"></i></button>
							<button class="btn btn-primary" type="button" id="btn_carregando" style="display: none">
								<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
							</button>
						</div>
					</div>


					<input type="hidden" name="id" id="id">

					<br>
					<small>
						<div id="mensagem" align="center"></div>
					</small>
				</div>
			</form>


		</div>
	</div>
</div>



<script type="text/javascript">
	var pag = "<?= $pag ?>"
</script>
<script src="js/ajax.js"></script>