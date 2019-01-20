<?php
$id = $_GET['id'];

$acao = $_GET['acao'];
$id_cliente = $_GET['id_cliente'];


include '../../config/mysql.php';
include '../../config/funcoes.php';
include '../../config/check.php';	

$modulo 	= 'faturas';
$tabela 	= 'faturas';
$atributos 	= 'id_cliente='.$id_cliente;

if ($acao == 'deletar')
{

	mysql_query("DELETE FROM $tabela WHERE id=$id");
	echo '<script>fecharpopup(); '.$modulo.'(\'?'.$atributos.'\'); </script>';
	exit;
		
}
?>
<div class="row-fluid">
        <center><br />
<p>Tem certeza que deseja deletar esta fatura?</p>
      <p><b>
      Esta ação não poderá ser revertida futuramente.</b></p>
      <p>
      <button class="btn btn-danger" onclick="del<?php echo $modulo; ?>(<?php echo $id; ?>,'&<?php echo $atributos; ?>'); return false;"><i class="icon-remove icon-white"></i> Deletar</button>
    </p></center>
    </div>