<?php 
@session_start();
require_once("verificar.php");
require_once("../conexao.php");

if(@$saidas == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}

$pag = 'saidas';

//verificar se ele tem a permissão de estar nessa página
if(@$saidas == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}

?>

<div class="breadcrumb-header justify-content-between">
    <div class="left-content mt-2">


</div>
</div>


<div class="bs-example widget-shadow" style="padding:15px" id="listar">
	
</div>



<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>

