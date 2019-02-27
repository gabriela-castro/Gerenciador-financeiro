<?php
$id = $_GET['id'];
$acao = $_GET['acao'];
$tp = $_GET['tp'];

include '../../config/mysql.php';
include '../../config/funcoes.php';
include '../../config/check.php';

$modulo 	= 'boletos';
$tabela 	= 'boletos';
$atributos 	= '';

$banco				= $_GET['banco'];
$prazo				= $_GET['prazo'];
$taxa				= vfloat($_GET['taxa']);
$conta_cedente		= $_GET['conta_cedente'];
$conta_cedente_d	= $_GET['conta_cedente_d'];
$agencia			= $_GET['agencia'];
$agencia_d			= $_GET['agencia_d'];
$conta				= $_GET['conta'];
$conta_d			= $_GET['conta_d'];
$carteira			= $_GET['carteira'];
$carteira_descricao	= $_GET['carteira_descricao'];
$identificacao		= $_GET['identificacao'];
$cpf_cnpj			= $_GET['cpf_cnpj'];
$endereco			= $_GET['endereco'];
$cidade				= $_GET['cidade'];
$uf					= $_GET['uf'];
$cedente			= $_GET['cedente'];
$convenio			= $_GET['convenio'];
$contrato			= $_GET['contrato'];
$instrucoes1		= $_GET['instrucoes1'];
$instrucoes2		= $_GET['instrucoes2'];
$instrucoes3		= $_GET['instrucoes3'];
$instrucoes4		= $_GET['instrucoes4'];
$obs				= $_GET['obs'];
/*
if ($acao == 'adicionar')
{
	$insert = mysql_query("INSERT into $tabela (banco, prazo, taxa, conta_cedente, conta_cedente_d, agencia, agencia_d, conta, conta_d, carteira, carteira_descricao, identificacao, cpf_cnpj, endereco, cidade, uf, cedente, convenio, contrato, instrucoes1, instrucoes2, instrucoes3, instrucoes4, obs) VALUES ('$banco', '$prazo', '$taxa', '$conta_cedente', '$conta_cedente_d', '$agencia', '$agencia_d', '$conta', '$conta_d', '$carteira', '$carteira_descricao', '$identificacao', '$cpf_cnpj', '$endereco', '$cidade', '$uf', '$cedente', '$convenio', '$contrato', '$instrucoes1', '$instrucoes2', '$instrucoes3', '$instrucoes4', '$obs')") or die(mysql_error());

	echo '<script>fecharpopup(); '.$modulo.'(\'?'.$atributos.'\'); </script>';
	exit;
}
else */if ($acao == 'editar')
{
	
	mysqli_query($link,"UPDATE $tabela SET prazo='$prazo', taxa='$taxa', conta_cedente='$conta_cedente', conta_cedente_d='$conta_cedente_d', agencia='$agencia', agencia_d='$agencia_d', conta='$conta', conta_d='$conta_d', carteira='$carteira', carteira_descricao='$carteira_descricao', identificacao='$identificacao', cpf_cnpj='$cpf_cnpj', endereco='$endereco', cidade='$cidade', uf='$uf', cedente='$cedente', convenio='$convenio', contrato='$contrato', instrucoes1='$instrucoes1', instrucoes2='$instrucoes2', instrucoes3='$instrucoes3', instrucoes4='$instrucoes4', obs='$obs' WHERE id='$id'") or die('Erro gerado -> '. mysqli_error($link) .'<br>'.$sql);
	echo '<script>fecharpopup(); '.$modulo.'(\'?'.$atributos.'\'); </script>';
	exit;
}
	
$result = mysqli_query("SELECT * FROM $tabela WHERE id='$id'")or die('Erro gerado -> '. mysqli_error($link) .'<br>'.$sql);

$n = mysqli_fetch_array($result,MYSQLI_ASSOC);

$id					= $n['id'];
$banco				= utf8_encode($n['banco']);
$prazo				= $n['prazo'];
$taxa				= moeda($n['taxa']);
$conta_cedente		= $n['conta_cedente'];
$conta_cedente_d	= $n['conta_cedente_d'];
$agencia			= $n['agencia'];
$agencia_d			= $n['agencia_d'];
$conta				= $n['conta'];
$conta_d			= $n['conta_d'];
$carteira			= $n['carteira'];
$carteira_descricao	= utf8_encode($n['carteira_descricao']);
$identificacao		= utf8_encode($n['identificacao']);
$cpf_cnpj			= $n['cpf_cnpj'];
$endereco			= utf8_encode($n['endereco']);
$cidade				= utf8_encode($n['cidade']);
$uf					= $n['uf'];
$cedente			= utf8_encode($n['cedente']);
$convenio			= $n['convenio'];
$contrato			= $n['contrato'];
$instrucoes1		= utf8_encode($n['instrucoes1']);
$instrucoes2		= utf8_encode($n['instrucoes2']);
$instrucoes3		= utf8_encode($n['instrucoes3']);
$instrucoes4		= utf8_encode($n['instrucoes4']);
$obs				= utf8_encode($n['obs']);

?>
<script> mascaras(); </script>
<div class="row-fluid">
    <span class="span4">Banco:<br />
    <input name="banco" type="text" class="obrigatorio span12" id="banco" value="<?php echo $banco; ?>" size="50" maxlength="50" required="required" disabled="disabled">    
    </span>
    <span class="span2">Prazo em dias:<br />
    <input name="prazo" type="text" class="obrigatorio masc_num span12" id="prazo" value="<?php echo $prazo; ?>" size="50" maxlength="2" required="required">
    </span>
    <span class="span2">Taxa R$:<br />
    <input name="taxa" type="text" class="obrigatorio span12" id="taxa" value="<?php echo $taxa; ?>" size="50" maxlength="10" required="required">
    </span>
    <span class="span2">Conta cedente:<br />
    <input name="conta_cedente" type="text" class="masc_num span12" id="conta_cedente" value="<?php echo $conta_cedente; ?>" size="50" maxlength="20">
    </span>
    <span class="span2">Digito cedente:<br />
    <input name="conta_cedente_d" type="text" class="masc_num span12" id="conta_cedente_d" value="<?php echo $conta_cedente_d; ?>" size="50" maxlength="1">
    </span>
</div>
<div class="row-fluid">
    <span class="span2">Agência:<br />
    <input name="agencia" type="text" class="masc_num span12" id="agencia" value="<?php echo $agencia; ?>" size="50" maxlength="15">
    </span>
    <span class="span1">Digito:<br />
    <input name="agencia_d" type="text" class="masc_num span12" id="agencia_d" value="<?php echo $agencia_d; ?>" size="50" maxlength="1">
    </span>
    <span class="span2">Conta:<br />
    <input name="conta" type="text" class="masc_num span12" id="conta" value="<?php echo $conta; ?>" size="50" maxlength="15">
    </span>
    <span class="span1">Digito:<br />
    <input name="conta_d" type="text" class="masc_num span12" id="conta_d" value="<?php echo $conta_d; ?>" size="50" maxlength="1">
    </span>
    <span class="span2">Carteira:<br />
    <input name="carteira" type="text" class=" obrigatorio span12" id="carteira" value="<?php echo $carteira; ?>" size="50" maxlength="10" required="required">
    </span>
    <span class="span4">Descr. carteira:<br />
    <input name="carteira_descricao" type="text" class=" span12" id="carteira_descricao" value="<?php echo $carteira_descricao; ?>" size="50" maxlength="100">
    </span>
</div>
<div class="row-fluid">
    <span class="span5">Identificação:<br />
    <input name="identificacao" type="text" class="obrigatorio span12" id="identificacao" value="<?php echo $identificacao; ?>" size="50" maxlength="100" required="required">
    </span>
    <span class="span5">Razão social:<br />
    <input name="cedente" type="text" class="obrigatorio span12" id="cedente" value="<?php echo $cedente; ?>" size="50" maxlength="100" required="required">
    </span>
    <span class="span2">CPF ou CNPJ:<br />
    <input name="cpf_cnpj" type="text" class="masc_num obrigatorio span12" id="cpf_cnpj" value="<?php echo $cpf_cnpj; ?>" size="50" maxlength="11" required="required">
    </span>
</div>
<div class="row-fluid">
    <span class="span4">Endereço:<br />
    <input name="endereco" type="text" class="obrigatorio span12" id="endereco" value="<?php echo $endereco; ?>" size="50" maxlength="100" required="required">
    </span>
    <span class="span3">Cidade:<br />
    <input name="cidade" type="text" class="obrigatorio span12" id="cidade" value="<?php echo $cidade; ?>" size="50" maxlength="100" required="required">
    </span>
    <span class="span1">UF:<br />
    <input name="uf" type="text" class="masc_num obrigatorio span12" id="uf" value="<?php echo $uf; ?>" size="50" maxlength="11" required="required">
    </span>
    <span class="span2">Contrato:<br />
    <input name="contraro" type="text" class="masc_num span12" id="contraro" value="<?php echo $contrato; ?>" size="50" maxlength="30">
    </span>
    <span class="span2">Convênio:<br />
    <input name="convenio" type="text" class="masc_num span12" id="convenio" value="<?php echo $convenio; ?>" size="50" maxlength="30">
    </span>
</div>
<div class="row-fluid">
    <span class="span6">Instruções 1:<br />
    <input name="instrucoes1" type="text" class="obrigatorio span12" id="instrucoes1" value="<?php echo $instrucoes1; ?>" size="50" maxlength="100" required="required">
    </span>
    <span class="span6">Instruções 2:<br />
    <input name="instrucoes2" type="text" class=" span12" id="instrucoes2" value="<?php echo $instrucoes2; ?>" size="50" maxlength="100">
    </span>
</div>
<div class="row-fluid">
    <span class="span6">Instruções 3:<br />
    <input name="instrucoes3" type="text" class=" span12" id="instrucoes3" value="<?php echo $instrucoes3; ?>" size="50" maxlength="100">
    </span>
    <span class="span6">Instruções 4:<br />
    <input name="instrucoes4" type="text" class=" span12" id="instrucoes4" value="<?php echo $instrucoes4; ?>" size="50" maxlength="100">
    </span>
</div>
<div class="row-fluid">
  <span class="span12">Observações:<br />
  <textarea name="obs" cols="30" rows="2" class="span12" id="obs"><?php echo $obs; ?></textarea>
  </span>
</div>

<?php if ($tp != 'ver') { ?>
<div class="row-fluid">
    <center>
        <button class="btn btn-primary" onclick="form<?php echo $modulo; ?>('<?php
        if ($tp == 'edit')
        {
            echo $id.'\',\'editar';
        }/*
        else if ($tp == 'add')
        {
            echo '0\',\'adicionar';
        }*/
        ?>');" >Salvar</button>
    </center>
</div>
<?php } ?>

