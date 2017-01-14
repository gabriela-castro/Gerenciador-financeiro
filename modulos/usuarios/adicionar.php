<?php
$acao = $_GET['acao'];

include '../../config/mysql.php';
include '../../config/funcoes.php';
include '../../config/check.php';

if ($acao == 'adicionar')
{
	
	$nome	= $_GET['nome'];
	$login	= $_GET['login'];
	$email	= $_GET['email'];
	$senha	= senha_encode($_GET['senha']);
	
	$insert = mysql_query("INSERT into usuarios (nome, email, login, senha) VALUES ('$nome', '$email', '$login', '$senha')") or die(mysql_error());

	echo '<script>fecharpopup(); usuarios(\'\'); </script>';
	exit;
}
?>
<div class="row-fluid">
    <span class="span6">Nome:<br />
          <input name="nome" type="text" id="nome" size="50" maxlength="100" class="obrigatorio span12" />
    </span>
    <span class="span6">
          Email:<br />
        <input name="email" type="text" id="email" size="50" maxlength="100" class="obrigatorio span12" />
    </span>
</div>
<div class="row-fluid">
    <span class="span6">
        Usuário:<br />
        <input name="login" type="text" id="login" size="30" class="obrigatorio span6" />
    </span>
    <span class="span6">
        Senha:<br />
        <input name="senha" type="password" id="senha" size="30" class="obrigatorio span6" />
    </span>
</div>
<div class="row-fluid">
<center>
<button class="btn btn-primary" onclick="addusuario();" >Adicionar</button>
</center>
</span>
</div>