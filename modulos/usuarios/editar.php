<?php
$id = $_GET['id'];
$acao = $_GET['acao'];

include '../../config/mysql.php';
include '../../config/funcoes.php';
include '../../config/check.php';

if ($acao == 'editar')
{
	$nome	= $_GET['nome'];
	$login	= $_GET['login'];
	$email	= $_GET['email'];
	$senha	= senha_encode($_GET['senha']);
	
	mysql_query("UPDATE usuarios SET nome='$nome', email='$email', login='$login', senha='$senha' WHERE id='$id'");
	echo '<script>fecharpopup(); usuarios(\'\'); </script>';
	exit;
}
	
$result = mysql_query("SELECT * FROM usuarios WHERE id=$id");

$n = mysql_fetch_array($result);

$nome	 = utf8_encode($n['nome']);
$login	 = utf8_encode($n['login']);
$email	 = utf8_encode($n['email']);
$senha	 = senha_decode($n['senha']);

?>
<div class="row-fluid">
    <span class="span6">Nome:<br />
      <input name="nome" type="text" class="obrigatorio span12" id="nome" value="<?php echo $nome; ?>" size="50" maxlength="100">
      </span>
    <span class="span6">
      Email:<br />
    <input name="email" type="text" class="obrigatorio span12" id="email" value="<?php echo $email; ?>" size="50" maxlength="100" />
    </span>
    </div>
<div class="row-fluid">
    <span class="span6">Usuário:<br />
    <input name="login" type="text" class="obrigatorio span6" id="login" value="<?php echo $login; ?>" size="30" />
      </span>
    <span class="span6">Senha:<br />
    <input name="senha" type="password" class="obrigatorio span6" id="senha" value="<?php echo $senha; ?>" size="30" />
      </span>
    </div>
<div class="row-fluid">
<center>
    <button class="btn btn-primary" onclick="editusuario('<?php echo $id; ?>');" >Salvar</button>
    </center>
    </div>

