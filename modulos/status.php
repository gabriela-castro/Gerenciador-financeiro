<?php

$id 	= $_GET['id'];
$tabela	= $_GET['tabela'];
$status	= $_GET["status"];
$modulo	= $_GET["modulo"];

include '../config/mysql.php';
include '../config/funcoes.php';
include '../config/check.php';


mysqli_query($link,"UPDATE $tabela SET status='$status' WHERE id='$id'");

//STATUS
if ($status == '1')
{
	$status = '<button onclick="status(\''.$tabela.'\',1,\''.$id.'\',\''.$modulo.'\'); return false;" class="btn btn-success center" data-toggle="modal"><i class="icon-thumbs-up"></i></button>';
}
else if ($status == '2')
{
	$status = '<button onclick="status(\''.$tabela.'\',2,\''.$id.'\',\''.$modulo.'\'); return false;" class="btn btn-danger center" data-toggle="modal"><i class="icon-thumbs-down"></i></button>';
}


echo $status;

?>