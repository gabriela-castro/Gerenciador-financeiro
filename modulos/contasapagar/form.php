<?php
$id   = (isset($_GET['id']) ? $_GET['id'] : '');
$acao = (isset($_GET['acao']) ? $_GET['acao'] : '');
$tp   = (isset($_GET['tp']) ? $_GET['tp'] : '');
$ano  = (isset($_GET['ano']) ? $_GET['ano'] : '');
$mes  = (isset($_GET['mes']) ? $_GET['mes'] : '');

include '../../config/mysql.php';
include '../../config/funcoes.php';
include '../../config/check.php';


$modulo 	= 'contasapagar';
$tabela 	= 'contasapagar';
$atributos 	= 'mes='.$mes.'&ano='.$ano.'';

if ($acao != '')
{  
	
	$titulo		= $_GET['titulo'];
	$id_fornecedor		= $_GET['fornecedor'];
	$valor		= vfloat($_GET['valor']);
	$valor_pago	= vfloat($_GET['valor_pago']);
	$vencimento	= data_brasil_eua($_GET['vencimento']);
	$pagamento	= data_brasil_eua($_GET['pagamento']);
	$obs		= $_GET['obs'];
	$data		= data_hora();
}

if ($acao == 'adicionar')
{
	$sql = "INSERT into $tabela (id_fornecedor,titulo, valor, valor_pago, vencimento, pagamento, obs, data) 
	        VALUES ('$id_fornecedor','$titulo', '$valor', '$valor_pago', '$vencimento', '$pagamento', '$obs', '$data')";
			
	mysqli_query($link,$sql) or die(mysqli_error($link));

	echo '<script>fecharpopup(); '.$modulo.'(\'?'.$atributos.'\'); </script>';
	exit;
}
else if ($acao == 'editar')
{
	$sql = "UPDATE $tabela SET id_fornecedor='$id_fornecedor', titulo='$titulo', valor='$valor', 
	        valor_pago='$valor_pago', vencimento='$vencimento', pagamento='$pagamento', obs='$obs' WHERE id='$id'";
		
	mysqli_query($link,$sql);
	
	echo '<script>fecharpopup(); '.$modulo.'(\'?'.$atributos.'\'); </script>';
	exit;
}
	
$result = mysqli_query($link,"SELECT * FROM $tabela WHERE id='$id'");

$n = mysqli_fetch_array($result,MYSQLI_ASSOC);

$id			= $n['id'];
$titulo		= utf8_encode($n['titulo']);
$valor		= moeda($n['valor']);
$valor_pago	= moeda($n['valor_pago']);
$vencimento	= data_eua_brasil($n['vencimento']);
$pagamento	= data_eua_brasil($n['pagamento']);
$obs		= utf8_encode($n['obs']);
$id_fornecedor = $n['id_fornecedor'];

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
    <span class="span3">Data vencimento:<br />
          <input name="vencimento" type="text" id="vencimento" size="50" maxlength="100" value="<?php echo $vencimento; ?>" class="masc_data obrigatorio span12" />
    </span>
    <span class="span3">Data pagamento:<br />
          <input name="pagamento" type="text" id="pagamento" size="50" maxlength="100" value="<?php echo $pagamento; ?>" class="masc_data span12" />
    </span>
    <span class="span3">Valor pago:<br />
          <input name="valor_pago" type="text" id="valor_pago" size="50" maxlength="100" value="<?php echo $valor_pago; ?>" class="masc_preco span12" />
    </span>
		 <span class="span3">Fornecedor:<br />
		 
    <?php echo select2($tp,'clientes','id_fornecedor','fantasia','obrigatorio',$id_fornecedor,' WHERE status=1 and cli_for=2'); ?>
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

