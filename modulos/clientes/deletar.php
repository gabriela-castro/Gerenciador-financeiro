<?php
$id = $_GET['id'];

$acao = $_GET['acao'];


include '../../config/mysql.php';
include '../../config/funcoes.php';
include '../../config/check.php';	

if ($acao == 'deletar')
{

	mysql_query("DELETE FROM clientes WHERE id=$id");
	echo '<script>fecharpopup(); clientes(\'\'); </script>';
	exit;
		
}
?>
<div class="row-fluid">
        <center><br />
<p>Tem certeza que deseja deletar este Cliente?</p>
      <p><b>
      Esta ação não poderá ser revertida futuramente.</b></p>
      <p>
      <button class="btn btn-danger" onclick="delclientes('<?php echo $id; ?>'); return false;"><i class="icon-remove icon-white"></i> Deletar</button>
    </p></center>
    </div>