<?php 
@session_start();
require_once('../../sistema/conexao.php');
require_once('../../helper/tenant_helper.php');

$sessao = @$_SESSION['sessao_usuario'];


$id_mesa = "";
if (@$_SESSION['id_ab_mesa'] != "") {
	$id_mesa = $_SESSION['id_ab_mesa'];
}

$nome_produto2 = '';
if ($id_mesa == "") {
	$query = $pdo->query("SELECT * FROM carrinho where sessao = '$sessao'");
} else {
	$query = $pdo->query("SELECT * FROM carrinho where mesa = '$id_mesa'");
}


$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
$total_carrinho = 0;
if($total_reg > 0){
	for($i=0; $i < $total_reg; $i++){
		foreach ($res[$i] as $key => $value){}	

			$id = $res[$i]['id'];
		$total_item = $res[$i]['total_item'];
		$produto = $res[$i]['produto'];
		$quantidade = $res[$i]['quantidade'];
		$obs = $res[$i]['obs'];
		$item = $res[$i]['item'];
		$variacao = $res[$i]['variacao'];
		$nome_produto_tab = $res[$i]['nome_produto'];
		$sabores = $res[$i]['sabores'];
		$borda = $res[$i]['borda'];
		$categoria = $res[$i]['categoria'];
		$valor_unit = $res[$i]['valor_unitario'];

		if($valor_unit == ""){
			if($total_item > 0 and $quantidade > 0){
			$valor_unit = $total_item / $quantidade;
			}else{
				$valor_unit = 0;
			}	
		}
		
		
		$id_sabor = $res[$i]['id_sabor'];

		$total_item = $total_item * $quantidade;

		$total_carrinho += $total_item;


		$total_itemF = number_format($total_item, 2, ',', '.');
		$valor_unitF = number_format($valor_unit, 2, ',', '.');
		$total_carrinhoF = number_format($total_carrinho, 2, ',', '.');


		$query2 = $pdo->query("SELECT * FROM variacoes where id = '$variacao'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count(@$res2) > 0){
			$sigla_variacao = '('.$res2[0]['sigla'].')';			
		}else{
			$sigla_variacao = '';
		}

		
		
		$query2 = $pdo->query("SELECT * FROM produtos where id = '$produto'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count(@$res2) > 0){
			$nome_produto = $res2[0]['nome'];
			$foto_produto = $res2[0]['foto'];
		}else{
			$nome_produto = $nome_produto_tab;
			$foto_produto = "";
		}		

		if($obs == ''){
			$classe_obs = 'text-warning';
		}else{
			$classe_obs = 'text-danger';
		}

		$classe_borda = 'ocultar';
		if($sabores > 0){			
			$nome_produto = $nome_produto_tab;
			$classe_borda = '';
		}


		$query8 =$pdo->query("SELECT * FROM bordas where id = '$borda'");
		$res8 = $query8->fetchAll(PDO::FETCH_ASSOC);
		$total_reg8 = @count($res8);
		if($total_reg8 > 0){
		$nome_borda = ' - '.$res8[0]['nome'];
		}else{
			$nome_borda = '';
		}


		$query2 = $pdo->query("SELECT * FROM temp where carrinho = '$id' and tabela = 'Variação' order by id asc limit 1");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$id_do_item = @$res2[0]['id_item'];

		$query2 = $pdo->query("SELECT * FROM itens_grade where id = '$id_do_item'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@$res2[0]['texto'] != ""){
			$sigla_grade = '<small> ('.@$res2[0]['texto'].')</small>';
		}else{
			$sigla_grade = '';
		}


		if($id_mesa > 0){
			$ocultar_excluir = 'ocultar';
		}else{
			$ocultar_excluir = '';
		}
		





echo <<<HTML

		
		<li class="list-group-item mb-1" style="border:  solid 1px #ababab; border-radius: 10px; box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.20);">
		<img class="" src="/delivery/sistema/painel/images/produtos/{$foto_produto}"width="30px">
		    	
		<span class="nome-produto"><b>{$nome_produto} {$sigla_variacao} {$sigla_grade}</b></span>
		<span class="{$classe_borda}" style="font-size:11px; color:#450703"><b> {$nome_borda}</b></span>

HTML;

$query2 = $pdo->query("SELECT * FROM temp where carrinho = '$id' and tabela = 'ingredientes'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$total_reg2 = @count($res2);
		if($total_reg2 > 0){

		for($i2=0; $i2 < $total_reg2; $i2++){
			foreach ($res2[$i2] as $key => $value){}
				$id_item = $res2[$i2]['id_item'];

			$query3 =$pdo->query("SELECT * FROM ingredientes where id = '$id_item'");
			$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
			$nome_ingrediente = 'Sem '.$res3[0]['nome'];
			if($i2 < ($total_reg2 - 1) ){
				$nome_ingrediente = $nome_ingrediente. ', ';
			}

echo '<span class="text-danger ingredientes">'.$nome_ingrediente.'</span>';

}
}


$query5 = $pdo->query("SELECT * FROM temp where carrinho = '$id' and tabela = 'adicionais'");
		$res5 = $query5->fetchAll(PDO::FETCH_ASSOC);
		$total_reg5 = @count($res5);
		if($total_reg5 > 0){
			$classe_adc = '';
		}else{
			$classe_adc = 'ocultar';
		}

$query5 = $pdo->query("SELECT * FROM temp where carrinho = '$id' and tabela != 'adicionais'");
		$res5 = $query5->fetchAll(PDO::FETCH_ASSOC);
		$total_reg5 = @count($res5);
		if($total_reg5 > 0){
			$classe_grade = '';
		}else{
			$classe_grade = 'ocultar';
		}

echo <<<HTML


			
			<a href="#" onclick="excluir('{$id}')" class="link-neutro {$ocultar_excluir}"><i class="bi bi-x-lg direita"></i></a>

			<div id="popup-excluir{$id}" class="overlay-excluir">
			<div class="popup">
			<div class="row">
			<div class="col-12">
			Confirmar Exclusão? <a href="#" onclick="excluirCarrinho('{$id}', '{$id_sabor}')" class="text-danger link-neutro">Sim</a>
			</div>
			<div class="col-3">
			<a class="close" href="#" onclick="fecharExcluir('{$id}')">&times;</a>
			</div>
			</div>

			</div>
			</div>	


			
			<div class="carrinho-qtd">

			<div class="itens-carrinho-qtd">
				<a title="Observações do item" class="link-neutro" href="#" onclick="obs('{$nome_produto}', '{$obs}', '{$id}')"><i class="bi bi-card-text {$classe_obs}"></i></a>
			</div>

			<div class="itens-carrinho-qtd-adc {$classe_adc}">
				<a title="Ver Adicionais" class="link-neutro" href="#" onclick="adicionais('{$nome_produto}', '{$id}', '{$id_sabor}', '{$categoria}')"><i class="bi  bi-plus text-primary"></i><small><small>Adc</small></small></a>
			</div>

			<div class="itens-carrinho-qtd-adc {$classe_grade}">
				<a title="Ver Opcionais" class="link-neutro" href="#" onclick="grades('{$nome_produto}', '{$id}', '{$produto}')"><i class="bi  bi-plus text-primary"></i><small><small>Opções</small></small></a>
			</div>

			<a href="#" onclick="mudarQuant('{$id}', '{$quantidade}', 'menos')" class="link-neutro">
			<div class="menos-mais">
			-
			</div>
			</a>


			<div class="qtd-item-carrinho">
			<span id="quant">{$quantidade}</span>
			</div>


			<a href="#" onclick="mudarQuant('{$id}', '{$quantidade}', 'mais')" class="link-neutro">
			<div class="menos-mais">
			+
			</div>
			</a>


			<div class="valor-carrinho-it">
			<small><b>R$ {$total_itemF}</b></small>
			</div>

			</div>


			</li>

HTML;

		} 

	}else{
		echo "<script>window.location='index'</script>";
	}


	?>

	<script type="text/javascript">
		$("#total-do-pedido").text("<?=$total_carrinhoF?>");

		function mudarQuant(id, quantidade, acao){
			if(acao == 'menos' && quantidade == 1){
				excluirCarrinho(id);
			}
			$.ajax({
				url: '/delivery/js/ajax/mudar-quant-carrinho.php?tenant=<?= TENANT_ID ?>',

				method: 'POST',
				data: {id, quantidade, acao},
				dataType: "text",

				success: function (mensagem) {  

					if (mensagem.trim() == "Alterado com Sucesso") {                
						listarCarrinho();         
					}else{
						alert(mensagem);
						listarCarrinho();
					} 

				},      

			});
		}


		function excluirCarrinho(id, id_sabor){

			$.ajax({
				url: '/delivery/js/ajax/excluir-carrinho.php?tenant=<?= TENANT_ID ?>',

				method: 'POST',
				data: {id, id_sabor},
				dataType: "text",

				success: function (mensagem) {  
					
					if (mensagem.trim() == "Excluido com Sucesso") {                
						listarCarrinho();         
					} 

				},      

			});
		}

		function excluir(id){
			var popup = 'popup-excluir' + id;
			document.getElementById(popup).style.display = 'block';
		}

		function fecharExcluir(id){
			var popup = 'popup-excluir' + id;
			document.getElementById(popup).style.display = 'none';
		}

		function obs(nome, obs, id){
			$('#obs').val('');
			$("#nome_item").text(nome)
			$("#obs").val(obs)
			$("#id_obs").val(id)
			 var myModal = new bootstrap.Modal(document.getElementById('modalObs'), {
        		//backdrop: 'static',
    		});
   			 myModal.show();

		}


		function adicionais(nome, id, id_sabor, cat){			
			$("#nome_item_adc").text(nome)			
			listarAdicionais(id, id_sabor, cat);

			var myModal = new bootstrap.Modal(document.getElementById('modalAdc'), {
        		//backdrop: 'static',
    		});
   			 myModal.show();			 

		}

		function listarAdicionais(id, id_sabor, cat){

			$.ajax({
         url: '/delivery/js/ajax/listar-adc-carrinho.php?tenant=<?= TENANT_ID ?>',

        method: 'POST',
        data: {id, id_sabor, cat},
        dataType: "html",

        success:function(result){
            $("#listar-adc-carrinho").html(result);
           
        }
    });

			

		}



		function grades(nome, id, produto){			
			$("#nome_item_grade").text(nome)			
			listarGrades(id, produto);

			var myModal = new bootstrap.Modal(document.getElementById('modalGrades'), {
        		//backdrop: 'static',
    		});
   			 myModal.show();			 

		}



		function listarGrades(id, produto){

			$.ajax({
         url: '/delivery/js/ajax/listar-grades-carrinho.php?tenant=<?= TENANT_ID ?>',

        method: 'POST',
        data: {id, produto},
        dataType: "html",

        success:function(result){
            $("#listar-grade-carrinho").html(result);
           
        }
    });

			

		}


	</script>