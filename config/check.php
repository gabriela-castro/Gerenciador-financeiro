<?php

session_start();

$id_admin		= $_SESSION['id_admin'];
$tp_admin		= $_SESSION['tp_admin'];

if ($id_admin != NULL)
{
	if ($tp_admin == 1)
	{
		$resultado_adm	= mysqli_query($link,"SELECT nome,email FROM usuarios WHERE id='$id_admin'");
		
		$n_adm			= mysqli_fetch_array($resultado_adm,MYSQLI_ASSOC);
		
		$nome_admin		= utf8_encode($n_adm["nome"]);
		$email_admin	= utf8_encode($n_adm["email"]);
	}
	else if ($tp_admin == 2)
	{
		$resultado_adm	= mysqli_query($link,"SELECT nome,email FROM agentes WHERE id='$id_admin'");
		
		$n_adm			= mysqli_fetch_array($resultado_adm,MYSQLI_ASSOC);
		
		$nome_admin		= utf8_encode($n_adm["nome"]);
		$email_admin	= utf8_encode($n_adm["email"]);
	}

}
else
{
	header("location: login.php");
	exit;	
}


?>