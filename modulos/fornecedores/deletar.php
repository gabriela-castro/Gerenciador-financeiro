<?php
$id = $_GET['id'];

$acao = (isset($_GET['acao']) ? $_GET['acao'] : '');


include '../../config/mysql.php';
include '../../config/funcoes.php';
include '../../config/check.php';	

if ($acao == 'deletar')
{

	mysqli_query($link,"DELETE FROM clientes WHERE id=$id") or die('Erro gerado -> '. mysqli_error($link) . '<br/>' .$sql);;
	echo '<script>fecharpopup(); fornecedores(\'\'); </script>';
	exit;
		
}
?>
<div class="row-fluid">
        <center><br />
<p>Tem certeza que deseja deletar este Cliente?</p>
      <p><b>
      Esta ação não poderá ser revertida futuramente.</b></p>
      <p>
      <button class="btn btn-danger" onclick="delfornecedores('<?php echo $id; ?>'); return false;"><i class="icon-remove icon-white"></i> Deletar</button>
    </p></center>
    </div>