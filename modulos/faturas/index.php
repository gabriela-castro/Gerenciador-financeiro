<?php
include '../../config/mysql.php';
include '../../config/funcoes.php';
include '../../config/check.php';

$id_cliente 	= (isset($_GET['id_cliente']) ? $_GET['id_cliente'] : '' );
$id_cliente2 	= (isset($_GET['id_cliente']) ? $_GET['id_cliente'] : '' );
$listar 		= (isset($_GET['listar']) ? $_GET['listar'] : '' );
$abertas        = (isset($abertas) ? $abertas : '' );

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
	if ($listar == '')
	{
		@$ano = $_GET["ano"];
		@$mes = $_GET["mes"];
		
		if ($mes == NULL)
		{
			$mes = date('m');
		}
		else if ($mes == 13)
		{
			$ano = $ano+1;
			$mes = 1;
		}
		else if ($mes == 0)
		{
			$ano = $ano-1;
			$mes = 12;	
		}
		
		if ($ano == NULL)
		{
			$ano = date('Y');
		}
		if (strlen($mes) == 1)
		{
			$mes = '0'.$mes;
		}
		else
		{
			$mes = $mes;
		}
		
		$fdata1 = $ano.'-'.$mes.'-01';
		$fdata2 = $ano.'-'.$mes.'-31';
		$atributos 	= '&mes='.$mes.'&ano='.$ano.'';
		$filtro		= "WHERE vencimento>='$fdata1' AND vencimento<='$fdata2' AND status<>5";
	}
	else if ($listar == '1')
	{
		$filtro = 'WHERE status<>5';
	}
	else if ($listar == '2')
	{
		$filtro = 'WHERE status=5';
	}
	else if ($listar == '3')
	{
		$data10 = date('Y-m-d', strtotime("-10 days"));
		$filtro = "WHERE vencimento<='$data10' AND status<>5";
	}
	
}
else
{

	$filtro = 'WHERE id_cliente='.$id_cliente.'';
	$sql = "SELECT id,fantasia FROM clientes WHERE id='$id_cliente' LIMIT 1";	
	$consulta_cliente = mysqli_query($link,$sql)  or die('Erro gerado -> ' .mysqli_error($link).'<>'.$sql);
	$n_cliente = mysqli_fetch_array($consulta_cliente,MYSQLI_ASSOC);

	$fantasia	= utf8_encode($n_cliente['fantasia']);
}

$numero = numeroentradas($tabela,$filtro);

?>
<script> datatable('#sample_1'); </script>
<div class="widget gray">
                    <div class="widget-title">
                        <h4><i class="icon-reorder"></i> Faturas <?php if ($id_cliente != '') { echo '- '.$fantasia; } ?> (<?php echo $numero; ?>)</h4>
                            <span class="tools">
                                <button class="btn btn-small" onclick="abrirpopup('modulos/<?php echo $modulo; ?>/form.php?tp=add&<?php echo $atributos; ?>','Adicionar'); return false;"><i class="icon-plus icon-white"></i> Adicionar</button>
                            </span>
                            <span class="tools">
                                <?php echo @$imgfiltro; ?>
                            </span>
                            <?php if ($id_cliente == '' && $listar == '') { ?>
                            <span class="tools">
                                <button class="btn btn-small btn-primary" onclick="<?php echo $modulo; ?>('?mes=<?php echo $mes-1; ?>&ano=<?php echo $ano; ?>');"><i class="icon-circle-arrow-left"></i></button>
                                <button class="btn btn-small btn-primary" onclick="<?php echo $modulo; ?>('?mes=<?php echo $mes; ?>&ano=<?php echo $ano; ?>');"><?php echo mesextenco($mes).' de '.$ano; ?></button>
                                <button class="btn btn-small btn-primary" onclick="<?php echo $modulo; ?>('?mes=<?php echo $mes+1; ?>&ano=<?php echo $ano; ?>');"><i class="icon-circle-arrow-right"></i></button>
                            </span>
                            <?php } ?>
                    </div>
                    <div class="widget-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                            <tr>
                                <th class="">ID</th>
                                <th><?php if ($id_cliente == '') echo 'Cliente /'; ?> Serviço / Observações</th>
                                <th class="">Valor</th>
                                <th class="">Vencimento</th>
								<?php if ($listar != '2') { ?>
                                <th class="">Envio</th>
								<?php } ?>
                                <th class="" width="140">Status</th>
                                <th class="" width="160">Ação</th>
                            </tr>
                            </thead>
                            <tbody>
<?php
$sql = "SELECT * FROM $tabela $filtro ORDER BY vencimento,status"; 
$consulta = mysqli_query($link,$sql) or die('Erro gerado -> ' .mysqli_error($link).'<>'.$sql);
while($n = mysqli_fetch_array($consulta,MYSQLI_ASSOC))
{

	$id				= $n['id'];
	$id_cliente		= $n['id_cliente'];
	$vencimento		= (isset($n['vencimento']) ? data_eua_brasil($n['vencimento']) : '');
	$enviado		= (isset($n['enviado']) ? data_hora_eua_brasil($n['enviado']) : '');
	$reenviado		= (isset($n['reenviado']) ? data_hora_eua_brasil($n['reenviado']) : '');
	$visualizado	= (isset($n['visualizado']) ? data_hora_eua_brasil($n['visualizado']) : '');
	$fechado		= (isset($n['fechado']) ? data_hora_eua_brasil($n['fechado']) : '');;
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
	$status1		= $n['status'];
	$status			= $n['status'];
	$obs			= utf8_encode($n['obs']);
	
	// SOMA TODOS O SERVIÇOS
	$valor = $valor1+$valor2+$valor3+$valor4+$valor5;
	
	
	//STATUS
	if ($status == '1')
	{
		$fechado = '';
		$status = '<button onclick="abrirpopup(\'modulos/'.$modulo.'/status.php?id='.$id.'&'.$atributos.'\',\'Fatura #'.$id.'\'); return false;" class="btn btn-danger center" data-toggle="modal"><i class="icon-thumbs-down"></i> PENDENTE</button>';
		$envio = '<button onclick="abrirpopup(\'modulos/'.$modulo.'/envio.php?id='.$id.'&'.$atributos.'&funcao=envio\',\'Envio manual\'); return false;" class="btn btn-danger center" data-toggle="modal"><i class="icon-envelope"></i></button>';
	}
	else if ($status == '2')
	{
		$fechado = '';
		$status = '<button onclick="abrirpopup(\'modulos/'.$modulo.'/status.php?id='.$id.'&'.$atributos.'\',\'Fatura #'.$id.'\'); return false;" class="btn btn-warning center" data-toggle="modal"><i class="icon-signin"></i> ENVIADO</button><br>'.$enviado;
		$envio = '<button onclick="abrirpopup(\'modulos/'.$modulo.'/envio.php?id='.$id.'&'.$atributos.'&funcao=reenvio\',\'Reenvio manual\'); return false;" class="btn btn-warning center" data-toggle="modal"><i class="icon-retweet"></i></button>';
	}
	else if ($status == '3')
	{
		$fechado = '';
		$status = '<button onclick="abrirpopup(\'modulos/'.$modulo.'/status.php?id='.$id.'&'.$atributos.'\',\'Fatura #'.$id.'\'); return false;" class="btn btn-primary center" data-toggle="modal"><i class="icon-retweet"></i> REENVIADO</button><br>'.$reenviado;
		$envio = '<button onclick="abrirpopup(\'modulos/'.$modulo.'/envio.php?id='.$id.'&'.$atributos.'&funcao=reenvio\',\'Reenvio manual\'); return false;" class="btn btn-primary center" data-toggle="modal"><i class="icon-retweet"></i></button>';
	}
	else if ($status == '4')
	{
		$fechado = '';
		$status = '<button onclick="abrirpopup(\'modulos/'.$modulo.'/status.php?id='.$id.'&'.$atributos.'\',\'Fatura #'.$id.'\'); return false;" class="btn btn-info center" data-toggle="modal"><i class="icon-check"></i> VISUALIZADO</button><br>'.$visualizado;
		$envio = '<button onclick="abrirpopup(\'modulos/'.$modulo.'/envio.php?id='.$id.'&'.$atributos.'&funcao=reenvio\',\'Reenvio manual\'); return false;" class="btn btn-info center" data-toggle="modal"><i class="icon-retweet"></i></button>';
	}
	else if ($status == '5')
	{
		$fechado = '<span class="text-success"><b>'.$fechado.'</b></span>';
		$status = '<button onclick="abrirpopup(\'modulos/'.$modulo.'/status.php?id='.$id.'&'.$atributos.'\',\'Fatura #'.$id.'\'); return false;" class="btn btn-success center" data-toggle="modal"><i class="icon-thumbs-up"></i> FECHADO</button>';
		$envio = '';
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
	
	if ($envio == '')
	{
		$dias = '';
	}
	else { }
	
	echo '
		<tr class="odd gradeX">
			<td>#'.$id.'</td>
			<td><a href="#faturas#'.$id_cliente.'" onclick="faturas(\'?id_cliente='.$id_cliente.'\');">'.$mcliente.'</a><span class="text-error">'.$servicos.'</span><br>'.$obs.'</td>
			<td class="text-success "><b>R$ '.moeda($valor).'</b></td>
			<td class=""><span class="text-error"><b>'.$vencimento.'<b></span><br>'.$dias.$fechado.'</td>';
			if ($listar != '2')
			{ 
			echo '<td class="" id="envio_'.$id.'">'.$envio.'</td>';
			}
			echo '
			<td class="" id="status_'.$modulo.'_'.$id.'">'.$status.'</td>
			<td class="center ">
			  <button class="btn btn-inverse  center" data-toggle="modal" onclick="abrirurl(\''.$urlsistema.'fatura.php?i='.decbin($id).'&v=1\',\'Visualizando\');"><i class="icon-barcode"></i></button>
			  <button class="btn btn-primary center" data-toggle="modal" onclick="abrirpopup(\'modulos/'.$modulo.'/form.php?tp=edit&id='.$id.'\',\'Editando\');"><i class="icon-pencil"></i></button>
			  <button class="btn btn-default center" data-toggle="modal" onclick="abrirpopup(\'modulos/'.$modulo.'/form.php?tp=copia&id='.$id.'\',\'Copiando\');"><i class="icon-copy"></i></button>
			  <button class="btn btn-danger center" data-toggle="modal" onclick="abrirpopup(\'modulos/'.$modulo.'/deletar.php?id='.$id.'&'.$atributos.'\',\'Deletando\');"><i class="icon-trash"></i></button>
			</td>
		</tr>';
}
?>
    </tbody>
</table>
  
    </div>
</div>