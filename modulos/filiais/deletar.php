<?php
$id = $_GET['id'];

$acao = $_GET['acao'];


include '../../config/mysql.php';
include '../../config/funcoes.php';
include '../../config/check.php';	

$modulo 	= 'filiais';
$tabela 	= 'filiais';
$atributos 	= '';

if ($acao == 'deletar')
{

	mysql_query("DELETE FROM $tabela WHERE id=$id");
	echo '<script>fecharpopup(); '.$modulo.'(\'\'); </script>';
	exit;
		
}
?>
<div class="row-fluid">
        <center><br />
<p>Tem certeza que deseja deletar esta filial?</p>
      <p><b>
      Esta ação não poderá ser revertida futuramente.</b></p>
      <p>
      <button class="btn btn-danger" onclick="del<?php echo $modulo; ?>(<?php echo $id; ?>); return false;"><i class="icon-remove icon-white"></i> Deletar</button>
    </p></center>
    </div>