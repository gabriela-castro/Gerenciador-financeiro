<?php

include '../config/mysql.php';
include '../config/check.php';
include '../config/funcoes.php';

$id = $_GET['id'];

$result = mysql_query("SELECT titulo,arquivo FROM arquivos WHERE id='$id'");

$n = mysql_fetch_array($result);

$titulo  = remover_acentos($n["titulo"]);
$arquivo = $n["arquivo"];

$link = $arquivo;

$titulo_novo = $titulo.'_'.substr($arquivo, -5);


header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");

header("Content-Length: ".filesize($link));

header('Content-Disposition: attachment; filename="'.$titulo_novo.'"');

readfile($link);
/*
header("Content-Type: application/zip");
header("Content-Length: ".filesize($link));
header ("Content-Disposition: attachment; filename=".basename($arquivo.".pdf"));
readfile($link);*/
echo '
<script>
    self.close();
</script>';
exit;

?>