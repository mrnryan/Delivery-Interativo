<?php
@session_start();
require_once("verificar.php");
require_once("../conexao.php");

$pag = 'novo_pedido';
if (@$novo_pedido == 'ocultar') {
	echo "<script>window.location='../index.php'</script>";
	exit();
}

$query2 = $pdo->query("SELECT * FROM usuarios where id = '$id_usuario'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if (@count($res2) > 0) {
	$nome_usuario = $res2[0]['nivel'];
}



//verificar se o caixa está aberto
$query = $pdo->query("SELECT * from caixas where operador = '$id_usuario' and data_fechamento is null");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if ($linhas > 0) {
} else {
	if ($abertura_caixa == 'Sim' and $nome_usuario != 'Administrador') {
		echo '<script>alert("Não possui caixa Aberto, abra o caixa!")</script>';
		echo '<script>window.location="caixas"</script>';
	}
}

?>

<div class="breadcrumb-header justify-content-between">
	<div class="left-content mt-2">


	</div>
</div>



<div style="padding:5px" id="listar">

</div>



<!-- Modal modalAbertura-->
<div class="modal fade" id="modalAbertura" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h6 class="modal_title"><span id="titulo_inserir"></span> <span id="nome_da_mesa"></span></h6>
				<button id="btn-fechar" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
			</div>
			<form id="form">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Nome Cliente</label>
								<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Cliente" required>
							</div>
						</div>
						<div class="col-md-6">

							<div class="form-group">
								<label for="exampleInputEmail1">Garçon</label>
								<select class="form-select sel5" id="garcon" name="garcon" style="width:100%;">

									<?php
									$query = $pdo->query("SELECT * FROM usuarios where nivel = 'Garçon' or nivel = 'Atendente' ORDER BY nome asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$total_reg = @count($res);
									if ($total_reg > 0) {
										for ($i = 0; $i < $total_reg; $i++) {
											if ($res[$i]['id'] == $id_usuario) {
												echo '<option selected value="' . $res[$i]['id'] . '">' . $res[$i]['nome'] . '</option>';
											} else {
												echo '<option value="' . $res[$i]['id'] . '">' . $res[$i]['nome'] . '</option>';
											}
										}
									} else {
										echo '<option value="0">Cadastre um Garçon</option>';
									}
									?>


								</select>
							</div>

						</div>
					</div>






					<div class="row">

						<div class="col-md-3">
							<div class="form-group">
								<label for="exampleInputEmail1">Pessoas Mesa</label>
								<input type="number" class="form-control" id="pessoas" name="pessoas" placeholder="Número de Pessoas" required>
							</div>
						</div>

						<div class="col-md-9">
							<div class="form-group">
								<label for="exampleInputEmail1">Observações</label>
								<input type="text" class="form-control" id="obs" name="obs" placeholder="Observações">
							</div>
						</div>

					</div>

					<input type="hidden" name="id" id="id_abertura">
					<input type="hidden" name="id_ab" id="id">

					<br>
					<small>
						<div id="mensagem" align="center"></div>
					</small>
				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Salvar <i class="fa fa-check ms-2"></i></button>
				</div>
			</form>


		</div>
	</div>
</div>






<!-- Modal Itens-->
<div class="modal fade" id="modalItens" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title">Mesa <span id="nome_da_mesa_itens"></span> <small><span
							id="obs_da_mesa_itens"></span></small></h4>
				<button onclick="listar()" id="btn-fechar-itens" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
			</div>

			<div class="modal-body">

				<div id="listar_carrinho">

				</div>


				<br>
				<small>
					<div id="mensagem_itens" align="center"></div>
				</small>
			</div>


			<div class="modal-footer">
				<form method="POST" action="/delivery/<?php echo $_SESSION['company_id']; ?>" target="_blank">

					<input type="hidden" name="id_mesa" id="id_itens">
					<input type="hidden" name="id_abertura_mesa" id="id_abertura_mesa">
					<button type="submit" class="btn btn-primary">Adicionar Itens<i class="fa fa-check ms-2"></i></button>

				</form>
			</div>

		</div>
	</div>
</div>








<!-- Modal Fechamento-->
<div class="modal fade" id="modalFechamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title">Fechar Mesa <span id="nome_da_mesa_fechamento"></span></h4>
				<button id="btn-fechar-fechamento" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
			</div>
			<form id="form_fechamento">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-6">

							<div class="form-group">
								<label for="exampleInputEmail1">Garçon</label>
								<select class="form-select sel6" id="garcon_fechamento" name="garcon" style="width:100%;">

									<?php
									$query = $pdo->query("SELECT * FROM usuarios where nivel = 'Garçon' or nivel = 'Atendente' ORDER BY nome asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$total_reg = @count($res);
									if ($total_reg > 0) {
										for ($i = 0; $i < $total_reg; $i++) {

											echo '<option value="' . $res[$i]['id'] . '">' . $res[$i]['nome'] . '</option>';
										}
									} else {
										echo '<option value="0">Cadastre um Garçon</option>';
									}
									?>


								</select>
							</div>

						</div>


						<div class="col-md-3">
							<div class="form-group">
								<label for="exampleInputEmail1">Total Itens</label>
								<input readonly="true" type="text" class="form-control" id="total_itens_fechamento" name="total_itens"
									placeholder="Total Itens">
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="exampleInputEmail1">Comissão R$</label>
								<input onkeyup="calcular()" type="text" class="form-control" id="comissao_fechamento" name="comissao"
									placeholder="">
							</div>
						</div>

					</div>




					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label for="couvert_fechamento">Couvert</label>
								<input onkeyup="calcular()" type="text" class="form-control" id="couvert_fechamento" name="couvert"
									placeholder="">
							</div>
						</div>

						<div class="col-md-2">
							<div class="form-group">
								<label for="total_valor_fechamento">AV</label>
								<input style="color:red" readonly="" type="text" class="form-control" id="total_valor_fechamento" name="total_valor_fechamento" placeholder="">
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="subtotal_fechamento">Subtotal</label>
								<input type="text" class="form-control" id="subtotal_fechamento" name="subtotal" placeholder="">
							</div>
						</div>



						<div class="col-md-4">
							<div class="form-group">
								<label>Forma de Pagamento</label>
								<select class="form-select" id="forma_pgto" name="forma_pgto">
									<?php
									$query = $pdo->query("SELECT * FROM formas_pgto ORDER BY id asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$total_reg = @count($res);
									if ($total_reg > 0) {
										for ($i = 0; $i < $total_reg; $i++) {

											echo '<option value="' . $res[$i]['id'] . '">' . $res[$i]['nome'] . '</option>';
										}
									} else {
										echo '<option value="0">Cadastre uma Forma de Pagamento</option>';
									}
									?>


								</select>
							</div>
						</div>


					</div>





					<div class="row">

						<div class="col-md-12">
							<div class="form-group">
								<label for="exampleInputEmail1">Observações</label>
								<input type="text" class="form-control" id="obs_fechamento" name="obs" placeholder="Observações">
							</div>
						</div>



					</div>



					<input type="hidden" name="id" id="id_fechamento">
					<input type="hidden" name="id_ab" id="id_ab_fechamento">

					<br>
					<small>
						<div id="mensagem_fechamento" align="center"></div>
					</small>
				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Salvar<i class="fa fa-check ms-2"></i></button>
				</div>
			</form>


		</div>
	</div>
</div>







<!-- Modal VALORES-->
<div class="modal fade" id="modalValores" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title">Mesa <span id="nome_valor"></span></h4>
				<button id="btn-fechar-valor" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button" onclick="listar()"><span class="text-white" aria-hidden="true">&times;</span></button>
			</div>

			<form id="form-valor" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Nome</label>
								<input class="form-control" type="text" name="nome" id="nome_ad" placeholder="Nome" required>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Valor</label>
								<input class="form-control" type="text" name="valor" id="valor_ad" placeholder="R$ 0,00" required>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Forma de Pagamento</label>
								<select class="form-select" id="forma_pgto" name="forma_pgto">
									<?php
									$query = $pdo->query("SELECT * FROM formas_pgto ORDER BY id asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$total_reg = @count($res);
									if ($total_reg > 0) {
										for ($i = 0; $i < $total_reg; $i++) {

											echo '<option value="' . $res[$i]['id'] . '">' . $res[$i]['nome'] . '</option>';
										}
									} else {
										echo '<option value="0">Cadastre uma Forma de Pagamento</option>';
									}
									?>


								</select>
							</div>

						</div>
						<div class="col-md-2" style="margin-top:25px">
							<button type="submit" class="btn btn-primary">Inserir<i class="fa fa-check ms-2"></i></button>
						</div>
					</div>


					<hr>

					<small>
						<div id="listar-valor"></div>
					</small>

					<br>
					<small>
						<div align="center" id="mensagem-valor"></div>
					</small>

					<input type="hidden" class="form-control" name="id" id="id_valor">

				</div>
			</form>

		</div>
	</div>
</div>



<!-- Modal EXCLUIR-->
<div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true" data-bs-backdrop="static">
	<div class="modal-dialog" role="document" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title">Excluir Registro - <span id="nome_modal"> </span></h4>
				<button id="btn-fechar-excluir" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
			</div>

			<div class="modal-body">

				<div class="row">
					<div class="col-md-7">
						<label for="exampleInputEmail1">Gerente</label>
						<select class="form-select sel40" id="gerente" name="gerente" style="width:100%;">
							<?php
							$query = $pdo->query("SELECT * FROM usuarios where nivel = 'Gerente' or nivel = 'Administrador'");
							$res = $query->fetchAll(PDO::FETCH_ASSOC);
							$total_reg = @count($res);

							echo '<option value="">Selecione um Gerente</option>';

							if ($total_reg > 0) {
								for ($i = 0; $i < $total_reg; $i++) {
									foreach ($res[$i] as $key => $value) {
									}
									echo '<option value="' . $res[$i]['id'] . '">' . $res[$i]['nome'] . '</option>';
								}
							}
							?>


						</select>
					</div>


					<div class="col-md-3" style="padding:0">
						<div class="form-group">
							<label for="exampleInputEmail1">Senha</label>
							<input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
						</div>
					</div>

					<div class="col-md-2" style="margin-top: 23px">
						<button class="btn btn-primary" onclick="excluirCarrinho()">Ok</button>
					</div>
				</div>


				<br>
				<small>
					<div align="center" id="mensagem-excluir-modal"></div>
				</small>

				<input type="hidden" class="form-control" name="id_car_excluir" id="id_car_excluir">

			</div>

		</div>
	</div>
</div>



<script type="text/javascript">
	var pag = "<?= $pag ?>"
</script>
<script src="js/ajax.js"></script>


<script type="text/javascript">
	$(document).ready(function() {
		setInterval(listar, 20000);
		setInterval(listarCarrinho, 20000);

		$('.sel5').select2({
			dropdownParent: $('#modalAbertura')
		});

		$('.sel6').select2({
			dropdownParent: $('#modalFechamento')
		});

		$('.sel40').select2({
			dropdownParent: $('#modalExcluir')
		});
	});

	function listarCarrinho() {
		var id = $('#id_abertura_mesa').val();
		$.ajax({

			url: 'paginas/' + pag + "/listar_carrinho.php",
			method: 'POST',
			data: {
				id
			},
			dataType: "html",

			success: function(result) {
				$("#listar_carrinho").html(result);
				$('#mensagem_itens').text('');
			}
		});
	}

	function calcular() {
		var comissao = $('#comissao_fechamento').val();
		var couvert = $('#couvert_fechamento').val();
		var total_itens = $('#total_itens_fechamento').val();
		var total_valor_fechamento = $('#total_valor_fechamento').val();

		if (comissao == "") {
			comissao = 0;
		}

		if (couvert == "") {
			couvert = 0;
		}

		if (total_itens == "") {
			total_itens = 0;
		}

		if (total_valor_fechamento == "") {
			total_valor_fechamento = 0;
		}

		var subtotal = parseFloat(comissao) + parseFloat(couvert) + parseFloat(total_itens) - total_valor_fechamento;
		$('#subtotal_fechamento').val(subtotal.toFixed(2));
	}





	$("#form_fechamento").submit(function() {

		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: 'paginas/' + pag + "/fechamento.php",
			type: 'POST',
			data: formData,

			success: function(mensagem) {
				$('#mensagem_fechamento').text('');
				$('#mensagem_fechamento').removeClass()
				if (mensagem.trim() == "Salvo com Sucesso") {

					$('#btn-fechar-fechamento').click();
					listar();

				} else {

					$('#mensagem_fechamento').addClass('text-danger')
					$('#mensagem_fechamento').text(mensagem)
				}


			},

			cache: false,
			contentType: false,
			processData: false,

		});

	});





	$("#form-valor").submit(function() {

		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: 'paginas/' + pag + "/salvar_valor.php",
			type: 'POST',
			data: formData,

			success: function(mensagem) {
				$('#mensagem-valor').text('');
				$('#mensagem-valor').removeClass()
				if (mensagem.trim() == "Salvo com Sucesso") {

					$('#nome_ad').val('')
					$('#valor_ad').val('')

					listarValores();

				} else {

					$('#mensagem-valor').addClass('text-danger')
					$('#mensagem-valor').text(mensagem)
				}


			},

			cache: false,
			contentType: false,
			processData: false,

		});

	});



	function listarValores() {
		var id = $('#id_valor').val();
		$.ajax({
			url: 'paginas/' + pag + "/listar_valores.php",
			method: 'POST',
			data: {
				id
			},
			dataType: "text",

			success: function(result) {
				$("#listar-valor").html(result);
			}
		});

	}
</script>