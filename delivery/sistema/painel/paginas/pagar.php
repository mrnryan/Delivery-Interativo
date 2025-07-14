<?php
$pag = 'pagar';

if (@$pagar == 'ocultar') {
	echo "<script>window.location='index'</script>";
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


<div class="justify-content-between">
	<form action="rel/pagar_class.php" target="_blank" method="POST">
		<div class="left-content mt-2">


			<a style="margin-bottom: 20px; margin-top: 20px" class="btn ripple btn-primary text-white" onclick="inserir()"
				type="button"><i class="fe fe-plus me-2"></i>Adicionar Conta</a>



			<a class="btn btn-danger" href="#" onclick="deletarSel()" title="Excluir" id="btn-deletar" style="display:none"><i class="fe fe-trash-2"></i> Deletar</a>




			<div class="dropdown" style="display: inline-block;">
				<a onclick="valorBaixar()" href="#" aria-expanded="false" aria-haspopup="true" data-bs-toggle="dropdown"
					class="btn btn-success dropdown" id="btn-baixar" style="display:none"><i class="fa fa-check-square"></i>
					Baixar</a>
				<div class="dropdown-menu tx-13">
					<div style="width: 240px; padding:15px 5px 0 10px;" class="dropdown-item-text">
						<p>Baixar contas Selecionadas? <a href="#" onclick="deletarSelBaixar()"><span
									class="text-verde">Sim</span></a></p>
						<p><b>Total das Contas</b> R$ <span id="total_contas"></span></p>
					</div>
				</div>
			</div>


			<div class="cab_mobile"></div>




			<div style="display: inline-block; margin-bottom: 10px">
				<input style="height:35px; width:49%; font-size: 13px;" type="date" class="form-control2" name="dataInicial"
					id="dataInicial" value="<?php echo $data_inicio_mes ?>" required onchange="buscar()">

				<input style="height:35px; width:49%; font-size: 13px" type="date" name="dataFinal" id="dataFinal"
					class="form-control2" value="<?php echo $data_final_mes ?>" required onchange="buscar()">
			</div>




			<div class="card-group" style="margin-bottom: -30px">

				<div class="card text-center mb-5" style="width: 100%; margin-right: 10px; border-radius: 10px; height:90px">
					<a class="text-white" href="#"
						onclick="$('#tipo_data_filtro').val('Vencidas'); $('#pago').val('Vencidas'); buscar(); ">
						<div class="card-header bg-red">
							Vencidas
							<i class="fa fa-external-link pull-right"></i>
						</div>
						<div class="card-corpo">
							<p class="card-text" style="margin-top:-15px;">
							<h5><span class="text-danger" id="total_vencidas">R$ 0,0</span></h5>
							</p>
						</div>
					</a>
				</div>




				<div class="card text-center mb-5" style="width: 100%; margin-right: 10px; border-radius: 10px; height:90px">
					<a href="#" onclick="$('#tipo_data_filtro').val('Hoje'); $('#pago').val(''); buscar(); ">
						<div class="card-header bg-orange">
							Vence Hoje
							<i class="fa fa-external-link pull-right"></i>
						</div>
						<div class="card-corpo">
							<p class="card-text" style="margin-top:-15px;">
							<h5><span class="text-danger" id="total_hoje">R$ 0,0</span></h5>
							</p>
						</div>

					</a>
				</div>


				<div class="card text-center mb-5" style="width: 100%; margin-right: 10px; border-radius: 10px; height:90px">
					<a href="#" onclick="$('#tipo_data_filtro').val('Amanha'); $('#pago').val(''); buscar(); ">
						<div class="card-header" style="background: gray">
							Vence Amanhã
							<i class="fa fa-external-link pull-right"></i>
						</div>
						<div class="card-corpo">
							<p class="card-text" style="margin-top:-15px;">
							<h5><span style="color: gray" id="total_amanha">R$ 0,0</span></h5>
							</p>
						</div>
					</a>
				</div>


				<?php if (@$_SESSION['nivel'] == 'Administrador') { ?>

					<div class="card text-center mb-5" style="width: 100%; margin-right: 10px; border-radius: 10px; height:90px">
						<a href="#" onclick=" $('#tipo_data_filtro').val('Recebidas'); $('#pago').val('Sim'); buscar();">
							<div class="card-header" style="background: #2b7a00">
								Recebidas
								<i class="fa fa-external-link pull-right"></i>
							</div>
							<div class="card-corpo">
								<p class="card-text" style="margin-top:-15px;">
								<h5><span style="color: #2b7a00" id="total_recebidas">R$ 0,0</span></h5>
								</p>
							</div>
						</a>
					</div>


					<div class="card text-center mb-5" style="width: 100%; margin-right: 10px; border-radius: 10px; height:90px">
						<a href="#" onclick="$('#tipo_data_filtro').val('Todas'); $('#pago').val(''); buscar();">
							<div class="card-header" style="background: #1f1f1f;">
								Total
								<i class="fa fa-external-link pull-right"></i>
							</div>
							<div class="card-corpo">
								<p class="card-text" style="margin-top:-15px;">
								<h5><span style="color: #1f1f1f" id="total_total">R$ 0,0</span></h5>
								</p>
							</div>
						</a>
					</div>
				<?php } ?>

				<div class="card text-center mb-5" style="width: 100%; margin-right: 10px; border-radius: 10px; height:90px">
					<a class="text-white" href="#" onclick="$('#tipo_data_filtro').val('Pedentes'); $('#pago').val(''); buscar();">
						<div class="card-header" style="background: #920801">
							Todas Pedentes
							<i class="fa fa-external-link pull-right"></i>
						</div>
						<div class="card-corpo">
							<p class="card-text" style="margin-top:-15px;">
							<h5><span style="color: #920801" id="total_pedentes">R$ 0,0</span></h5>
							</p>
						</div>
					</a>
				</div>

			</div>

		</div>


		<input type="hidden" name="tipo_data" id="tipo_data">
		<input type="hidden" name="pago" id="pago">
		<input type="hidden" name="tipo_data_filtro" id="tipo_data_filtro">


	</form>

</div>



<div class="row row-sm">
	<div class="col-lg-12">
		<div class="card custom-card">
			<div class="card-body" id="listar">

			</div>
		</div>
	</div>
</div>



<input type="hidden" id="ids">

<!-- Modal Principal -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_inserir"></span></h4>
				<button id="btn-fechar" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
			</div>
			<form id="form">
				<div class="modal-body">


					<div class="row">
						<div class="col-md-4 mb-2 col-8 needs-validation was-validated">
							<label>Descrição</label>
							<input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição">
						</div>

						<div class="col-md-2 col-4 needs-validation was-validated">
							<label>Valor</label>
							<input type="text" class="form-control" id="valor" name="valor" placeholder="0,00" required>
						</div>

						<div class="col-md-3 mb-2 col-6">
							<label>Vencimento</label>
							<input type="date" name="vencimento" id="vencimento" value="<?php echo $data_atual ?>" class="form-control">
						</div>

						<div class="col-md-3 col-6">
							<label>Pago Em</label>
							<input type="date" name="data_pgto" id="data_pgto" value="" class="form-control">
						</div>

					</div>

					<div class="row">

						<div class="col-md-6 mb-2">
							<label>Fornecedores</label>
							<select name="fornecedor" id="fornecedor" class="form-select sel3" style="width:100%; height:35px">
								<option value="0">Selecione um Fornecedor</option>
								<?php

								$query = $pdo->query("SELECT * from fornecedores order by id asc");
								$res = $query->fetchAll(PDO::FETCH_ASSOC);
								$linhas = @count($res);
								if ($linhas > 0) {
									for ($i = 0; $i < $linhas; $i++) {
										echo '<option value="' . $res[$i]['id'] . '">' . $res[$i]['nome'] . '</option>';
									}
								}
								?>
							</select>
						</div>


						<div class="col-md-6">
							<label>Funcionários</label>
							<select name="funcionario" id="funcionario" class="form-select sel3" style="width:100%; height:35px">
								<option value="0">Selecione um Funcionário</option>
								<?php
								$query = $pdo->query("SELECT * from usuarios where nivel != 'Administrador' order by id asc");
								$res = $query->fetchAll(PDO::FETCH_ASSOC);
								$linhas = @count($res);
								if ($linhas > 0) {
									for ($i = 0; $i < $linhas; $i++) {
										echo '<option value="' . $res[$i]['id'] . '">' . $res[$i]['nome'] . '</option>';
									}
								}
								?>
							</select>
						</div>
					</div>


					<div class="row">

						<div class="col-md-3 col-6">
							<label>Forma Pgto</label>
							<select name="forma_pgto" id="forma_pgto" class="form-select">
								<?php
								$query = $pdo->query("SELECT * from formas_pgto order by id asc");
								$res = $query->fetchAll(PDO::FETCH_ASSOC);
								$linhas = @count($res);
								if ($linhas > 0) {
									for ($i = 0; $i < $linhas; $i++) {
										echo '<option value="' . $res[$i]['id'] . '">' . $res[$i]['nome'] . '</option>';
									}
								} else {
									echo '<option value="0">Cadastre uma Forma de Pagamento</option>';
								}
								?>
							</select>
						</div>

						<div class="col-md-3 mb-2 col-6">
							<label>Frequência</label>
							<select name="frequencia" id="frequencia" class="form-select">
								<?php
								$query = $pdo->query("SELECT * from frequencias order by id asc");
								$res = $query->fetchAll(PDO::FETCH_ASSOC);
								$linhas = @count($res);
								if ($linhas > 0) {
									for ($i = 0; $i < $linhas; $i++) {
										echo '<option value="' . $res[$i]['dias'] . '">' . $res[$i]['frequencia'] . '</option>';
									}
								} else {
									echo '<option value="0">Cadastre uma Forma de Pagamento</option>';
								}
								?>
							</select>
						</div>

						<div class="col-md-4 mb-2">
							<label>Arquivo</label>
							<input type="file" class="form-control" id="arquivo" name="foto" onchange="carregarImg()">
						</div>

						<div class="col-md-2">
							<img width="80px" id="target">

						</div>

					</div>

					<div class="row">
						<div class="col-md-12 mb-2">
							<label>Observações</label>
							<input type="text" class="form-control" id="obs" name="obs" placeholder="Observações">
						</div>


					</div>


					<input type="hidden" class="form-control" id="id" name="id">

					<br>
					<small>
						<div id="mensagem" align="center"></div>
					</small>
				</div>
				<div class="modal-footer">
					<button id="btn_salvar" type="submit" class="btn btn-primary">Salvar<i class="fa fa-check ms-2"></i></button>

					<button class="btn btn-primary" type="button" id="btn_carregando" style="display: none">
						<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Carregando...
					</button>
				</div>
			</form>
		</div>
	</div>
</div>




<!-- Modal Dados -->
<div class="modal fade" id="modalDados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_dados"></span></h4>
				<button id="btn-fechar-dados" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
			</div>

			<div class="modal-body">


				<div class="row">


					<div class="col-md-8">
						<div class="tile">
							<div class="table-responsive">
								<table id="" class="text-left table table-bordered">
									<tr>
										<td class="bg-primary text-white width30">Pessoa</td>
										<td><span id="cliente_dados"></span></td>
									</tr>

									<tr>
										<td class="bg-primary text-white">Vencimento</td>
										<td><span id="vencimento_dados"></span></td>
									</tr>

									<tr>
										<td class="bg-primary text-white w_150">Pagamento</td>
										<td><span id="data_pgto_dados"></span></td>
									</tr>

									<tr>
										<td class="bg-primary text-white w_150">Forma Pgto</td>
										<td><span id="nome_pgto_dados"></span></td>
									</tr>


									<tr>
										<td class="bg-primary text-white w_150">Frequência</td>
										<td><span id="frequencia_dados"></span></td>
									</tr>

									<tr>
										<td class="bg-primary text-white w_150">Lançado Por</td>
										<td><span id="usu_lanc_dados"></span></td>
									</tr>


									<tr>
										<td class="bg-primary text-white w_150">Usuário Baixa</td>
										<td><span id="usu_pgto_dados"></span></td>
									</tr>

									<tr>
										<td class="bg-primary text-white w_150">Multa</td>
										<td><span id="multa_dados"></span></td>
									</tr>

									<tr>
										<td class="bg-primary text-white w_150">Júros</td>
										<td><span id="juros_dados"></span></td>
									</tr>

									<tr>
										<td class="bg-primary text-white w_150">Desconto</td>
										<td><span id="desconto_dados"></span></td>
									</tr>


									<tr>
										<td class="bg-primary text-white w_150">Subtotal</td>
										<td><span id="total_dados"></span></td>
									</tr>

									<tr>
										<td class="bg-primary text-white w_150">Pago</td>
										<td><span id="pago_dados"></span></td>
									</tr>




									<tr>
										<td class="bg-primary text-white w_150">OBS</td>
										<td><span id="obs_dados"></span></td>
									</tr>



								</table>
							</div>
						</div>
					</div>



					<div class="col-md-4">
						<div class="tile">
							<div class="table-responsive">
								<table id="" class="text-left table table-bordered">

									<tr>
										<td align="center">
										<td align="center"><img src="" id="target_dados" width="200px"></td>
										</td>
									</tr>

								</table>
							</div>
						</div>
					</div>

				</div>





			</div>

		</div>
	</div>
</div>





<!-- Modal Parcelar -->
<div class="modal fade" id="modalParcelar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="tituloModal">Parcelar Conta: <span id="nome-parcelar"> </span></h4>
				<button id="btn-fechar-parcelar" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
			</div>
			<form method="post" id="form-parcelar">
				<div class="modal-body">


					<div class="row">
						<div class="col-md-4">
							<div class="mb-3">
								<label>Valor</label>
								<input type="text" class="form-control" name="valor-parcelar" id="valor-parcelar" readonly>
							</div>
						</div>

						<div class="col-md-3">
							<div class="mb-3">
								<label>Parcelas</label>
								<input type="number" class="form-control" name="qtd-parcelar" id="qtd-parcelar" placeholder="1" required>
							</div>
						</div>

						<div class="col-md-5">
							<div class="form-group">
								<label>Frequência Parcelas</label>
								<select class="form-select" name="frequencia" id="frequencia-parcelar" required style="width:100%;">

									<?php
									$query = $pdo->query("SELECT * FROM frequencias order by id asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for ($i = 0; $i < @count($res); $i++) {
										foreach ($res[$i] as $key => $value) {
										}
										$id_item = $res[$i]['id'];
										$nome_item = $res[$i]['frequencia'];
										$dias = $res[$i]['dias'];

										if ($nome_item != 'Uma Vez' and $nome_item != 'Única' and $nome_item != 'Nenhuma') {

									?>
											<option <?php if ($nome_item == 'Mensal') { ?> selected <?php } ?> value="<?php echo $dias ?>"><?php echo $nome_item ?></option>

									<?php }
									} ?>


								</select>
							</div>
						</div>


					</div>

					<input type="hidden" name="id-parcelar" id="id-parcelar">
					<input type="hidden" name="nome-parcelar" id="nome-input-parcelar">
					<small>
						<div id="mensagem-parcelar" align="center" class="mt-3"></div>
					</small>

				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" id="btn_salvar_parcelar">Parcelar</button>
					<button class="btn btn-primary" type="button" id="btn_carregando_parcelar" style="display: none">
						<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Carregando...
					</button>
				</div>


			</form>

		</div>
	</div>
</div>






<!-- Modal Baixar-->
<div class="modal fade" id="modalBaixar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="tituloModal">Baixar Conta: <span id="descricao-baixar"> </span></h4>
				<button id="btn-fechar-baixar" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
			</div>
			<form id="form-baixar" method="post">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-6">
							<div class="mb-3">
								<label>Valor <small class="text-muted">(Total ou Parcial)</small></label>
								<input onkeyup="totalizar()" type="text" class="form-control" name="valor-baixar" id="valor-baixar" required>
							</div>
						</div>


						<div class="col-md-6">
							<div class="form-group">
								<label>Forma PGTO</label>
								<select class="form-select" name="saida-baixar" id="saida-baixar" required>
									<?php
									$query = $pdo->query("SELECT * FROM formas_pgto order by id asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for ($i = 0; $i < @count($res); $i++) {
										foreach ($res[$i] as $key => $value) {
										}

									?>
										<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

									<?php } ?>

								</select>
							</div>
						</div>

					</div>


					<div class="row">


						<div class="col-md-4">
							<div class="mb-3">
								<label>Multa em R$</label>
								<input onkeyup="totalizar()" type="text" class="form-control" name="valor-multa" id="valor-multa" placeholder="Ex 15.00" value="0">
							</div>
						</div>

						<div class="col-md-4">
							<div class="mb-3">
								<label>Júros em R$</label>
								<input onkeyup="totalizar()" type="text" class="form-control" name="valor-juros" id="valor-juros" placeholder="Ex 0.15" value="0">
							</div>
						</div>

						<div class="col-md-4">
							<div class="mb-3">
								<label>Desconto R$</label>
								<input onkeyup="totalizar()" type="text" class="form-control" name="valor-desconto" id="valor-desconto" placeholder="Ex 15.00" value="0">
							</div>
						</div>



					</div>


					<div class="row">

						<div class="col-md-6">
							<div class="mb-3">
								<label>Data da Baixa</label>
								<input type="date" class="form-control" name="data-baixar" id="data-baixar" value="<?php echo date('Y-m-d') ?>">
							</div>
						</div>


						<div class="col-md-6">
							<div class="mb-3">
								<label>SubTotal</label>
								<input type="text" class="form-control" name="subtotal" id="subtotal" readonly>
							</div>
						</div>
					</div>




					<small>
						<div id="mensagem-baixar" align="center"></div>
					</small>

					<input type="hidden" class="form-control" name="id-baixar" id="id-baixar">


				</div>
				<div class="modal-footer">

					<button type="submit" class="btn btn-success" id="btn_baixar">Baixar<i class="fa fa-check ms-2"></i></button>
					<button class="btn btn-success" type="button" id="btn_carregando_baixar" style="display: none">
						<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Carregando...
					</button>
				</div>
			</form>
		</div>
	</div>
</div>




<!-- Modal Resíduo-->
<div class="modal fade" id="modalResiduos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="tituloModal">Residuos da Conta</h4>
				<button id="btn-fechar-residuos" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">

				<small>
					<div id="listar-residuos"></div>
				</small>

			</div>

		</div>
	</div>
</div>



<!-- Modal Arquivos -->
<div class="modal fade" id="modalArquivos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="tituloModal">Gestão de Arquivos - <span id="nome-arquivo"> </span></h4>
				<button id="btn-fechar-arquivos" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
			</div>
			<form id="form-arquivos" method="post">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								<label>Arquivo</label>
								<input class="form-control" type="file" name="arquivo_conta" onChange="carregarImgArquivos();" id="arquivo_conta">
							</div>
						</div>
						<div class="col-md-4">
							<div id="divImgArquivos">
								<img src="images/arquivos/sem-foto.png" width="60px" id="target-arquivos">
							</div>
						</div>




					</div>

					<div class="row">
						<div class="col-md-8">
							<input type="text" class="form-control" name="nome-arq" id="nome-arq" placeholder="Nome do Arquivo * " required>
						</div>

						<div class="col-md-4">
							<button type="submit" class="btn btn-primary">Inserir<i class="fa fa-check ms-2"></i></button>
						</div>
					</div>

					<hr>

					<small>
						<div id="listar-arquivos"></div>
					</small>

					<br>
					<small>
						<div align="center" id="mensagem-arquivo"></div>
					</small>

					<input type="hidden" class="form-control" name="id-arquivo" id="id-arquivo">


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

		$('.sel3').select2({
			dropdownParent: $('#modalForm')
		});

	});
</script>


<script type="text/javascript">
	function marcarTodos() {
		let checkbox = document.getElementById('input-todos');
		var usuario = $('#id_permissoes').val();

		if (checkbox.checked) {
			adicionarPermissoes(usuario);
		} else {
			limparPermissoes(usuario);
		}
	}
</script>


<script type="text/javascript">
	function excluir(id) {
		$('#mensagem-excluir').text('Excluindo...')

		$.ajax({
			url: 'paginas/' + pag + "/excluir.php",
			method: 'POST',
			data: {
				id
			},
			dataType: "html",

			success: function(mensagem) {
				if (mensagem.trim() == "Excluído com Sucesso") {
					buscar();
					limparCampos();
				} else {
					$('#mensagem-excluir').addClass('text-danger')
					$('#mensagem-excluir').text(mensagem)
				}
			}
		});
	}
</script>



<script type="text/javascript">
	function carregarImg() {
		var target = document.getElementById('target');
		var file = document.querySelector("#arquivo").files[0];

		var arquivo = file['name'];
		resultado = arquivo.split(".", 2);

		if (resultado[1] === 'pdf') {
			$('#target').attr('src', "images/pdf.png");
			return;
		}

		if (resultado[1] === 'rar' || resultado[1] === 'zip') {
			$('#target').attr('src', "images/rar.png");
			return;
		}

		if (resultado[1] === 'doc' || resultado[1] === 'docx' || resultado[1] === 'txt') {
			$('#target').attr('src', "images/word.png");
			return;
		}


		if (resultado[1] === 'xlsx' || resultado[1] === 'xlsm' || resultado[1] === 'xls') {
			$('#target').attr('src', "images/excel.png");
			return;
		}


		if (resultado[1] === 'xml') {
			$('#target').attr('src', "images/xml.png");
			return;
		}



		var reader = new FileReader();

		reader.onloadend = function() {
			target.src = reader.result;
		};

		if (file) {
			reader.readAsDataURL(file);

		} else {
			target.src = "";
		}
	}
</script>


<script type="text/javascript">
	function buscar() {
		var filtro = $('#tipo_data_filtro').val();
		var dataInicial = $('#dataInicial').val();
		var dataFinal = $('#dataFinal').val();
		var tipo_data = $('#tipo_data').val();
		listar(filtro, dataInicial, dataFinal, tipo_data)

	}


	function tipoData(tipo) {
		$('#tipo_data').val(tipo);
		buscar();
	}





	function totalizar() {
		valor = $('#valor-baixar').val();
		desconto = $('#valor-desconto').val();
		juros = $('#valor-juros').val();
		multa = $('#valor-multa').val();

		valor = valor.replace(",", ".");
		desconto = desconto.replace(",", ".");
		juros = juros.replace(",", ".");
		multa = multa.replace(",", ".");


		if (valor == "") {
			valor = 0;
		}

		if (desconto == "") {
			desconto = 0;
		}

		if (juros == "") {
			juros = 0;
		}

		if (multa == "") {
			multa = 0;
		}



		subtotal = parseFloat(valor) + parseFloat(juros) + parseFloat(multa) - parseFloat(desconto);


		console.log(subtotal)

		$('#subtotal').val(subtotal);

	}
</script>



<script type="text/javascript">
	$("#form-baixar").submit(function() {
		event.preventDefault();
		var formData = new FormData(this);

		$('#btn_carregando_baixar').show();
		$('#btn_baixar').hide();


		$.ajax({
			url: 'paginas/' + pag + "/baixar.php",
			type: 'POST',
			data: formData,

			success: function(mensagem) {
				$('#mensagem-baixar').text('');
				$('#mensagem-baixar').removeClass()
				if (mensagem.trim() == "Baixado com Sucesso") {
					$('#btn-fechar-baixar').click();
					buscar();
					baixado();
				} else {
					$('#mensagem-baixar').addClass('text-danger')
					$('#mensagem-baixar').text(mensagem)
				}

				$('#btn_carregando_baixar').hide();
				$('#btn_baixar').show();

			},

			cache: false,
			contentType: false,
			processData: false,

		});

	});
</script>



<script type="text/javascript">
	$("#form-parcelar").submit(function() {
		event.preventDefault();
		var formData = new FormData(this);

		$('#btn_salvar_parcelar').hide();
		$('#btn_carregando_parcelar').show();

		$.ajax({
			url: 'paginas/' + pag + "/parcelar.php",
			type: 'POST',
			data: formData,

			success: function(mensagem) {
				$('#mensagem-parcelar').text('');
				$('#mensagem-parcelar').removeClass()
				if (mensagem.trim() == "Parcelado com Sucesso") {
					$('#btn-fechar-parcelar').click();
					buscar();
				} else {
					$('#mensagem-parcelar').addClass('text-danger')
					$('#mensagem-parcelar').text(mensagem)
				}

				$('#btn_salvar_parcelar').show();
				$('#btn_carregando_parcelar').hide();

			},

			cache: false,
			contentType: false,
			processData: false,

		});

	});


	function valorBaixar() {
		var ids = $('#ids').val();

		$.ajax({
			url: 'paginas/' + pag + "/valor_baixar.php",
			method: 'POST',
			data: {
				ids
			},
			dataType: "html",

			success: function(result) {
				$("#total_contas").html(result);

			}
		});
	}
</script>



<script type="text/javascript">
	$("#form-arquivos").submit(function() {
		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: 'paginas/' + pag + "/arquivos.php",
			type: 'POST',
			data: formData,

			success: function(mensagem) {
				$('#mensagem-arquivo').text('');
				$('#mensagem-arquivo').removeClass()
				if (mensagem.trim() == "Inserido com Sucesso") {
					//$('#btn-fechar-arquivos').click();
					$('#nome-arq').val('');
					$('#arquivo_conta').val('');
					$('#target-arquivos').attr('src', 'images/arquivos/sem-foto.png');
					listarArquivos();
				} else {
					$('#mensagem-arquivo').addClass('text-danger')
					$('#mensagem-arquivo').text(mensagem)
				}

			},

			cache: false,
			contentType: false,
			processData: false,

		});

	});
</script>

<script type="text/javascript">
	function listarArquivos() {
		var id = $('#id-arquivo').val();
		$.ajax({
			url: 'paginas/' + pag + "/listar-arquivos.php",
			method: 'POST',
			data: {
				id
			},
			dataType: "text",

			success: function(result) {
				$("#listar-arquivos").html(result);
			}
		});
	}
</script>




<script type="text/javascript">
	function carregarImgArquivos() {
		var target = document.getElementById('target-arquivos');
		var file = document.querySelector("#arquivo_conta").files[0];

		var arquivo = file['name'];
		resultado = arquivo.split(".", 2);

		if (resultado[1] === 'pdf') {
			$('#target-arquivos').attr('src', "images/pdf.png");
			return;
		}

		if (resultado[1] === 'rar' || resultado[1] === 'zip') {
			$('#target-arquivos').attr('src', "images/rar.png");
			return;
		}

		if (resultado[1] === 'doc' || resultado[1] === 'docx' || resultado[1] === 'txt') {
			$('#target-arquivos').attr('src', "images/word.png");
			return;
		}


		if (resultado[1] === 'xlsx' || resultado[1] === 'xlsm' || resultado[1] === 'xls') {
			$('#target-arquivos').attr('src', "images/excel.png");
			return;
		}


		if (resultado[1] === 'xml') {
			$('#target-arquivos').attr('src', "images/xml.png");
			return;
		}



		var reader = new FileReader();

		reader.onloadend = function() {
			target.src = reader.result;
		};

		if (file) {
			reader.readAsDataURL(file);

		} else {
			target.src = "";
		}
	}
</script>

<script>
	modalForm.addEventListener('shown.bs.modal', () => {
		descricao.focus()
	})
</script>