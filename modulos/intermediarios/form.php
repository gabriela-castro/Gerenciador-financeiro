<?php
$id   = (isset($_GET['id']) ? $_GET["id"] : '' );
$acao = (isset($_GET['acao']) ? $_GET["acao"] : '' );
$tp   = (isset($_GET['tp']) ? $_GET["tp"] : '' );

include '../../config/mysql.php';
include '../../config/funcoes.php';
include '../../config/check.php';

$modulo 	= 'intermediarios';
$tabela 	= 'intermediarios';
$atributos 	= '';

$email				= (isset($_GET['email']) ? $_GET["email"] : '' );
/*
if ($acao == 'adicionar')
{
	$insert = mysqli_query("INSERT into $tabela (email) VALUES ('$email')") or die(mysqli_error());

	echo '<script>fecharpopup(); '.$modulo.'(\'?'.$atributos.'\'); </script>';
	exit;
}
else */if ($acao == 'editar')
{
	
	mysqli_query($link,"UPDATE $tabela SET email='$email' WHERE id='$id'");
	echo '<script>fecharpopup(); '.$modulo.'(\'?'.$atributos.'\'); </script>';
	exit;
}
	
$result = mysqli_query($link,"SELECT * FROM $tabela WHERE id='$id'");

$n = mysqli_fetch_array($result,MYSQLI_ASSOC);

$id					= $n['id'];
$nome				= utf8_encode($n['nome']);
$email				= $n['email'];

?>
<script> mascaras(); </script>
<div class="row-fluid">
    <span class="span5">Nome:<br />
    <input name="nome" type="text" class="obrigatorio span12" id="nome" value="<?php echo $nome; ?>" size="50" maxlength="100" required="required" disabled="disabled">    
    </span>
    <span class="span6">Email cadastrado:<br />
    <input name="email" type="text" class="obrigatorio span12" id="email" value="<?php echo $email; ?>" size="50" maxlength="100" required="required">
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

