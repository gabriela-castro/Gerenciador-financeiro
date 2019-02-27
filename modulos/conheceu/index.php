<?php
include '../../config/mysql.php';
include '../../config/funcoes.php';
include '../../config/check.php';


$numero = numeroentradas('conheceu','');

?>
<script> datatable('#sample_1'); </script>
<div class="widget gray">
                    <div class="widget-title">
                        <h4><i class="icon-reorder"></i> Como Conheceu (<?php echo $numero; ?>)</h4>
                            <span class="tools">
                                <button class="btn btn-small" onclick="abrirpopup('modulos/conheceu/form.php?tp=add','Adicionar'); return false;"><i class="icon-plus icon-white"></i> Adicionar</button>
                            </span>
                    </div>
                    <div class="widget-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                            <tr>
                                <th>Fonte</th>
                                <th class="hidden-phone" width="50">Data</th>
                                <th class="" width="80">Ação</th>
                            </tr>
                            </thead>
                            <tbody>
<?php



$consulta = mysqli_query($link,"SELECT * FROM conheceu ORDER BY nome DESC") or die (mysqli_error());
while($n = mysqli_fetch_array($consulta,MYSQLI_ASSOC))
{

	$id			= $n['id'];
	$nome		= utf8_encode($n['nome']);
	$data		= data_hora_eua_brasil($n['data']);

	
	echo '
		<tr class="odd gradeX">
			<td>'.$nome.'</td>
			<td class="hidden-phone">'.$data.'</td>
			<td class="center ">
			  <button class="btn btn-primary center" data-toggle="modal" onclick="abrirpopup(\'modulos/conheceu/form.php?tp=edit&id='.$id.'\',\'Editando\');"><i class="icon-pencil"></i></button>
			  <button class="btn btn-danger center" data-toggle="modal" onclick="abrirpopup(\'modulos/conheceu/deletar.php?id='.$id.'\',\'Deletando\');"><i class="icon-trash"></i></button>
			  </td>
		</tr>';
}
?>
    </tbody>
</table>
  
    </div>
</div>