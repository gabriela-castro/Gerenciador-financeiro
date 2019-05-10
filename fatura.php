<?php
$id = bindec($_GET['i']);

$v = $_GET['v'];

include 'config/mysql.php';
include 'config/funcoes.php';

$data = data_hora();


// CONSULTA FATURA
$consulta_fatura = mysqli_query($link,"SELECT * FROM faturas WHERE id='$id'");

$n_fatura = mysqli_fetch_array($consulta_fatura,MYSQLI_ASSOC);

$id				= $n_fatura['id'];
$id_cliente 	= $n_fatura['id_cliente'];
$vencimento		= data_eua_brasil($n_fatura['vencimento']);
$id_servico1	= $n_fatura['id_servico1'];
$id_servico2	= $n_fatura['id_servico2'];
$id_servico3	= $n_fatura['id_servico3'];
$id_servico4	= $n_fatura['id_servico4'];
$id_servico5	= $n_fatura['id_servico5'];
$valor1			= ($n_fatura['valor1']);
$valor2			= ($n_fatura['valor2']);
$valor3			= ($n_fatura['valor3']);
$valor4			= ($n_fatura['valor4']);
$valor5			= ($n_fatura['valor5']);
$status			= $n_fatura['status'];
$obs			= utf8_encode($n_fatura['obs']);

if ($v != '1' && $status != '5')
{
	// ATUALIZA O STATUS PARA VISUALIZADO
	mysqli_query($link,"UPDATE faturas SET status='4', visualizado='$data' WHERE id='$id'");
}

// TOTAL DE VALORES
$valor = $valor1+$valor2+$valor3+$valor4+$valor5;

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

// CONSULTA CLIENTE
$consulta_cliente = mysqli_query($link,"SELECT * FROM clientes WHERE id='$id_cliente'");

$n_cliente = mysqli_fetch_array($consulta_cliente,MYSQLI_ASSOC);

$fantasia		= utf8_encode($n_cliente['fantasia']);
$endereco		= utf8_encode($n_cliente['endereco']);
$cidade			= utf8_encode($n_cliente['cidade']);
$uf				= $n_cliente['uf'];

?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="pt" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="pt" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="pt"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title><?php $titulo_site; ?></title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
   <meta content="Sistema Financeiro" name="author" />
   <link href="css/admin.css" rel="stylesheet" />
   <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
   <link href="assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
   <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
   <link href="css/style.css" rel="stylesheet" />
   <link href="css/style-responsive.css" rel="stylesheet" />
   <link href="css/style-gray.css" rel="stylesheet" id="style_color" />
   <link rel="stylesheet" type="text/css" href="assets/uniform/css/uniform.default.css" />
   <style>
   <!--
   body,tr,td,div,span,a
   {
	   color:#000;
   }
   .fatura {
	   margin: 0 auto;
	   margin-top:5px;
	   padding:10px;
	   max-width:800px;
	   border:1px solid #999;
   }

#fatura2 {
	display:none;
}

@media print
{
	#pagamento {
		display:none;
	}
	#fatura2 {
		display:block;
	}
	#fatura1 {
		display:none;
	}
}
   -->
   </style>
</head>
<body bgcolor="#CCCCCC">
<div class="fatura">
    <div class="row-fluid">
        <span class="span7">
        <br>
            <img src="img/logo.png" style=" max-width:250px;">
            <br><br>
            <h3 id="fatura2">FATURA</h3>
            Nº <b><?php echo $id; ?></b><br>
        Vencimento: <b><?php echo $vencimento; ?></b><br>
        <?php if ($obs != '') { ?>Obs: <b><?php echo $obs; ?></b> <?php } ?>
        </span>
        <span class="span5">
            <h3 id="fatura1">FATURA</h3>
            <h4>De:</h4>
        <strong><?php echo $nome_remetende_cobranca; ?></strong><br>
            <?php echo $tel_remetende_cobranca; ?> <br>
            <?php echo $end_remetende_cobranca; ?><br>
            <?php echo $cidade_remetende_cobranca; ?>
            <br>-------------------------------</span>
    </div>
    <div class="row-fluid">
        <span class="span7" id="pagamento">
        <h4>Clique para efetuar o pagamento:</h4>
            <?php
            $numero_pagamento1 = numeroentradas('boletos','WHERE status=1');
            $numero_pagamento2 = numeroentradas('intermediarios','WHERE status=1');
			$numero_pagamento = $numero_pagamento1+$numero_pagamento2;
			if ($numero_pagamento == 0)
			{
				echo 'Nenhuma forma de pagamento ativa =/';
			}
			else
			{
				if ($numero_pagamento1 != 0)
				{

					$consulta_b = mysqli_query($link,"SELECT * FROM boletos WHERE status='1'") or die (mysqli_error());
					while($n_b = mysqli_fetch_array($consulta_b,MYSQLI_ASSOC))
					{

						echo '<a class="icon-btn span5" href="'.$urlsistema.'boleto/boleto.php?b='.decbin($n_b['id']).'&i='.decbin($id).'">
							<i class="icon-barcode"></i>
							<div>Gerar Boleto '.utf8_encode($n_b['banco']).'</div>
						</a>';
					}
				}
				if ($numero_pagamento2 != 0)
				{

					$consulta_o = mysqli_query($link,"SELECT * FROM intermediarios WHERE status='1'") or die (mysqli_error());
					while($n_o = mysqli_fetch_array($consulta_o,MYSQLI_ASSOC))
					{
						if ($n_o['id'] == '2')
						{

						echo '<form action="https://www.paypal.com/cgi-bin/webscr" name="inter_'.$id.'_'.$n_o['id'].'" method="post" target="_top">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="'.$n_o['email'].'">
<input type="hidden" name="lc" value="BR">
<input type="hidden" name="item_name" value="'.$servicos.'">
<input type="hidden" name="item_number" value="'.$id.'">
<input type="hidden" name="amount" value="'.$valor.'">
<input type="hidden" name="currency_code" value="BRL">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="0">
<input type="hidden" name="no_shipping" value="1">
<input type="hidden" name="undefined_quantity" value="1">
<input type="hidden" name="rm" value="1">
<input type="hidden" name="return" value="http://www.sistemafinanceiro.com.br">
<input type="hidden" name="cancel_return" value="http://www.sistemafinanceiro.com.br">
<input type="hidden" name="shipping" value="0.00">
<!--<input type="submit" value="Comprar" class="btn" />-->

<a class="icon-btn span5" href="javascript:document.inter_'.$id.'_'.$n_o['id'].'.submit();">
							<i class="icon-barcode"></i>
							<div>Pagar com '.$n_o['nome'].'</div>
						</a></form>';
						}
						else if ($n_o['id'] == '1')
						{
							echo '<a class="icon-btn span5" href="javascript:document.inter_'.$id.'_'.$n_o['id'].'.submit();">
							<i class="icon-barcode"></i>
							<div>Pagar com '.$n_o['nome'].'</div>
						</a>';
						}
					}
				}
			}
			?>
        </span>
        <span class="span5">
            <h4>Para:</h4>
            <strong><?php echo $fantasia; ?></strong><br>
            <?php if ($endereco != '') { echo $endereco.'<br>'; } ?>
            <?php echo $cidade.' - '.$uf; ?>
        </span>
    </div>
    <div class="row-fluid">
        <span class="span12">
        </span>
    </div>
        <table class="table table-hover">
                                <thead>
                                  <tr bgcolor="#E8E8E8">
                                    <th><i class="icon-tag"></i> Tipo</th>
                                    <th><i class="icon-question"></i> Descrição</th>
                                    <th><i class="icon-usd"></i> Preço</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>Serviço</td>
                                    <td><?php echo $servico1; ?></td>
                                    <td>R$ <?php echo moeda($valor1); ?></td>
                                  </tr>
                                  <?php if ($servico2 != '') { ?>
                                  <tr>
                                    <td>Serviço</td>
                                    <td><?php echo $servico2; ?></td>
                                    <td>R$ <?php echo moeda($valor2); ?></td>
                                  </tr>
                                  <?php } if ($servico3 != '') { ?>
                                  <tr>
                                    <td>Serviço</td>
                                    <td><?php echo $servico3; ?></td>
                                    <td>R$ <?php echo moeda($valor3); ?></td>
                                  </tr>
                                  <?php } if ($servico4 != '') { ?>
                                  <tr>
                                    <td>Serviço</td>
                                    <td><?php echo $servico4; ?></td>
                                    <td>R$ <?php echo moeda($valor4); ?></td>
                                  </tr>
                                  <?php } if ($servico5 != '') { ?>
                                  <tr>
                                    <td>Serviço</td>
                                    <td><?php echo $servico5; ?></td>
                                    <td>R$ <?php echo moeda($valor5); ?></td>
                                  </tr>
                                  <?php } ?>
                                  <tr>
                                    <td></td>
                                    <td><div class="text-right">Total:</div></td>
                                    <td><b>R$ <?php echo moeda($valor1+$valor2+$valor3+$valor4+$valor5); ?></b></td>
                                  </tr>
                                </tbody>
                              </table>
</div>
</body>
</html>
