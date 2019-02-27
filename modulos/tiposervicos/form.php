<?php
$id   = (isset($_GET['id']) ? $_GET["id"] : '' );
$acao = (isset($_GET['acao']) ? $_GET["acao"] : '' );
$tp   = (isset($_GET['tp']) ? $_GET["tp"] : '' );

include '../../config/mysql.php';
include '../../config/funcoes.php';
include '../../config/check.php';


$modulo 	= 'tiposervicos';
$tabela 	= 'tiposervicos';
$atributos 	= '';
	
if ($acao == 'adicionar')
{
	
	$nome		= $_GET['nome'];
	$simbolo	= (isset($_GET['simbolo']) ? $_GET["simbolo"] : '' );
	$valor		= (isset($_GET['valor']) ? vfloat($_GET['valor']) : '');
	$taxa		= (isset($_GET['taxa']) ? vfloat($_GET['taxa']) : '');
	$sugerida	= (isset($_GET['sugerida']) ?vfloat($_GET['sugerida']) : '');;
	$data		= data_hora();

	$sql = "INSERT into $tabela (nome, data) VALUES ('$nome', '$data')";
	$insert = mysqli_query($link,$sql) or die('Erro gerado -> ' .mysqli_error($link).'<>'.$sql);

	echo '<script>fecharpopup(); '.$modulo.'(\''.$atributos.'\'); </script>';
	exit;
}
else if ($acao == 'editar')
{
	$nome		= $_GET['nome'];
	$data		= data_hora();
	$sql = "UPDATE $tabela SET nome='$nome' WHERE id='$id'";
	mysqli_query($link,$sql)or die('Erro gerado -> ' .mysqli_error($link).'<>'.$sql);
	echo '<script>fecharpopup(); '.$modulo.'(\''.$atributos.'\'); </script>';
	exit;
}
$sql = "SELECT * FROM $tabela WHERE id='$id'";	
$result = mysqli_query($link,$sql) or die('Erro gerado -> ' .mysqli_error($link).'<>'.$sql);

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

