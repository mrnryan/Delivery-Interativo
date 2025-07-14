<?php 

include('../../conexao.php');


$id = $_GET['id'];
$enviar = $_GET['enviar'];


//ALIMENTAR OS DADOS NO RELATÓRIO
$html = file_get_contents($url_sistema."sistema/painel/rel/comprovante2.php?id=$id");


//CARREGAR DOMPDF
require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;


header("Content-Transfer-Encoding: binary");
header("Content-Type: image/png");

//INICIALIZAR A CLASSE DO DOMPDF
$options = new Options();
$options->set('isRemoteEnabled', TRUE);
$pdf = new DOMPDF($options);


//Definir o tamanho do papel e orientação da página
$pdf->set_paper(array(0, 0, 420.28, 600.89));
//CARREGAR O CONTEÚDO HTML
$pdf->load_html($html);

//RENDERIZAR O PDF
$pdf->render();

//NOMEAR O PDF GERADO

$output = $pdf->output();
$arquivo = "../pdf/comprovantes/comprovante".$id.".pdf";
	
if(file_put_contents($arquivo,$output) <> false) {
	$pdf->stream(
	'comprovante.pdf',
	array("Attachment" => false)
);

}

$query = $pdo->query("SELECT * from vendas where id = '$id' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$cliente = $res[0]['cliente'];

$query = $pdo->query("SELECT * from clientes where id = '$cliente' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$telefone = $res[0]['telefone'];

//enviar relatório para o whatsapp
// if($enviar == 'sim'){
// $tel_cliente_whats = '55'.preg_replace('/[ ()-]+/' , '' , $telefone);
// $mensagem = '';
// $url_envio = $url_sistema."sistema/painel/pdf/comprovantes/comprovante".$id.".pdf";
// require("../../../js/ajax/api3.php");
// }

 ?>