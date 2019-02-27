<?php
$id = (isset($_GET['id']) ? $_GET["id"] : '' );
$acao = (isset($_GET['acao']) ? $_GET["acao"] : '' );
$tp = (isset($_GET['tp']) ? $_GET["tp"] : '' );;

include '../../config/mysql.php';
include '../../config/funcoes.php';
include '../../config/check.php';


$modulo 	= 'conheceu';
$tabela 	= 'conheceu';
$atributos 	= '';
	
if ($acao == 'adicionar')
{
	
	$nome		= $_GET['nome'];
	$simbolo	= $_GET['simbolo'];
	$valor		= vfloat($_GET['valor']);
	$taxa		= vfloat($_GET['taxa']);
	$sugerida	= vfloat($_GET['sugerida']);
	$data		= data_hora();

	
	$insert = mysqli_query($link,"INSERT into $tabela (nome, data) VALUES ('$nome', '$data')") or die(mysqli_error());

	echo '<script>fecharpopup(); '.$modulo.'(\''.$atributos.'\'); </script>';
	exit;
}
else if ($acao == 'editar')
{
	$nome		= $_GET['nome'];
	$data		= data_hora();
	
	mysqli_query($link,"UPDATE $tabela SET nome='$nome' WHERE id='$id'");
	echo '<script>fecharpopup(); '.$modulo.'(\''.$atributos.'\'); </script>';
	exit;
}
	
$result = mysqli_query($link,"SELECT * FROM $tabela WHERE id='$id'");

$n = mysqli_fetch_array($result,MYSQLI_ASSOC);

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

