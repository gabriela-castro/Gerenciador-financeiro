<?php
$id   = (isset($_GET['id']) ? $_GET['id'] : '') ;
$acao = (isset($_GET['acao']) ? $_GET['acao'] : '') ;
$tp   = (isset($_GET['tp']) ? $_GET['tp'] : '') ;

include '../../config/mysql.php';
include '../../config/funcoes.php';
include '../../config/check.php';

$modulo = 'fornecedores';
$tabela = 'clientes';

$atributos 	= '';

$id_filial		= (isset($_GET['id_filial']) ? $_GET['id_filial'] : '');
$id_conheceu	= (isset($_GET['id_conheceu']) ? $_GET['id_conheceu'] : '');
$tipo			= (isset($_GET['tipo']) ? $_GET['tipo'] : '');
$nome			= (isset($_GET['nome']) ? $_GET['nome'] : '');
$razao			= (isset($_GET['razao']) ? $_GET['razao'] : '');
$fantasia		= (isset($_GET['fantasia']) ? $_GET['fantasia'] : '');
$email			= (isset($_GET['email']) ? $_GET['email'] : '');
if($tipo == 2){
$nascimento		= (isset($_GET['nascimento']) ? data_brasil_eua($_GET['nascimento']) : '');
}else{
 $nascimento = data_brasil_eua(Date('d/m/Y'));	
}
$cpf			= (isset($_GET['cpf']) ? $_GET['cpf'] : '');
$cnpj			= (isset($_GET['cnpj']) ? $_GET['cnpj'] : '');
$rg				= (isset($_GET['rg']) ? $_GET['rg'] : '');
$orgao			= (isset($_GET['orgao']) ? $_GET['orgao'] : '');
$endereco		= (isset($_GET['endereco']) ? $_GET['endereco'] : '');
$cep			= (isset($_GET['cep']) ? $_GET['cep'] : '');
$bairro			= (isset($_GET['bairro']) ? $_GET['bairro'] : '');
$cidade			= (isset($_GET['cidade']) ? $_GET['cidade'] : '');
$uf				= (isset($_GET['uf']) ? $_GET['uf'] : '');
$tel1			= (isset($_GET['tel1']) ? $_GET['tel1'] : '');
$tel2			= (isset($_GET['tel2']) ? $_GET['tel2'] : '');
$tel3			= (isset($_GET['tel3']) ? $_GET['tel3'] : '');
$obs			= (isset($_GET['obs']) ? $_GET['obs'] : '');
$data			= data_hora();

if ($acao == 'adicionar')
{
	$sql = "INSERT into $tabela (id_filial, id_conheceu, tipo, nome, razao, fantasia, email, nascimento, cpf, cnpj, rg, orgao, endereco, cep, bairro, cidade, uf, tel1, tel2, tel3, obs, data, id_admin, cli_for) VALUES ('$id_filial', '$id_conheceu', '$tipo', '$nome', '$razao', '$fantasia', '$email', '$nascimento', '$cpf', '$cnpj', '$rg', '$orgao', '$endereco', '$cep', '$bairro', '$cidade', '$uf', '$tel1', '$tel2', '$tel3', '$obs', '$data', '$id_admin', 2)";
	//echo $sql; //exit;
	$insert = mysqli_query($link,$sql) or die('Erro gerado -> '. mysqli_error($link) .'<br>'.$sql);

	echo '<script>fecharpopup(); '.$modulo.'(\''.$atributos.'\'); </script>';
	exit;
}
else if ($acao == 'editar')
{
	
	mysqli_query($link,"UPDATE $tabela SET id_filial='$id_filial', id_conheceu='$id_conheceu', tipo='$tipo', nome='$nome', razao='$razao', fantasia='$fantasia', email='$email', nascimento='$nascimento', cpf='$cpf', cnpj='$cnpj', rg='$rg', orgao='$orgao', endereco='$endereco', cep='$cep', bairro='$bairro', cidade='$cidade', uf='$uf', tel1='$tel1', tel2='$tel2', tel3='$tel3', obs='$obs' WHERE id='$id'") or die('Erro gerado -> '. mysqli_error($link) .'<br>'.$sql);
	echo '<script>fecharpopup(); '.$modulo.'(\''.$atributos.'\'); </script>';
	exit;
}

if($id != null){
	
$result = mysqli_query($link,"SELECT * FROM $tabela WHERE id='$id'")or die('Erro gerado -> '. mysqli_error($link) .'<br>'.$sql);

$n = mysqli_fetch_array($result,MYSQLI_ASSOC);

$id				= $n['id'];
$id_filial		= $n['id_filial'];
$id_conheceu	= $n['id_conheceu'];
$tipo			= $n['tipo'];
$nome			= utf8_encode($n['nome']);
$razao			= utf8_encode($n['razao']);
$fantasia		= utf8_encode($n['fantasia']);
$email			= utf8_encode($n['email']);
$nascimento		= data_eua_brasil($n['nascimento']);
$cpf			= ($n['cpf']);
$cnpj			= ($n['cnpj']);
$rg				= ($n['rg']);
$orgao			= utf8_encode($n['orgao']);
$endereco		= utf8_encode($n['endereco']);
$cep			= ($n['cep']);
$bairro			= utf8_encode($n['bairro']);
$cidade			= utf8_encode($n['cidade']);
$uf				= ($n['uf']);
$tel1			= ($n['tel1']);
$tel2			= ($n['tel2']);
$tel3			= ($n['tel3']);
$obs			= utf8_encode($n['obs']);
}
?>
<script> mascaras(); tipoclientes(); </script>
<div class="row-fluid">
    <span class="span2">Tipo:<br />
    <select name="tipo" id="tipo" class="obrigatorio span12">
    <?php if ($tp == 'edit' || $tp == 'ver') {
		  if ($tipo == '1') { ?>
    <option value="<?php echo $tipo; ?>" selected="selected">Jurídica</option>
      <option value="2">Física</option>
    <?php } else if ($tipo == '2') { ?>
    <option value="<?php echo $tipo; ?>" selected="selected">Física</option>
      <option value="1">Jurídica</option>
    <?php }} else if ($tp == 'add') { ?>
      <option value="1" selected="selected">Jurídica</option>
      <option value="2">Física</option>
    <?php } ?>
    </select>
    </span>
    <span class="span4"><span id="tfantasia">Nome Fantasia</span>:<br />
    <input name="fantasia" type="text" class="obrigatorio span12" id="fantasia" value="<?php echo $fantasia; ?>" size="50" maxlength="100" required="required">
    </span>
    <span class="span3">Responsável:<br />
      <input name="nome" type="text" class="obrigatorio span12" id="nome" value="<?php echo $nome; ?>" size="50" maxlength="100" required="required">
    </span>
    <span class="span3">
      Email:<br />
    <input name="email" type="text" class="obrigatorio span12" id="email" value="<?php echo $email; ?>" size="50" maxlength="100" required="required" />
    </span>
</div>
<div class="row-fluid juridica" <?php if ($tipo == '2') { ?>style="display:none;" <?php } ?>>
    <span class="span7">Razão Social:<br />
    <input name="razao" type="text" class="obrigatorio span12" id="razao" value="<?php echo $razao; ?>" size="50" maxlength="100" required="required">
    </span>
    <span class="span5">CNPJ:<br />
    <input name="cnpj" type="text" class="obrigatorio masc_cnpj span12" id="cnpj" value="<?php echo $cnpj; ?>" size="30" required="required" />
    </span>
</div>
<div class="row-fluid fisica" <?php if ($tipo == '1' || $tipo == '') { ?>style="display:none;" <?php } ?>>
    <span class=" span3">Nascimento:<br />
    <input name="nascimento" type="text" class=" masc_data span12" id="nascimento" value="<?php echo data_eua_brasil($nascimento); ?>" size="50" maxlength="100" />
    </span>
    <span class=" span3">CPF:<br />
    <input name="cpf" type="text" class="obrigatorio masc_cpf span12" id="cpf" value="<?php echo $cpf; ?>" size="30" required="required" />
    </span>
    <span class=" span3">RG:<br />
    <input name="rg" type="text" class=" masc_num span12" id="rg" value="<?php echo $rg; ?>" size="30" />
    </span>
    <span class=" span3">Orgão emissor:<br />
    <input name="orgao" type="text" class=" span12" id="orgao" value="<?php echo $orgao; ?>" size="30" />
    </span>
</div>

<div class="row-fluid">
    <span class="span2">CEP:<br />
    <input name="cep" type="text" class=" masc_cep span12" id="cep" value="<?php echo $cep; ?>" size="30" />
    </span>
    <span class="span4">Endereço:<br />
    <input name="endereco" type="text" class=" span12" id="endereco" value="<?php echo $endereco; ?>" size="30" />
    </span>
    <span class="span3">Bairro:<br />
    <input name="bairro" type="text" class="  span12" id="bairro" value="<?php echo $bairro; ?>" size="30" />
  </span>
    <span class="span3">Cidade:<br />
    <input name="cidade" type="text" class="obrigatorio span12" id="cidade" value="<?php echo $cidade; ?>" size="30" />
    </span>
</div>

<div class="row-fluid">
  <span class="span2">Estado:<br />
    <select id="uf" name="uf" class=" span12">
    <?php if ($tp == 'edit' || $tp == 'ver') { ?>
    <option value="<?php echo $uf; ?>" selected="selected"><?php echo $uf; ?></option>  
    <?php } else if ($tp == 'add') { ?>
    <option value="" selected="selected">Selecione</option>  
    <?php } ?>
    <option value="">--</option>
    <option value="AC">AC</option>
    <option value="AL">AL</option>
    <option value="AM">AM</option>
    <option value="AP">AP</option>
    <option value="BA">BA</option>
    <option value="CE">CE</option>
    <option value="DF">DF</option>
    <option value="ES">ES</option>
    <option value="GO">GO</option>
    <option value="MA">MA</option>
    <option value="MG">MG</option>
    <option value="MS">MS</option>
    <option value="MT">MT</option>
    <option value="PA">PA</option>
    <option value="PB">PB</option>
    <option value="PE">PE</option>
    <option value="PI">PI</option>
    <option value="PR">PR</option>
    <option value="RJ">RJ</option>
    <option value="RN">RN</option>
    <option value="RO">RO</option>
    <option value="RR">RR</option>
    <option value="RS">RS</option>
    <option value="SC">SC</option>
    <option value="SE">SE</option>
    <option value="SP">SP</option>
    <option value="TO">TO</option>
    </select>
    </span>
    <span class="span2">Como Conheceu:<br />
    <?php echo select($tp,'conheceu','id_conheceu','nome','obrigatorio',$id_conheceu,$link); ?>
    </span>
    <span class="span2">
      Filial:<br />
    <?php echo select($tp,'filiais','id_filial','nome','obrigatorio',$id_filial,$link); ?>
    </span>
    <span class="span2">Telefone¹:<br />
    <input name="tel1" type="text" class="obrigatorio masc_tel span12" id="tel1" value="<?php echo $tel1; ?>" size="30"  required="required"/>
    </span>
    <span class="span2">Telefone²:<br />
    <input name="tel2" type="text" class=" masc_tel span12" id="tel2" value="<?php echo $tel2; ?>" size="30" />
    </span>
    <span class="span2">Telefone³:<br />
    <input name="tel3" type="text" class=" masc_tel span12" id="tel3" value="<?php echo $tel3; ?>" size="30" />
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
        }
        else if ($tp == 'add')
        {
            echo '0\',\'adicionar';
        }
        ?>');" >Salvar</button>
    </center>
</div>
<?php } ?>

