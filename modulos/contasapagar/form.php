<?php
$id = $_GET['id'];
$acao = $_GET['acao'];
$tp = $_GET['tp'];
$ano = $_GET['ano'];
$mes = $_GET['mes'];

include '../../config/mysql.php';
include '../../config/funcoes.php';
include '../../config/check.php';


$modulo 	= 'contasapagar';
$tabela 	= 'contasapagar';
$atributos 	= 'mes='.$mes.'&ano='.$ano.'';

if ($acao != '')
{
	$titulo		= $_GET['titulo'];
	$valor		= vfloat($_GET['valor']);
	$valor_pago	= vfloat($_GET['valor_pago']);
	$vencimento	= data_brasil_eua($_GET['vencimento']);
	$pagamento	= data_brasil_eua($_GET['pagamento']);
	$obs		= $_GET['obs'];
	$data		= data_hora();
}

if ($acao == 'adicionar')
{
	
	mysql_query("INSERT into $tabela (titulo, valor, valor_pago, vencimento, pagamento, obs, data) VALUES ('$titulo', '$valor', '$valor_pago', '$vencimento', '$pagamento', '$obs', '$data')") or die(mysql_error());

	echo '<script>fecharpopup(); '.$modulo.'(\'?'.$atributos.'\'); </script>';
	exit;
}
else if ($acao == 'editar')
{
	
	mysql_query("UPDATE $tabela SET titulo='$titulo', valor='$valor', valor_pago='$valor_pago', vencimento='$vencimento', pagamento='$pagamento', obs='$obs' WHERE id='$id'");
	
	echo '<script>fecharpopup(); '.$modulo.'(\'?'.$atributos.'\'); </script>';
	exit;
}
	
$result = mysql_query("SELECT * FROM $tabela WHERE id='$id'");

$n = mysql_fetch_array($result);

$id			= $n['id'];
$titulo		= utf8_encode($n['titulo']);
$valor		= moeda($n['valor']);
$valor_pago	= moeda($n['valor_pago']);
$vencimento	= data_eua_brasil($n['vencimento']);
$pagamento	= data_eua_brasil($n['pagamento']);
$obs		= utf8_encode($n['obs']);

if ($vencimento == '//' || $vencimento == '00/00/0000') { $vencimento = ''; }
if ($pagamento == '//' || $pagamento == '00/00/0000') { $pagamento = ''; }

?>
<script> mascaras(); calendario('vencimento'); calendario('pagamento'); </script>
<div class="row-fluid">
    <span class="span8">Titulo:<br />
          <input name="titulo" type="text" id="titulof" size="50" maxlength="100" value="<?php echo $titulo; ?>" class="obrigatorio span12" />
    </span>
    <span class="span4">Valor:<br />
          <input name="valor" type="text" id="valor" size="50" maxlength="100" value="<?php echo $valor; ?>" class="masc_preco obrigatorio span12" />
    </span>
</div>
<div class="row-fluid">
    <span class="span4">Data vencimento:<br />
          <input name="vencimento" type="text" id="vencimento" size="50" maxlength="100" value="<?php echo $vencimento; ?>" class="masc_data obrigatorio span12" />
    </span>
    <span class="span4">Data pagamento:<br />
          <input name="pagamento" type="text" id="pagamento" size="50" maxlength="100" value="<?php echo $pagamento; ?>" class="masc_data span12" />
    </span>
    <span class="span4">Valor pago:<br />
          <input name="valor_pago" type="text" id="valor_pago" size="50" maxlength="100" value="<?php echo $valor_pago; ?>" class="masc_preco span12" />
    </span>
</div>
<div class="row-fluid">
  <span class="span12">Observações:<br />
    <textarea name="obs" cols="50" rows="3" class=" span12" id="obs"><?php echo $obs; ?></textarea>
  </span>
</div>
<div class="row-fluid">
<center>
    <button class="btn btn-primary" onclick="form<?php echo $modulo; ?>('<?php
    if ($tp == 'edit')
	{
		echo $id.'\',\'editar';
	}
	else if ($tp == 'add')
	{
		echo '0\',\'adicionar';
	}
	?>', '&<?php echo $atributos; ?>');" >Salvar</button>
    </center>
    </div>

