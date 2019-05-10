<?php
$id = (isset($_GET['id']) ? $_GET["id"] : '' );

$acao = (isset($_GET['acao']) ? $_GET["acao"] : '' );


include '../../config/mysql.php';
include '../../config/funcoes.php';
include '../../config/check.php';	

$modulo 	= 'conheceu';
$tabela 	= 'conheceu';
$atributos 	= '';

if ($acao == 'deletar')
{

	mysqli_query($link,"DELETE FROM $tabela WHERE id=$id");
	echo '<script>fecharpopup(); '.$modulo.'(\'\'); </script>';
	exit;
		
}
?>
<div class="row-fluid">
        <center><br />
<p>Tem certeza que deseja deletar esta fonte?</p>
      <p><b>
      Esta ação não poderá ser revertida futuramente.</b></p>
      <p>
      <button class="btn btn-danger" onclick="del<?php echo $modulo; ?>(<?php echo $id; ?>); return false;"><i class="icon-remove icon-white"></i> Deletar</button>
    </p></center>
    </div>