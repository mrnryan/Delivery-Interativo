<?php 
$tabela = 'arquivos';
require_once("../../../../conexao.php");
@session_start();
$id_usuario = @$_SESSION['id'];

$id = $_POST['id-arquivo'];
$nome = $_POST['nome-arq'];

$query = $pdo->query("SELECT * FROM receber where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$cliente = $res[0]['cliente'];
}else{	
	$cliente = "0";
}


//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['arquivo_conta']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);
$caminho = '../../images/arquivos/' .$nome_img;

$imagem_temp = @$_FILES['arquivo_conta']['tmp_name']; 

if(@$_FILES['arquivo_conta']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif' or $ext == 'webp' or $ext == 'PNG' or $ext == 'JPG' or $ext == 'JPEG' or $ext == 'GIF' or $ext == 'PDF' or $ext == 'RAR' or $ext == 'WEBP' or $ext == 'pdf' or $ext == 'rar' or $ext == 'zip' or $ext == 'doc' or $ext == 'docx' or $ext == 'txt' or $ext == 'xlsx' or $ext == 'xlsm' or $ext == 'xls' or $ext == 'xml' ){ 

		if (@$_FILES['arquivo_conta']['name'] != ""){			

			$foto = $nome_img;
		}

		//pegar o tamanho da imagem
			list($largura, $altura) = getimagesize($imagem_temp);
		 	if($largura > 1400){
		 		if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif' or $ext == 'webp' or $ext == 'PNG' or $ext == 'JPG' or $ext == 'JPEG' or $ext == 'GIF' or $ext == 'WEBP'){
		 			$image = imagecreatefromjpeg($imagem_temp);
			        // Reduza a qualidade para 20% ajuste conforme necessário
			        imagejpeg($image, $caminho, 20);
			        imagedestroy($image);
		 		}else{
		 			move_uploaded_file($imagem_temp, $caminho);
		 		}
			 		
		 	}else{
		 		move_uploaded_file($imagem_temp, $caminho);
		 	}
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}else{
	echo 'Insira um Arquivo!';
	exit();
}

$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome,  data_cad = curDate(), usuario = '$id_usuario', arquivo = '$foto', registro = 'Conta à Receber', id_reg = '$id'");

$query->bindValue(":nome", "$nome");
$query->execute();


if($cliente != "0"){
	$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome,  data_cad = curDate(), usuario = '$id_usuario', arquivo = '$foto', registro = 'Cliente', id_reg = '$cliente'");
	$query->bindValue(":nome", "$nome");
	$query->execute();
	
}



echo 'Inserido com Sucesso';

?>