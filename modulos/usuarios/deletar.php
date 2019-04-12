<?php
$id = $_GET['id'];

$acao = (isset($_GET['acao']) ? $_GET['acao'] : '');


include '../../config/mysql.php';
include '../../config/funcoes.php';
include '../../config/check.php';	

if ($acao == 'deletar')
{
    $sql = "DELETE FROM usuarios WHERE id=$id";
	mysqli_query($link,$sql);
	echo '<script>fecharpopup(); usuarios(\'\'); </script>';
	exit;
		
}
?>
<div class="row-fluid">
        <center><br />
<p>Tem certeza que deseja deletar este usuário?</p>
      <p><b>
      Esta ação não poderá ser revertida futuramente.</b></p>
      <p>
      <button class="btn btn-danger" onclick="delusuario(<?php echo $id; ?>); return false;"><i class="icon-remove icon-white"></i> Deletar</button>
    </p></center>
    </div>