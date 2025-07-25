<?php

//verificar se ele tem a permissão de estar nessa página
if (@$caixas == 'ocultar') {
	echo "<script>window.location='../index.php'</script>";
	exit();
}
$pag = 'caixas';


?>


<div class="justify-content-between" style="margin-top: 20px">
	<div class="left-content mt-2 mb-3">
		<form action="rel/caixas_class.php" method="POST" target="_blank">

			<div style="float:left; margin-right:35px">

				<button onclick="inserir()" type="button" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus me-2"
						aria-hidden="true"></i>Abrir Caixa</button>

			</div>

			<div style="display: inline-block; position:absolute; right:10px; margin-bottom: 10px">
				<button style="width:40px" type="submit" class="btn btn-danger ocultar_mobile_app" title="Gerar Relatório"><i class="fa fa-file-pdf-o"></i></button>
			</div>




			<div class="esc ocultar_mobile" style="float:left; margin-right:20px">
				<input type="date" class="form-control " name="dataInicial" id="data-inicial"
					value="<?php echo date('Y-m-d') ?>" required onchange="buscar()">
			</div>

			<div class="esc ocultar_mobile" style="float:left; margin-right:30px">

				<input type="date" class="form-control " name="dataFinal" id="data-final" value="<?php echo date('Y-m-d') ?>"
					required onchange="buscar()">

			</div>





			<div class="esc" style="float:left; margin-right:10px"><span><small><i title="Filtrar Operador"
							class="bi bi-search"></i></small></span></div>
			<div class="esc" style="float:left; margin-right:20px">
				<select class="form-select sel35" aria-label="Default select example" name="operador" id="status-busca"
					style="width:350px" onchange="buscar()">

					<?php
					if ($nivel_usuario == 'Administrador' || $nivel_usuario == 'Gerente') {
						$query = $pdo->query("SELECT * FROM usuarios where nivel != 'Cliente' and acessar_painel != 'Não'  and nivel != 'Entregador' and nivel != 'Motoboy' order by nome asc");
						echo '<option value="">Selecionar Operador</option>';
					} else {
						$query = $pdo->query("SELECT * FROM usuarios where id = '$id_usuario' ");
					}

					$res = $query->fetchAll(PDO::FETCH_ASSOC);
					for ($i = 0; $i < @count($res); $i++) {
						foreach ($res[$i] as $key => $value) {
						}
					?>

						<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?> </option>

					<?php } ?>

				</select>
			</div>


		</form>

	</div>


</div>

<br>


<div class="row row-sm" style="margin-top: 30px">
	<div class="col-lg-12">
		<div class="card custom-card">
			<div class="card-body" id="listar">

			</div>
		</div>
	</div>
</div>





<input type="hidden" id="ids">



<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_inserir"></span></h4>
				<button id="btn-fechar" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
						class="text-white" aria-hidden="true">&times;</span></button>
			</div>
			<form method="post" id="form-contas">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-5">
							<div class="form-group">
								<label>Operador</label>
								<select class="form-select sel5" aria-label="Default select example" name="operador" id="operador" style="width:100%" required>
									<?php
									if ($nivel_usuario == 'Administrador' || $nivel_usuario == 'Gerente') {
										$query = $pdo->query("SELECT * FROM usuarios where nivel != 'Cliente'  and acessar_painel != 'Não' and nivel != 'Entregador' and nivel != 'Motoboy' order by id desc");
										echo '<option value="">Selecionar Operador</option>';
									} else {
										$query = $pdo->query("SELECT * FROM usuarios where id = '$id_usuario' ");
									}
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for ($i = 0; $i < @count($res); $i++) {
										foreach ($res[$i] as $key => $value) {
										}
									?>
										<option value="<?php echo $res[$i]['id'] ?>" <?php if ($res[$i]['id'] == $id_usuario) { ?> selected <?php } ?>>
											<?php echo $res[$i]['nome'] ?> </option>
									<?php } ?>
								</select>
							</div>
						</div>


						<div class="col-md-3">
							<div class="form-group">
								<label>Valor Abertura</label>
								<input type="text" class="form-control" name="valor_abertura" id="valor_abertura" required>
							</div>
						</div>



						<div class="col-md-4">
							<div class="form-group">
								<label>Data Abertura</label>
								<input type="date" class="form-control" name="data_abertura" id="data_abertura"
									value="<?php echo date('Y-m-d') ?>" required>
							</div>
						</div>
					</div>


					<div class="row">
						<div class="col-md-10">
							<div class="form-group">
								<label>Observações</label>
								<input type="text" class="form-control" name="obs" id="obs" placeholder="Observações" value="">
							</div>
						</div>

						<div class="col-md-2" style="margin-top: 25px">
							<button type="submit" class="btn btn-primary">Abrir<i class="fa fa-check ms-2"></i></button>
						</div>

					</div>


					<br>

					<input type="hidden" name="id" id="id">
					<small>
						<div id="mensagem" align="center" class="mt-3"></div>
					</small>

				</div>


			</form>

		</div>
	</div>
</div>








<!-- Modal Fcehamento-->
<div class="modal fade" id="modalFechar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="exampleModalLabel"><span id="tituloModalFechar"></span></h4>
				<button id="btn-fechar_fechamento" aria-label="Close" class="btn-close" data-bs-dismiss="modal"
					type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
			</div>

			<form method="post" id="form-fechamento">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-5">
							<label>Operador</label>
							<input type="text" class="form-control" name="nome_operador" id="nome_operador" readonly="">
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label>Valor Abertura</label>
								<input type="text" class="form-control" name="valor_abertura_fechar" id="valor_abertura_fechar"
									readonly="">
							</div>
						</div>



						<div class="col-md-4">
							<div class="form-group">
								<label>R$ Valor do Caixa</label>
								<input type="text" class="form-control" name="total_caixa_fechar" id="total_caixa_fechar" required>
							</div>
						</div>
					</div>


					<input type="hidden" name="id" id="id_fechar">
					<small>
						<div id="mensagem_fechar" align="center" class="mt-3"></div>
					</small>


				</div>


				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Fechar Caixa<i class="fa fa-check ms-2"></i></button>
				</div>


			</form>

		</div>
	</div>
</div>









<!-- Modal Sangria-->
<div class="modal fade" id="modalSangria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="exampleModalLabel"><span id="tituloModalSangria"></span></h4>
				<button id="btn-fechar_sangria" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
						class="text-white" aria-hidden="true">&times;</span></button>
			</div>
			<form method="post" id="form-sangria">
				<div class="modal-body">


					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Operador</label>
								<select class="form-select sel5" aria-label="Default select example" name="nome_operador_sangria" id="nome_operador_sangria" style="width:100%" required>
									<?php
									if ($nivel_usuario == 'Administrador' || $nivel_usuario == 'Gerente') {
										$query = $pdo->query("SELECT * FROM usuarios where nivel != 'Cliente'  and acessar_painel != 'Não' and nivel != 'Entregador' and nivel != 'Motoboy' order by id desc");
										echo '<option value="0">Selecionar Operador</option>';
									} else {
										$query = $pdo->query("SELECT * FROM usuarios where id = '$id_usuario' ");
									}
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for ($i = 0; $i < @count($res); $i++) {
										foreach ($res[$i] as $key => $value) {
										}
									?>
										<option value="<?php echo $res[$i]['id'] ?>" <?php if ($res[$i]['id'] == $id_usuario) { ?> selected <?php } ?>>
											<?php echo $res[$i]['nome'] ?> </option>
									<?php } ?>
								</select>
							</div>
						</div>


						<div class="col-md-3">
							<div class="form-group">
								<label>Valor Sangria</label>
								<input type="text" class="form-control" name="valor_sangria" id="valor_sangria" placeholder="0,00">
							</div>
						</div>


						<div class="col-md-3" style="margin-top: 25px">
							<div class="form-group">
								<button type="submit" class="btn btn-primary">Salvar<i class="fa fa-check ms-2"></i></button>
							</div>
						</div>

					</div>



					<input type="hidden" name="id" id="id_sangria">
					<small>
						<div id="mensagem_sangria" align="center" class="mt-3"></div>
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


<script type="text/javascript">
	$(document).ready(function() {
		$('.sel2').select2({
			dropdownParent: $('#modalForm')
		});


		$('.sel35').select2({
			//dropdownParent: $('#modalForm')
		});

	});
</script>



<script type="text/javascript">
	$(document).ready(function() {
		$('.sel3').select2({
			dropdownParent: $('#modalParcelar')
		});
	});
</script>



<script type="text/javascript">
	$(document).ready(function() {

		$('.sel4').select2({
			dropdownParent: $('#modalBaixar')
		});

	});
</script>



<script type="text/javascript">
	function buscar() {

		var dataInicial = $("#data-inicial").val();
		var dataFinal = $("#data-final").val();
		var operador = $("#status-busca").val();

		listar(dataInicial, dataFinal, operador);

	}
</script>



<script type="text/javascript">
	$("#form-contas").submit(function() {

		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: 'paginas/' + pag + "/inserir.php",
			type: 'POST',
			data: formData,

			success: function(mensagem) {


				$('#mensagem').text('');
				$('#mensagem').removeClass()
				if (mensagem.trim() == "Salvo com Sucesso") {
					$('#btn-fechar').click();
					buscar()
					location.reload(); // Recarrega a página
				} else {
					$('#mensagem').addClass('text-danger')
					$('#mensagem').text(mensagem)
				}

			},


			cache: false,
			contentType: false,
			processData: false,

		});



	});
</script>





<script type="text/javascript">
	$("#form-fechamento").submit(function() {

		event.preventDefault();

		var formData = new FormData(this);

		$.ajax({
			url: 'paginas/' + pag + "/fechar.php",
			type: 'POST',
			data: formData,

			success: function(mensagem) {

				$('#mensagem_fechar').text('');
				$('#mensagem-excluir').removeClass()
				if (mensagem.trim() == "Salvo com Sucesso") {
					$('#btn-fechar_fechamento').click();
					buscar()
					location.reload(); // Recarrega a página
					sucesso()
				} else {
					$('#mensagem_fechar').addClass('text-danger')
					$('#mensagem-excluir').text(mensagem)
				}

			},


			cache: false,
			contentType: false,
			processData: false,

		});



	});
</script>





<script type="text/javascript">
	$("#form-sangria").submit(function() {

		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: 'paginas/' + pag + "/sangria.php",
			type: 'POST',
			data: formData,

			success: function(mensagem) {

				$('#mensagem_sangria').text('');
				$('#mensagem-excluir').removeClass()
				if (mensagem.trim() == "Salvo com Sucesso") {
					$('#btn-fechar_sangria').click();
					buscar()
					location.reload(); // Recarrega a página
					sucesso()
				} else {
					$('#mensagem_sangria').addClass('text-danger')
					$('#mensagem-excluir').text(mensagem)
				}

			},

			cache: false,
			contentType: false,
			processData: false,

		});



	});
</script>