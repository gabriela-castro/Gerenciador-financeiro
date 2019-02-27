<?php
include '../../config/mysql.php';
include '../../config/funcoes.php';
include '../../config/check.php';

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


$modulo 	= 'contasapagar';
$tabela 	= 'contasapagar';
$atributos 	= '&mes='.$mes.'&ano='.$ano.'';
$filtro		= "WHERE vencimento>='$fdata1' AND vencimento<='$fdata2'";
$orderby 	= 'ORDER BY data DESC';

$numero = numeroentradas($tabela,$filtro);

?>
<script> datatable('#sample_1'); </script>
<div class="widget gray">
                    <div class="widget-title">
                        <h4><i class="icon-reorder"></i> Contas a pagar (<?php echo $numero; ?>)</h4>
                            <span class="tools">
                                <button class="btn btn-small" onclick="abrirpopup('modulos/<?php echo $modulo; ?>/form.php?tp=add<?php echo $atributos; ?>','Adicionar'); return false;"><i class="icon-plus icon-white"></i> Adicionar</button>
                            </span>
                            <span class="tools">
                                <button class="btn btn-small btn-primary" onclick="<?php echo $modulo; ?>('?mes=<?php echo $mes-1; ?>&ano=<?php echo $ano; ?>');"><i class="icon-circle-arrow-left"></i></button>
                                <button class="btn btn-small btn-primary" onclick="<?php echo $modulo; ?>('?mes=<?php echo $mes; ?>&ano=<?php echo $ano; ?>');"><?php echo mesextenco($mes).' de '.$ano; ?></button>
                                <button class="btn btn-small btn-primary" onclick="<?php echo $modulo; ?>('?mes=<?php echo $mes+1; ?>&ano=<?php echo $ano; ?>');"><i class="icon-circle-arrow-right"></i></button>
                            </span>
                    </div>
                    <div class="widget-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                            <tr>
                                <th width="100">Vencimento</th>
                                <th>Titulo / Observações</th>
                                <th class="" width="80">Valor</th>
                                <th class="" width="120">Status</th>
                                <th class="" width="80">Ação</th>
                            </tr>
                            </thead>
                            <tbody>
<?php



$consulta = mysqli_query($link,"SELECT * FROM $tabela $filtro $orderby") or die (mysqli_error());
while($n = mysqli_fetch_array($consulta,MYSQLI_ASSOC))
{
	
	$id				= $n['id'];
	$titulo			= utf8_encode($n['titulo']);
	$valor			= moeda($n['valor']);
	$valor_pago		= moeda($n['valor_pago']);
	$vencimento		= data_eua_brasil($n['vencimento']);
	$pagamento		= data_eua_brasil($n['pagamento']);
	$obs			= utf8_encode($n['obs']);
	
	if ($obs != '')
	{
		$obs = '<br>'.$obs;
	}
	else 
	{
		$obs = '';
	}
	
	// STATUS
	if ($pagamento == '' || $pagamento == '00/00/0000')
	{
		$status 		= '<span class="label label-important"><i class="icon-warning-sign icon-white"></i> Pendente</span>';
		$pagamento 		= '';
		$valor_pago 	= '';
	}
	else
	{
		$status 		= '<span class="label label-success"><i class="icon-ok icon-white"></i> Quitado</span>';
		$pagamento 		= '<br><span class="text-success"><b>'.$pagamento.'</b></span>';
		$valor_pago 	= '<br><span class="text-success"><b>R$ '.$valor_pago.'</b></span>';
	}
	
	// SÓ ADICIONAR OS DIAS SE NÃO ESTIVER PAGO
	if ($pagamento == '')
	{
		// CALCULA DIAS
		$dias = calculadias(date('Y-m-d'),data_brasil_eua($vencimento));
	
		if ($dias == 0)
		{
			$dias = '<br><span class="badge  badge-mini">HOJE</span>';
		}
		else if ($dias > 0)
		{
			$dias = '<br><span class="badge badge-info badge-mini">Faltam '.$dias.' dias</span>';
		}
		else if ($dias < 0)
		{
			$dias = '<br><span class="badge badge-important badge-mini">Atrasado '.negativo($dias).' dias</span>';
		}
	} else { $dias = ''; }
	
	echo '
		<tr class="odd gradeX">
			<td><span class="text-error"><b>'.$vencimento.$dias.'<b></span>'.$pagamento.'</td>
			<td class=""><b>'.$titulo.'</b><i>'.$obs.'</i></td>
			<td class=""><span class="text-error"><b>R$ '.$valor.'<b></span>'.$valor_pago.'</td>
			<td class="">'.$status.'</td>
			<td class="center ">
			  <button class="btn btn-primary center" data-toggle="modal" onclick="abrirpopup(\'modulos/'.$modulo.'/form.php?tp=edit&id='.$id.$atributos.'\',\'Editando\');"><i class="icon-pencil"></i></button>
			  <button class="btn btn-danger center" data-toggle="modal" onclick="abrirpopup(\'modulos/'.$modulo.'/deletar.php?id='.$id.$atributos.'\',\'Deletando\');"><i class="icon-trash"></i></button>
			  </td>
		</tr>';
}
?>
    </tbody>
</table>
<?php 

#CONSULTANDO FINANCEIRO P/ O SOMATÓRIO DO TOTAL DE SAÍDA
$query1 = mysqli_query($link,"SELECT SUM(valor) AS soma FROM $tabela $filtro")or die(mysqli_error());
$cont1 = mysqli_fetch_array($query1,MYSQLI_ASSOC);
$saida = ($cont1["soma"]);

#CONSULTANDO FINANCEIRO P/ O SOMATÓRIO DO TOTAL DE SAÍDA PAGAS
$query = mysqli_query($link,"SELECT SUM(valor_pago) AS soma FROM $tabela $filtro")or die(mysqli_error());
$cont = mysqli_fetch_array($query,MYSQLI_ASSOC);
$pago = $cont["soma"];


$saldo = $saida-$pago;
			
?>
<table class="table">
    <tr>
        <td class="text-error" width="100"><b>Total à pagar</b></td>
        <td class="text-error"><b>R$ <?php echo moeda($saida); ?></b></td>
    </tr>
    <tr>
        <td class="text-success"><b>Pago</b></td>
        <td class="text-success"><b>R$ <?php echo moeda($pago); ?></b></td>
    </tr>
    <tr>
        <td class="text-info"><b>Saldo à pagar</b></td>
        <td class="text-info"><b>R$ <?php echo moeda($saldo); ?></b></td>
    </tr>
    </tbody>
</table>
    </div>
</div>