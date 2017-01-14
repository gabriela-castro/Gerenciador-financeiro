<?php
include '../../config/mysql.php';
include '../../config/funcoes.php';
include '../../config/check.php';

$id_cliente 	= $_GET['id_cliente'];
$id_cliente2 	= $_GET['id_cliente'];
$listar 		= $_GET['listar'];

if ($id_cliente == 'undefined' || $abertas == '1')
{
	$id_cliente = '';	
}


$modulo = 'faturas';
$tabela = 'faturas';

$atributos = 'id_cliente='.$id_cliente;

if ($id_cliente == '')
{
	$id_cliente2 = '';
	if ($listar == '1')
	{
		$filtro = 'WHERE status<>5';
	}
	else if ($listar == '2')
	{
		$filtro = 'WHERE status=5';
	}
	
}
else
{

	$filtro = 'WHERE id_cliente='.$id_cliente.'';
		
	$consulta_cliente = mysql_query("SELECT id,fantasia FROM clientes WHERE id='$id_cliente' LIMIT 1") or die (mysql_error());
	$n_cliente = mysql_fetch_array($consulta_cliente);

	$fantasia	= $n_cliente['fantasia'];
}

$numero = numeroentradas($tabela,$filtro);

?>
<script> datatable('#sample_1'); $('#tags_1').tagsInput({width:'auto','defaultText':''}); </script>
<span class="span10">
<input id="tags_1" type="text" class="tags" />
</span>
<span class="span2">
<button class="btn btn-success"><i class="icon-ok"></i> BUSCAR</button>
</span>



                                <div class="widget gray">
                    <div class="widget-title">
                        <h4><i class="icon-reorder"></i> Faturas <?php if ($id_cliente != '') { echo '- '.$fantasia; } ?> (<?php echo $numero; ?>)</h4>
                            <span class="tools">
                                <button class="btn btn-small" onclick="abrirpopup('modulos/<?php echo $modulo; ?>/form.php?tp=add&<?php echo $atributos; ?>','Adicionar'); return false;"><i class="icon-plus icon-white"></i> Adicionar</button>
                            </span>
                            <span class="tools">
                                <?php echo $imgfiltro; ?>
                            </span>
                    </div>
                    <div class="widget-body">
<table class="table table-striped table-bordered table-advance table-hover">
                                    <thead>
                                    <tr>
                                        <th><i class="icon-bullhorn"></i> Company</th>
                                        <th class="hidden-phone"><i class="icon-question-sign"></i> Descrition</th>
                                        <th><i class="icon-bookmark"></i> Profit</th>
                                        <th><i class=" icon-edit"></i> Status</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><a href="#">Vector Ltd</a></td>
                                        <td class="hidden-phone">Lorem Ipsum dorolo imit</td>
                                        <td>12120.00$ </td>
                                        <td><span class="label label-important label-mini">Due</span></td>
                                        <td>
                                            <button class="btn btn-success"><i class="icon-ok"></i></button>
                                            <button class="btn btn-primary"><i class="icon-pencil"></i></button>
                                            <button class="btn btn-danger"><i class="icon-trash "></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#">
                                                Adimin co
                                            </a>
                                        </td>
                                        <td class="hidden-phone">Lorem Ipsum dorolo</td>
                                        <td>56456.00$ </td>
                                        <td><span class="label label-warning label-mini">Due</span></td>
                                        <td>
                                            <button class="btn btn-success"><i class="icon-ok"></i></button>
                                            <button class="btn btn-primary"><i class="icon-pencil"></i></button>
                                            <button class="btn btn-danger"><i class="icon-trash "></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#">
                                                boka soka
                                            </a>
                                        </td>
                                        <td class="hidden-phone">Lorem Ipsum dorolo</td>
                                        <td>14400.00$ </td>
                                        <td><span class="label label-success label-mini">Paid</span></td>
                                        <td>
                                            <button class="btn btn-success"><i class="icon-ok"></i></button>
                                            <button class="btn btn-primary"><i class="icon-pencil"></i></button>
                                            <button class="btn btn-danger"><i class="icon-trash "></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#">
                                                salbal llb
                                            </a>
                                        </td>
                                        <td class="hidden-phone">Lorem Ipsum dorolo</td>
                                        <td>2323.50$ </td>
                                        <td><span class="label label-danger label-mini">Paid</span></td>
                                        <td>
                                            <button class="btn btn-success"><i class="icon-ok"></i></button>
                                            <button class="btn btn-primary"><i class="icon-pencil"></i></button>
                                            <button class="btn btn-danger"><i class="icon-trash "></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">Vector Ltd</a></td>
                                        <td class="hidden-phone">Lorem Ipsum dorolo imit</td>
                                        <td>12120.00$ </td>
                                        <td><span class="label label-important label-mini">Due</span></td>
                                        <td>
                                            <button class="btn btn-success"><i class="icon-ok"></i></button>
                                            <button class="btn btn-primary"><i class="icon-pencil"></i></button>
                                            <button class="btn btn-danger"><i class="icon-trash "></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#">
                                                Adimin co
                                            </a>
                                        </td>
                                        <td class="hidden-phone">Lorem Ipsum dorolo</td>
                                        <td>56456.00$ </td>
                                        <td><span class="label label-warning label-mini">Due</span></td>
                                        <td>
                                            <button class="btn btn-success"><i class="icon-ok"></i></button>
                                            <button class="btn btn-primary"><i class="icon-pencil"></i></button>
                                            <button class="btn btn-danger"><i class="icon-trash "></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">Vector Ltd</a></td>
                                        <td class="hidden-phone">Lorem Ipsum dorolo imit</td>
                                        <td>12120.00$ </td>
                                        <td><span class="label label-important label-mini">Due</span></td>
                                        <td>
                                            <button class="btn btn-success"><i class="icon-ok"></i></button>
                                            <button class="btn btn-primary"><i class="icon-pencil"></i></button>
                                            <button class="btn btn-danger"><i class="icon-trash "></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#">
                                                Adimin co
                                            </a>
                                        </td>
                                        <td class="hidden-phone">Lorem Ipsum dorolo</td>
                                        <td>56456.00$ </td>
                                        <td><span class="label label-warning label-mini">Due</span></td>
                                        <td>
                                            <button class="btn btn-success"><i class="icon-ok"></i></button>
                                            <button class="btn btn-primary"><i class="icon-pencil"></i></button>
                                            <button class="btn btn-danger"><i class="icon-trash "></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">Vector Ltd</a></td>
                                        <td class="hidden-phone">Lorem Ipsum dorolo imit</td>
                                        <td>12120.00$ </td>
                                        <td><span class="label label-important label-mini">Due</span></td>
                                        <td>
                                            <button class="btn btn-success"><i class="icon-ok"></i></button>
                                            <button class="btn btn-primary"><i class="icon-pencil"></i></button>
                                            <button class="btn btn-danger"><i class="icon-trash "></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#">
                                                Adimin com
                                            </a>
                                        </td>
                                        <td class="hidden-phone">Lorem Ipsum dorolo</td>
                                        <td>56456.00$ </td>
                                        <td><span class="label label-warning label-mini">Due</span></td>
                                        <td>
                                            <button class="btn btn-success"><i class="icon-ok"></i></button>
                                            <button class="btn btn-primary"><i class="icon-pencil"></i></button>
                                            <button class="btn btn-danger"><i class="icon-trash "></i></button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                    <br />

                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                            <tr>
                                <th class="">ID</th>
                                <th><?php if ($id_cliente == '') echo 'Cliente /'; ?> Serviço / Observações</th>
                                <th class="">Valor</th>
                                <th class="">Vencimento</th>
                                <th class="">Envio</th>
                                <th class="" width="140">Status</th>
                                <th class="" width="120">Ação</th>
                            </tr>
                            </thead>
                            <tbody>
<?php

$consulta = mysql_query("SELECT * FROM $tabela $filtro ORDER BY vencimento,status") or die (mysql_error());
while($n = mysql_fetch_array($consulta))
{

	$id				= $n['id'];
	$id_cliente		= $n['id_cliente'];
	$vencimento		= data_eua_brasil($n['vencimento']);
	$enviado		= data_hora_eua_brasil($n['enviado']);
	$reenviado		= data_hora_eua_brasil($n['reenviado']);
	$visualizado	= data_hora_eua_brasil($n['visualizado']);
	$fechado		= data_hora_eua_brasil($n['fechado']);
	$id_servico1	= $n['id_servico1'];
	$id_servico2	= $n['id_servico2'];
	$id_servico3	= $n['id_servico3'];
	$id_servico4	= $n['id_servico4'];
	$id_servico5	= $n['id_servico5'];
	$valor1			= $n['valor1'];
	$valor2			= $n['valor2'];
	$valor3			= $n['valor3'];
	$valor4			= $n['valor4'];
	$valor5			= $n['valor5'];
	$status			= $n['status'];
	$obs			= utf8_encode($n['obs']);
	
	// SOMA TODOS O SERVIÇOS
	$valor = $valor1+$valor2+$valor3+$valor4+$valor5;
	
	
	//STATUS
	if ($status == '1')
	{
		$status = '<button onclick="abrirpopup(\'modulos/'.$modulo.'/status.php?id='.$id.'&'.$atributos.'\',\'Fatura #'.$id.'\'); return false;" class="btn btn-danger center" data-toggle="modal"><i class="icon-thumbs-down"></i> PENDENTE</button>';
		$envio = '<button onclick="abrirpopup(\'modulos/'.$modulo.'/envio.php?id='.$id.'&'.$atributos.'&funcao=envio\',\'Envio manual\'); return false;" class="btn btn-danger center" data-toggle="modal"><i class="icon-envelope"></i></button>';
	}
	else if ($status == '2')
	{
		$status = '<button onclick="abrirpopup(\'modulos/'.$modulo.'/status.php?id='.$id.'&'.$atributos.'\',\'Fatura #'.$id.'\'); return false;" class="btn btn-warning center" data-toggle="modal"><i class="icon-signin"></i> ENVIADO</button><br>'.$enviado;
		$envio = '<button onclick="abrirpopup(\'modulos/'.$modulo.'/envio.php?id='.$id.'&'.$atributos.'&funcao=reenvio\',\'Reenvio manual\'); return false;" class="btn btn-warning center" data-toggle="modal"><i class="icon-retweet"></i></button>';
	}
	else if ($status == '3')
	{
		$status = '<button onclick="abrirpopup(\'modulos/'.$modulo.'/status.php?id='.$id.'&'.$atributos.'\',\'Fatura #'.$id.'\'); return false;" class="btn btn-primary center" data-toggle="modal"><i class="icon-retweet"></i> REENVIADO</button><br>'.$reenviado;
		$envio = '<button onclick="abrirpopup(\'modulos/'.$modulo.'/envio.php?id='.$id.'&'.$atributos.'&funcao=reenvio\',\'Reenvio manual\'); return false;" class="btn btn-primary center" data-toggle="modal"><i class="icon-retweet"></i></button>';
	}
	else if ($status == '4')
	{
		$status = '<button onclick="abrirpopup(\'modulos/'.$modulo.'/status.php?id='.$id.'&'.$atributos.'\',\'Fatura #'.$id.'\'); return false;" class="btn btn-info center" data-toggle="modal"><i class="icon-check"></i> VISUALIZADO</button><br>'.$visualizado;
		$envio = '<button onclick="abrirpopup(\'modulos/'.$modulo.'/envio.php?id='.$id.'&'.$atributos.'&funcao=reenvio\',\'Reenvio manual\'); return false;" class="btn btn-info center" data-toggle="modal"><i class="icon-retweet"></i></button>';
	}
	else if ($status == '5')
	{
		$status = '<button onclick="abrirpopup(\'modulos/'.$modulo.'/status.php?id='.$id.'&'.$atributos.'\',\'Fatura #'.$id.'\'); return false;" class="btn btn-success center" data-toggle="modal"><i class="icon-thumbs-up"></i> FECHADO</button><br>'.$fechado;
		$envio = '<button onclick="" class="btn disabled center" data-toggle="modal"><i class="icon-envelope"></i></button>';
	}
	 
	// CONSULTA CLIENTE
	$cliente = chamacampo('clientes','fantasia',$id_cliente);
	
	// TOTAL DE SERVIÇOS
	$servico1 = chamacampo('tiposervicos','nome',$id_servico1);
	$servico2 = chamacampo('tiposervicos','nome',$id_servico2);
	$servico3 = chamacampo('tiposervicos','nome',$id_servico3);
	$servico4 = chamacampo('tiposervicos','nome',$id_servico4);
	$servico5 = chamacampo('tiposervicos','nome',$id_servico5);
	
	$servicos = $servico1;
	
	if ($id_servico2 != 0)
	{
		$servicos .= ' | '.$servico2;
	}
	if ($id_servico3 != 0)
	{
		$servicos .= ' | '.$servico3;
	}
	if ($id_servico4 != 0)
	{
		$servicos .= ' | '.$servico4;
	}
	if ($id_servico5 != 0)
	{
		$servicos .= ' | '.$servico5;
	}
	
		//MOSTRA CLIENTES
	if ($id_cliente2 == '')
	{
		$mcliente = '<b>'.$cliente.'</b><br>';
	}
	else
	{
		$mcliente = '';
	}
		
	// CALCULA DIAS
	$dias = calculadias(date('Y-m-d'),data_brasil_eua($vencimento));

	if ($dias == 0)
	{
		$dias = '<span class="badge  badge-mini">HOJE</span>';
	}
	else if ($dias == 1)
	{
		$dias = '<span class="badge badge-info badge-mini">Falta '.$dias.' dia</span>';
	}
	else if ($dias > 1)
	{
		$dias = '<span class="badge badge-info badge-mini">Faltam '.$dias.' dias</span>';
	}
	else if ($dias == 1)
	{
		$dias = '<span class="badge badge-important badge-mini">Atrasado '.negativo($dias).' dia</span>';
	}
	else if ($dias < 1)
	{
		$dias = '<span class="badge badge-important badge-mini">Atrasado '.negativo($dias).' dias</span>';
	}
	
	
	echo '
		<tr class="odd gradeX">
			<td>#'.$id.'</td>
			<td><a href="#faturas#'.$id_cliente.'" onclick="faturas(\'?id_cliente='.$id_cliente.'\');">'.$mcliente.'</a><span class="text-error">'.$servicos.'</span><br>'.$obs.'</td>
			<td class="text-success "><b>R$ '.moeda($valor).'</b></td>
			<td class="">'.$vencimento.'<br>'.$dias.'</td>
			<td class="" id="envio_'.$id.'">'.$envio.'</td>
			<td class="" id="status_'.$modulo.'_'.$id.'">'.$status.'</td>
			<td class="center ">
			  <button class="btn btn-inverse  center" data-toggle="modal" onclick="abrirurl(\''.$urlsistema.'fatura.php?i='.decbin($id).'&v=1\',\'Visualizando\');"><i class="icon-barcode"></i></button>
			  <button class="btn btn-primary center" data-toggle="modal" onclick="abrirpopup(\'modulos/'.$modulo.'/form.php?tp=edit&id='.$id.'\',\'Editando\');"><i class="icon-pencil"></i></button>
			  <button class="btn btn-danger center" data-toggle="modal" onclick="abrirpopup(\'modulos/'.$modulo.'/deletar.php?id='.$id.'&'.$atributos.'\',\'Deletando\');"><i class="icon-trash"></i></button>
			</td>
		</tr>';
}
?>
    </tbody>
</table>
  
    </div>
</div>