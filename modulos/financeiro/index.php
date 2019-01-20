<?php

include '../../config/mysql.php';
include '../../config/check.php';
include '../../config/funcoes.php';

@$ano = $_GET["ano"];
@$mes = $_GET["mes"];
@$fornecedor = $_GET["fornecedor"];

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

//$fdata1 = date('Y').'-'.date('m').'-01';
//$fdata2 = date('Y').'-'.date('m').'-31';


# TOTAL DE CONTAS PAGAS
$filtrocontasapagar		= "WHERE pagamento>='$fdata1' AND pagamento<='$fdata2' AND pagamento<>'0000-00-00'";
$totaldesaidas = calculatotal('valor_pago','contasapagar',$filtrocontasapagar);

# TOTAL DE CONTAS A PAGAR
$filtrocontasapagarp		= "WHERE vencimento>='$fdata1' AND vencimento<='$fdata2' AND pagamento='0000-00-00'";
$totaldesaidasp = calculatotal('valor','contasapagar',$filtrocontasapagarp);

# TOTAL DE CONTAS RECEBIDAS
$filtrofaturas	= "WHERE fechado>='$fdata1' AND fechado<='$fdata2' AND fechado<>'0000-00-00'";
$valor1 = calculatotal('valor1','faturas',$filtrofaturas);
$valor2 = calculatotal('valor2','faturas',$filtrofaturas);
$valor3 = calculatotal('valor3','faturas',$filtrofaturas);
$valor4 = calculatotal('valor4','faturas',$filtrofaturas);
$valor5 = calculatotal('valor5','faturas',$filtrofaturas);
$totalentradas = $valor1+$valor2+$valor3+$valor4+$valor5;

# TOTAL DE CONTAS A RECEBER
$filtrofaturasp	= "WHERE vencimento>='$fdata1' AND vencimento<='$fdata2' AND fechado='0000-00-00'";
$valor1p = calculatotal('valor1','faturas',$filtrofaturasp);
$valor2p = calculatotal('valor2','faturas',$filtrofaturasp);
$valor3p = calculatotal('valor3','faturas',$filtrofaturasp);
$valor4p = calculatotal('valor4','faturas',$filtrofaturasp);
$valor5p = calculatotal('valor5','faturas',$filtrofaturasp);
$totalentradasp = $valor1p+$valor2p+$valor3p+$valor4p+$valor5p;

				
?>

<div class="widget gray">
                    <div class="widget-title">
                        <h4><i class="icon-reorder"></i> Financeiro</h4>
                            <span class="tools">
                            </span>
                    </div>
                    <div class="widget-body">
                                <!--BEGIN METRO STATES-->
                                <div class="metro-nav metro-fix-view"><div class="metro-nav-block nav-block-green long">
                        <a href="#" class="text-center" data-original-title="" onclick="abrirpopup('modulos/faturas/form.php?tp=add','Nova fatura');">
                            <span class="value">
                                <i class="icon-plus"></i>
                                <?php echo numeroentradas('faturas',''); ?>
                            </span>
                            <div class="status">Nova fatura</div>
                        </a>
                    </div>
                                    <?php
									$rid= 'modulos/faturas/form.php?tp=add';
									$rid2= 'Nova fatura'	;
									if ($tp_admin == 1)
									{ 

										$filtrofaturas				= "WHERE vencimento>='".date('Y')."-".date('m')."-01' AND vencimento<='".date('Y')."-".date('m')."-31' AND pagamento='0000-00-00'";
										$filtrofaturasareceber		= "WHERE vencimento>='".date('Y')."-".date('m')."-01' AND vencimento<='".date('Y')."-".date('m')."-31' AND status<>'5'";
										$filtrofaturasrecebidas		= "WHERE fechado>='".date('Y')."-".date('m')."-01' AND fechado<='".date('Y')."-".date('m')."-31' AND status='5'";
										
										echo metronav('contasapagar','contasapagar','Contas a pagar','R$ '.moeda($totaldesaidasp),'icon-warning-sign','red','double');
										echo metronav('faturas','faturas','Todas as faturas',numeroentradas('faturas',''),'icon-barcode','orange','double');
										echo '<div class="metro-nav-block nav-block-green double"> 	<a data-original-title="" href="#" onclick="abrirpopup(\'modulos/financeiro/range.php\',\' Emissão de boletos\');" >
												<i class="icon-book"></i>
												<div class="info"> Emissão</div>
												<div class="status">Impressão de Faturas</div>
													</a>
											</div>';
										
										echo metronav('baixa','baixa','Baixa de fatura','baixa','icon-ok','grey','double');
										echo metronav('faturas','faturas(\'?listar=1\');','Faturas a receber','R$ '.moeda($totalentradasp),'icon-usd','blue','double');
										echo metronav('faturas','faturas(\'?listar=2\');','Faturas recebidas','R$ '.moeda($totalentradas),'icon-thumbs-up','green2','double');
										echo metronav('faturas','faturas(\'?listar=3\');','Faturas atrasadas','+10 dias','icon-thumbs-down','red2','double');
									}
									else if ($tp_admin == 2)
									{
										echo metronav('pedidos','abrirpopup(\'modulos/pedidos/verificar.php\',\'Novo pedido\'); pedidos','Novo pedido','','icon-plus','green','');
										echo metronav('pedidos','pedidos','Meus pedidos',numeroentradas('pedidos','WHERE id_agente='.$id_admin.''),'icon-credit-card','orange','double');
									}
									?>
                                </div>

                                <div class="clearfix"></div>
<span class="span6">
<span class="tools">
                                <button class="btn btn-small btn-primary" onclick="financeiro('?mes=<?php echo $mes-1; ?>&ano=<?php echo $ano; ?>');"><i class="icon-circle-arrow-left"></i></button>
                                <button class="btn btn-small btn-primary" onclick="financeiro('?mes=<?php echo $mes; ?>&ano=<?php echo $ano; ?>');"><?php echo mesextenco($mes).' de '.$ano; ?></button>
                                <button class="btn btn-small btn-primary" onclick="financeiro('?mes=<?php echo $mes+1; ?>&ano=<?php echo $ano; ?>');"><i class="icon-circle-arrow-right"></i></button>
                            </span>
<h3>Entradas e saídas - <?php echo mesextenco($mes); ?></h3>
<!--END METRO STATES-->
<table class="table">
    <tr>
        <td class="text-success"><h4>À receber:</h4></td>
        <td class="text-success"><h4>R$ <?php echo moeda($totalentradasp); ?></h4></td>
    </tr>
    <tr>
        <td class="text-success"><h4>Entradas:</h4></td>
        <td class="text-success"><h4>R$ <?php echo moeda($totalentradas); ?></h4></td>
    </tr>
    <tr>
        <td class="text-error"><h4>À pagar:</h4></td>
        <td class="text-error"><h4>R$ <?php echo moeda($totaldesaidasp); ?></h4></td>
    </tr>
    <tr>
        <td class="text-error"><h4>Saídas:</h4></td>
        <td class="text-error"><h4>R$ <?php echo moeda($totaldesaidas); ?></h4></td>
    </tr>
    <tr>
        <td class="text-info"><h4>Saldo:</h4></td>
        <td class="text-info"><h4>R$ <?php echo moeda($totalentradas-$totaldesaidas); ?></h4></td>
    </tr>
</table>
</span>
<span class="span6">

</span>
<div class="clearfix"></div>
                            </div>
</div>
                        <!-- BEGIN BASIC PORTLET-->
