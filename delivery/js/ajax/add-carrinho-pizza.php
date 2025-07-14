<?php 
@session_start();
require_once("../../helper/tenant_helper.php");
require_once('../../sistema/conexao.php');


$ids = $_POST['ids'];
$variacao = $_POST['variacao'];
$obs = $_POST['obs'];
$borda = $_POST['borda'];
$mesa = $_POST['mesa'];

if(@$_SESSION['sessao_usuario'] == ""){
	$sessao = date('Y-m-d-H:i:s-').rand(0, 1500);
	$_SESSION['sessao_usuario'] = $sessao;
}else{
	$sessao = $_SESSION['sessao_usuario'];
}

$status = '';
if($mesa != ""){
    $status = 'Aguardando';
}

$ids = substr($ids, 0, -1);
$separar = explode("-", $ids);
$total_ids = @count($separar);

$quantidade_sabores = $total_ids;

$nome_produto = '';
$valor_produto = array();
$valor_produto_media = 0;
$primeiro_id_produto = $separar[0];
for($i=0; $i<$total_ids; $i++){
		$id = $separar[$i];

		$query = $pdo->query("SELECT * FROM produtos where id = '$id'");
		$res = $query->fetchAll(PDO::FETCH_ASSOC);		
		$nome_p = $res[0]['nome'];
		$categoria = $res[0]['categoria'];


		if($i>0){
			$nome_p = str_replace('Pizza', '', $nome_p);
			$nome_p = str_replace('pizza', '', $nome_p);
			$nome_p = str_replace('de', '', $nome_p);
		}
		
		$nome_produto .= $nome_p.' / ';

		$query = $pdo->query("SELECT * FROM variacoes_cat where id = '$variacao'");
		$res = $query->fetchAll(PDO::FETCH_ASSOC);			
		$sigla = $res[0]['sigla'];		
		


		$query = $pdo->query("SELECT * FROM variacoes where produto = '$id' and sigla = '$sigla'");
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res) > 0){	
			$valor_p = $res[0]['valor'];	
			$id_variacao = $res[0]['id'];			
		}else{
			$valor_p = 0;
			$id_variacao = "";		
		}

		$valor_produto_media += $valor_p;

		array_push($valor_produto, $valor_p);



}

$nome_produto = substr($nome_produto, 0, -2);	

$valor_produto_media = $valor_produto_media / $total_ids;

if($mais_sabores == 'Média'){
	$valor_produto_final = $valor_produto_media;
}else{
	$valor_produto_final = max($valor_produto);
}


//calcular os adicionais
$total_adicionais = 0;
$query =$pdo->query("SELECT * FROM temp where carrinho = '0' and sessao = '$sessao' and tabela = 'adicionais'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	for($i=0; $i < $total_reg; $i++){
		foreach ($res[$i] as $key => $value){}
			$id_temp = $res[$i]['id'];				
			$id_item = $res[$i]['id_item'];	
			$quantidade_temp = $res[$i]['quantidade'];	

			$query2 =$pdo->query("SELECT * FROM adicionais_cat where id = '$id_item'");
			$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
			$total_reg2 = @count($res2);
			$nome_adc = $res2[0]['nome'];
			$valor_adc = $res2[0]['valor'] * $quantidade_temp;	
			$total_adicionais += $valor_adc;
}
}

$valor_produto_final += $total_adicionais;

//pegar o valor da borda
$query =$pdo->query("SELECT * FROM bordas where id = '$borda'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
$valor_borda = $res[0]['valor'];
}else{
	$valor_borda = 0;
}
$valor_produto_final += $valor_borda;


$query = $pdo->prepare("INSERT INTO carrinho SET sessao = '$sessao', cliente = '0', produto = '$primeiro_id_produto', quantidade = '1', total_item = '$valor_produto_final', obs = :obs, pedido = '0', id_sabor = '0', data = curDate(), variacao = '$id_variacao', mesa = '$mesa', nome_cliente = '', sabores = '$quantidade_sabores', nome_produto = '$nome_produto', borda = '$borda', categoria = '$categoria', status = '$status', hora = curTime()");
$query->bindValue(":obs", "$obs");
$query->execute();
$id_carrinho = $pdo->lastInsertId();
echo 'Inserido com Sucesso';


//limpar os ingredientes e adicionais
$pdo->query("UPDATE temp SET carrinho = '$id_carrinho' where sessao = '$sessao' and carrinho = '0'"); 

