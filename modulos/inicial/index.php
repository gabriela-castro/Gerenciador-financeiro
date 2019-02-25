<?php

include '../../config/mysql.php';
include '../../config/check.php';
include '../../config/funcoes.php';


?>
<div class="widget gray">
                    <div class="widget-title">
                        <h4><i class="icon-reorder"></i> Aplicativos</h4>
                            <span class="tools">
                            </span>
                    </div>
                    <div class="widget-body">
                                <!--BEGIN METRO STATES-->
                                <div class="metro-nav metro-fix-view"><div class="metro-nav-block nav-block-green long">
                        <a href="#" class="text-center" data-original-title="" onclick="abrirpopup('modulos/clientes/form.php?tp=add','Adicionar'); clientes('');">
                            <span class="value">
                                <i class="icon-plus"></i>
                                <?php echo numeroentradas('clientes',''); ?>
                            </span>
                            <div class="status">Novo cliente</div>
                        </a>
                    </div>
                                    <?php
									if ($tp_admin == 1)
									{ 

										$filtrofaturas		= "WHERE vencimento>='".date('Y')."-".date('m')."-01' AND vencimento<='".date('Y')."-".date('m')."-31' AND pagamento='0000-00-00'";

										echo metronav('faturas','faturas','Faturas',numeroentradas('faturas',''),'icon-barcode','orange','double');
										echo metronav('contasapagar','contasapagar','Contas a pagar',numeroentradas('contasapagar',$filtrofaturas),'icon-warning-sign','red','double');
										echo metronav('clientes','clientes','Clientes',numeroentradas('clientes',''),'icon-book','green','double');
										echo metronav('usuarios','usuarios','Usuários',numeroentradas('usuarios',''),'icon-user','grey','');
										echo metronav('conheceu','conheceu','Como Conheceu',numeroentradas('conheceu',''),'icon-info-sign','blue','double');
										echo metronav('tiposervicos','tiposervicos','Tipo de Serviços',numeroentradas('tiposervicos',''),'icon-briefcase','purple','double');
										echo metronav('filiais','filiais','Filiais',numeroentradas('filiais',''),'icon-building','yellow','');
									}
									else if ($tp_admin == 2)
									{
										echo metronav('pedidos','abrirpopup(\'modulos/pedidos/verificar.php\',\'Novo pedido\'); pedidos','Novo pedido','','icon-plus','green','');
										echo metronav('pedidos','pedidos','Meus pedidos',numeroentradas('pedidos','WHERE id_agente='.$id_admin.''),'icon-credit-card','orange','double');
									}
									?>
                                </div>

                                <div class="clearfix"></div>

                                <h3>Conta a pagar - <?php echo mesextenco(date('m')); ?></h3>
                                <!--END METRO STATES-->
<table class="table">
                                    <thead>
                                    <tr>
                                        <th>Vencimento</th>
                                        <th>Titulo / Observações</th>
                                        <th>Valor</th>
                                        <th>Status</th>
                                        <th>Ação</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
$mes = (isset($mes) ? $mes : '');
$ano = (isset($ano) ? $ano : '');
									
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
$filtro		= "WHERE vencimento>='$fdata1' AND vencimento<='$fdata2' AND pagamento='0000-00-00'";
$orderby 	= 'ORDER BY vencimento';
					
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
	
	// CALCULA DIAS
	$dias = calculadias(date('Y-m-d'),data_brasil_eua($vencimento));

	if ($dias == 0)
	{
		$dias = '<br> <span class="badge  badge-mini">HOJE</span>';
	}
	else if ($dias > 0)
	{
		$dias = '<br> <span class="badge badge-info badge-mini">Faltam '.$dias.' dias</span>';
	}
	else if ($dias < 0)
	{
		$dias = '<br> <span class="badge badge-important badge-mini">Atrasado '.negativo($dias).' dias</span>';
	}

	echo '
		<tr class="odd gradeX">
			<td><span class="text-error"><b>'.$vencimento.$dias.'<b></span>'.$pagamento.'</td>
			<td class=""><b>'.$titulo.'</b><i>'.$obs.'</i></td>
			<td class=""><span class="text-error"><b>R$ '.$valor.'<b></span>'.$valor_pago.'</td>
			<td class="">'.$status.'</td>
			<td class="center ">
			  <button class="btn btn-primary center" data-toggle="modal" onclick="abrirpopup(\'modulos/'.$modulo.'/form.php?tp=edit&id='.$id.$atributos.'\',\'Editando\');"><i class="icon-pencil"></i></button>
			  </td>
		</tr>';
}
?>
                                </table>
                            </div>
</div>
                        <!-- BEGIN BASIC PORTLET-->
