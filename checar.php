<?php

include 'config/funcoes.php';
include 'config/mysql.php';

session_start(); 

$login = addslashes(mysqli_real_escape_string($link,$_POST["login"]));
$senha = senha_encode(addslashes(mysqli_real_escape_string($link,$_POST['senha'])));

$consulta_admin = mysqli_query($link,"SELECT id FROM usuarios WHERE login='$login' AND senha='$senha'") or print (mysqli_error());
$n_admin = mysqli_fetch_array($consulta_admin,MYSQLI_ASSOC);
$verifica_admin = mysqli_num_rows($consulta_admin);


$id_admin = $n_admin["id"];

/*
$consulta_agente = mysql_query("SELECT id FROM agentes WHERE usuario='$login' AND senha='$senha'") or print (mysql_error());
$n_agente = mysql_fetch_array($consulta_agente);
$verifica_agente = mysql_num_rows($consulta_agente);


$id_agente = $n_agente["id"];
*/
if($verifica_admin == 1)
{
	$_SESSION['id_admin'] 	= $id_admin;
	$_SESSION['tp_admin']	= 1;

	echo '<script> window.location="sistema.php"; </script>';
	
	exit;
}/*
else if ($verifica_agente == 1)
{
	$_SESSION['id_admin'] 	= $id_agente;
	$_SESSION['tp_admin']	= 2;

	echo '<script> window.location="sistema.php"; </script>';
	
	exit;
}*/
else
{
	echo '<script> alert(\'Dados incorretos, tente novamente.\'); window.location="login.php"; </script>';
}
?>