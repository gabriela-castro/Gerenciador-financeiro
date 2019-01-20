<?php
$id = $_GET['id'];
$acao = $_GET['acao'];
$tp = $_GET['tp'];

include '../../config/mysql.php';
include '../../config/funcoes.php';
include '../../config/check.php';


$modulo 	= 'filiais';
$tabela 	= 'filiais';
$atributos 	= '';
	
if ($acao == 'adicionar')
{
	
	$nome		= $_GET['nome'];
	$data		= data_hora();

	
	$insert = mysql_query("INSERT into $tabela (nome, data) VALUES ('$nome', '$data')") or die(mysql_error());

	echo '<script>fecharpopup(); '.$modulo.'(\''.$atributos.'\'); </script>';
	exit;
}
else if ($acao == 'editar')
{
	$nome		= $_GET['nome'];
	$data		= data_hora();
	
	mysql_query("UPDATE $tabela SET nome='$nome' WHERE id='$id'");
	echo '<script>fecharpopup(); '.$modulo.'(\''.$atributos.'\'); </script>';
	exit;
}
	
$result = mysql_query("SELECT * FROM $tabela WHERE id='$id'");

$n = mysql_fetch_array($result);

$id			= $n['id'];
$nome		= utf8_encode($n['nome']);

?>
<script> mascaras(); </script>
<div class="row-fluid">
    <span class="span5">Nome:<br />
          <input name="nome" type="text" id="nome" size="50" maxlength="100" value="<?php echo $nome; ?>" class="obrigatorio span12" />
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
	?>');" >Salvar</button>
    </center>
    </div>

