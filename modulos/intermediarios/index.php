<?php
include '../../config/mysql.php';
include '../../config/funcoes.php';
include '../../config/check.php';

$modulo = 'intermediarios';
$tabela = 'intermediarios';
$orderby = 'ORDER BY nome';
$atributos = '';


$s = (isset($_GET["s"]) ? $_GET["s"] : '' );
$p = (isset($p) ? $p : '' );

if ($s == '')
{
	$s = 0;
	$filtro = '';
	$imgfiltro = '<button onclick="'.$modulo.'(\'?s=1&p='.$p.'\'); return false;" class="btn btn-small btn-info center" data-toggle="modal">
	<i class="icon-globe"></i></button>';
}
else if ($s == 0)
{
	$filtro = '';
	$imgfiltro = '<button onclick="'.$modulo.'(\'?s=1&p='.$p.'\'); return false;" class="btn btn-small btn-info center" data-toggle="modal">
	<i class="icon-globe"></i></button>';
}
else if ($s == 1)
{
	$filtro = 'WHERE status=1';
	$imgfiltro = '<button onclick="'.$modulo.'(\'?s=2&p='.$p.'\'); return false;" class="btn btn-small btn-success center" data-toggle="modal">
	<i class="icon-thumbs-up"></i></button>';
}
else if ($s == 2)
{
	$filtro = 'WHERE status=2';
	$imgfiltro = '<button onclick="'.$modulo.'(\'?s=0&p='.$p.'\'); return false;" class="btn btn-small btn-danger center" data-toggle="modal">
	<i class="icon-thumbs-down"></i></button>';
}

$numero = numeroentradas($tabela,$filtro);

?>
<script> datatable('#sample_1'); </script>
<div class="widget gray">
                    <div class="widget-title">
                        <h4><i class="icon-reorder"></i> Intermediarios (<?php echo $numero; ?>)</h4>
                            <!--<span class="tools">
                                <button class="btn btn-small" onclick="abrirpopup('modulos/<?php echo $modulo; ?>/form.php?tp=add&<?php echo $atributos; ?>','Adicionar'); return false;"><i class="icon-plus icon-white"></i> Adicionar</button> 
                            </span>-->
                            <span class="tools">
                                <?php echo $imgfiltro; ?>
                            </span>
                    </div>
                    <div class="widget-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                            <tr>
                                <th class="">Operadora</th>
                                <th class="">Email</th>
                                <th class="" width="40">Status</th>
                                <th class="" width="40">Ação</th>
                            </tr>
                            </thead>
                            <tbody>
<?php

$consulta = mysqli_query($link,"SELECT * FROM $tabela $filtro $orderby") or die (mysqli_error());
while($n = mysqli_fetch_array($consulta,MYSQLI_ASSOC))
{

	$id				= $n['id'];
	$nome			= utf8_encode($n['nome']);
	$email			= $n['email'];
	$status			= $n['status'];
		
	
	//STATUS
	if ($status == '1')
	{
		$status = '<button onclick="status(\''.$tabela.'\',1,\''.$id.'\',\''.$modulo.'\'); return false;" class="btn btn-success center" data-toggle="modal"><i class="icon-thumbs-up"></i></button>';
	}
	else if ($status == '2')
	{
		$status = '<button onclick="status(\''.$tabela.'\',2,\''.$id.'\',\''.$modulo.'\'); return false;" class="btn btn-danger center" data-toggle="modal"><i class="icon-thumbs-down"></i></button>';
	}
	
	echo '
		<tr class="odd gradeX">
			<td>'.$nome.'</td>
			<td>'.$email.'</td>
			<td class="" id="status_'.$modulo.'_'.$id.'">'.$status.'</td>
			<td class="center ">
			  <button class="btn btn-primary center" data-toggle="modal" onclick="abrirpopup(\'modulos/'.$modulo.'/form.php?tp=edit&id='.$id.'\',\'Editando\');"><i class="icon-pencil"></i></button>
			</td>
		</tr>';
}
?>
    </tbody>
</table>
  
    </div>
</div>