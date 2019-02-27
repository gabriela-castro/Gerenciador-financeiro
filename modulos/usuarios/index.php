<?php
include '../../config/mysql.php';
include '../../config/funcoes.php';
include '../../config/check.php';


$p = (isset($_GET["p"]) ? $_GET["p"] : '' );
$sql1 = mysqli_query($link,"SELECT * FROM usuarios");
$numero = mysqli_num_rows($sql1);

?>
<script> datatable('#sample_1'); </script>
<div class="widget gray">
                    <div class="widget-title">
                        <h4><i class="icon-reorder"></i> Usuários (<?php echo $numero; ?>)</h4>
                            <span class="tools">
                                <button class="btn btn-small" onclick="abrirpopup('modulos/usuarios/adicionar.php','Adicionar'); return false;"><i class="icon-plus icon-white"></i> Adicionar</button>
                            </span>
                    </div>
                    <div class="widget-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th class="hidden-phone">Usuário</th>
                                <th class="hidden-phone">Email</th>
                                <th class="" width="80">Ação</th>
                            </tr>
                            </thead>
                            <tbody>
<?php



$consulta = mysqli_query($link,"SELECT * FROM usuarios ORDER BY nome DESC") or die (mysqli_error());
while($n = mysqli_fetch_array($consulta,MYSQLI_ASSOC))
{

	$id			= $n['id'];
	$nome		= utf8_encode($n['nome']);
	$login		= utf8_encode($n['login']);
	$email		= utf8_encode($n['email']);

	echo '
		<tr class="odd gradeX">
			<td>'.$nome.'</td>
			<td class="hidden-phone">'.$login.'</td>
			<td class="hidden-phone">'.$email.'</td>
			<td class="center ">
			  <button class="btn btn-primary center" data-toggle="modal" onclick="abrirpopup(\'modulos/usuarios/editar.php?id='.$id.'\',\'Editando\');"><i class="icon-pencil"></i></button>
			  <button class="btn btn-danger center" data-toggle="modal" onclick="abrirpopup(\'modulos/usuarios/deletar.php?id='.$id.'\',\'Deletando\');"><i class="icon-trash"></i></button>
			  </td>
		</tr>';
}
?>
    </tbody>
</table>
  
    </div>
</div>