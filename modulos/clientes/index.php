<?php
include '../../config/mysql.php';
include '../../config/funcoes.php';
include '../../config/check.php';

$modulo = 'clientes';
$tabela = 'clientes';

$s = (isset($_GET["s"]) ? $_GET["s"] : '' );
$p = (isset($p) ? $p : '' );

if ($s == '')
{
	$s = 1;
	$filtro = 'WHERE status=1 and cli_for=1';
	$imgfiltro = '<button onclick="'.$modulo.'(\'?s=2&p='.$p.'\'); return false;" class="btn btn-small btn-success center" data-toggle="modal">
	<i class="icon-thumbs-up"></i></button>';
}
else if ($s == 0)
{
	$filtro = '';
	$imgfiltro = '<button onclick="'.$modulo.'(\'?s=1&p='.$p.'\'); return false;" class="btn btn-small btn-info center" data-toggle="modal">
	<i class="icon-globe"></i></button>';
}
else if ($s == 1)
{
	$filtro = 'WHERE status=1 and cli_for=1';
	$imgfiltro = '<button onclick="'.$modulo.'(\'?s=2&p='.$p.'\'); return false;" class="btn btn-small btn-success center" data-toggle="modal">
	<i class="icon-thumbs-up"></i></button>';
}
else if ($s == 2)
{
	$filtro = 'WHERE status=2 and cli_for=1';
	$imgfiltro = '<button onclick="'.$modulo.'(\'?s=0&p='.$p.'\'); return false;" class="btn btn-small btn-danger center" data-toggle="modal">
	<i class="icon-thumbs-down"></i></button>';
}


$numero = numeroentradas($tabela,$filtro);

?>
<script> datatable('#sample_1'); </script>
<div class="widget gray">
                    <div class="widget-title">
                        <h4><i class="icon-reorder"></i> Clientes (<?php echo $numero; ?>)</h4>
                            <span class="tools">
                                <button class="btn btn-small" onclick="abrirpopup('modulos/<?php echo $modulo; ?>/form.php?tp=add','Adicionar'); return false;"><i class="icon-plus icon-white"></i> Adicionar</button>
                            </span>
                            <span class="tools">
                                <?php echo $imgfiltro; ?>
                            </span>
                    </div>
                    <div class="widget-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                            <tr>
                                <th>Nome / Responsável</th>
                                <th class="hidden-phone">Filial / Tipo</th>
                                <th class="">Telefones</th>
                                <?php if ($s == 0) { ?><th class="">Status</th><?php } ?>
                                <th class="" width="120">Faturas</th>
                                <th class="" width="120">Ação</th>
                            </tr>
                            </thead>
                            <tbody>
<?php

$consulta = mysqli_query($link,"SELECT * FROM $tabela $filtro ORDER BY nome") or die (mysqli_error());
while($n = mysqli_fetch_array($consulta,MYSQLI_ASSOC))
{

	$id			= $n['id'];
	$id_filial	= $n['id_filial'];
	$tipo		= $n['tipo'];
	$nome		= utf8_encode($n['nome']);
	$fantasia	= utf8_encode($n['fantasia']);
	//$email		= utf8_encode($n['email']);
	$tel1		= utf8_encode($n['tel1']);
	$tel2		= utf8_encode($n['tel2']);
	$data		= data_hora_eua_brasil($n['data']);
	$status		= $n['status'];
	
	//TELEFONES
	if ($tel2 == '')
	{
		$telefones = $tel1;
	}
	else
	{
		$telefones = $tel1.'<br>'.$tel2;
	}
	
	//TIPO
	if ($tipo == '1')
	{
		$tipo = '<span class="badge badge-important badge-mini">Jurídica</span>';
	}
	else if ($tipo == '2')
	{
		$tipo = '<span class="badge badge-info badge-mini">Física</span>';
	}
	
	//STATUS
	if ($status == '1')
	{
		$status = '<button onclick="status(\''.$tabela.'\',1,\''.$id.'\',\''.$modulo.'\'); return false;" class="btn btn-success center" data-toggle="modal"><i class="icon-thumbs-up"></i></button>';
	}
	else if ($status == '2')
	{
		$status = '<button onclick="status(\''.$tabela.'\',2,\''.$id.'\',\''.$modulo.'\'); return false;" class="btn btn-danger center" data-toggle="modal"><i class="icon-thumbs-down"></i></button>';
	}
	 
	 
	$faturas = numeroentradas('faturas','WHERE id_cliente='.$id.'');
	
	// CONSULTA FILIAL
	$consulta_filial = mysqli_query($link,"SELECT nome FROM filiais WHERE id='$id_filial'") or die (mysqli_error());
	$n_filial = mysqli_fetch_array($consulta_filial,MYSQLI_ASSOC);

	$filial	= utf8_encode($n_filial['nome']);

	
	echo '
		<tr class="odd gradeX">
			<td><b>'.$fantasia.'</b><br><span class="text-error">'.$nome.'</span></td>
			<td class="text-success hidden-phone"><b>'.$filial.'</b><br>'.$tipo.'</td>
			<td class="">'.$telefones.'</td>';
			if ($s == 0) {
			echo '<td class="" id="status_'.$modulo.'_'.$id.'">'.$status.'</td>';
			}
			echo '
			<td>
				<button class="btn btn-info  center" data-toggle="modal" onclick="faturas(\'?id_cliente='.$id.'\'); ancora(\'#faturas#'.$id.'\');"><i class="icon-barcode"> '.$faturas.'</i></button>
			</td>
			<td class="center ">
			  <button class="btn btn-warning  center" data-toggle="modal" onclick="abrirpopup(\'modulos/'.$modulo.'/form.php?tp=ver&id='.$id.'\',\'Visualizando\');"><i class="icon-eye-open"></i></button>
			  <button class="btn btn-primary center" data-toggle="modal" onclick="abrirpopup(\'modulos/'.$modulo.'/form.php?tp=edit&id='.$id.'\',\'Editando\');"><i class="icon-pencil"></i></button>
			  <button class="btn btn-danger center" data-toggle="modal" onclick="abrirpopup(\'modulos/'.$modulo.'/deletar.php?id='.$id.'\',\'Deletando\');"><i class="icon-trash"></i></button>
			</td>
		</tr>';
}
?>
    </tbody>
</table>
  
    </div>
</div>