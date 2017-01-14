<?php

$titulo_site	= 'Clube de Benefícios';
$sistema 		= 'Sis Boletos';
$versao 		= '0.5';

/*DADOS DO BOLETO*/

$email_remetente_cobranca = 'edmilson.financeiro.clubserv@hotmail.com';
$nome_remetende_cobranca = 'Clube de Benefícios';
/* $email_copia_seguranca = 'financeiro@agenciards.com.br'; */
/*$site_remetente_cobranca = 'http://www.agenciards.com.br';*/
$tel_remetende_cobranca = '21 2215-7902 / 21 3371-6023 / 21 3553-1675';
$end_remetende_cobranca = 'Rua Sete de Setembro, 67 - Sl. 702 - Centro';
$cidade_remetende_cobranca = 'Rio de Janeiro - RJ';

$servidor_smtp = 'smtp.gmail.com';
$usuario_smtp = 'clubeservidores@gmail.com';
$senha_smtp = 'clubserv123';

$recebimentos_ativos = 'Boleto Bancário';

$servidor_conexao = $_SERVER['SERVER_NAME'];

if ($servidor_conexao == 'fenixdigital.no-ip.biz')
{
	$urlsistema = 'http://fenixdigital.no-ip.biz/financeiro/';
	$bd_serv = 'localhost';
	$bd_user = 'root';
	$bd_pass = '';
	$bd_banc = 'financeiro';
}
else if ($servidor_conexao == 'www.sisboletos.com.br' || $servidor_conexao == 'sisboletos.com.br')
{
	
	$urlsistema = 'http://www.sisboletos.com.br/clubebeneficios/';
	$bd_serv = 'localhost';	
	$bd_user = 'sisbolet_assseg';
	$bd_pass = 'ass123$$$';
	$bd_banc = 'sisbolet_ass';
}
 

$conexao = mysql_connect($bd_serv,$bd_user,$bd_pass);
if (!$conexao)
{
	die('<center><h1>OPS, ERRO NO MYSQL :(</h1><br><br><br><font size="1" face="arial" color="#666">' . mysql_error().'</font></center>');
	exit;
}
mysql_select_db($bd_banc, $conexao);

?>