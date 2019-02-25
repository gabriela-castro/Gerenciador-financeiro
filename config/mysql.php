<?php

$titulo_site	= 'Sistema Financeiro';
$sistema 		= 'Sis Finanças';
$versao 		= '0.5';

/*DADOS DO BOLETO*/

$email_remetente_cobranca = 'xxx@gmail.com';
$nome_remetende_cobranca = 'Sistema Financeiro';
$tel_remetende_cobranca = '21 2222-7902 / 21 3333-6023 / 21 4444-1675';
$end_remetende_cobranca = 'Rua Sete de Setembro,  Centro';
$cidade_remetende_cobranca = 'Rio de Janeiro - RJ';

$servidor_smtp = 'smtp.gmail.com';
$usuario_smtp = 'financeiro@gmail.com';
$senha_smtp = 'senha12';

$recebimentos_ativos = 'Boleto Bancário';

$servidor_conexao = $_SERVER['SERVER_NAME'];


	$urlsistema = 'http://www.sistemafinanceiro.com.br/';
	$bd_serv = '127.0.0.1';
	$bd_user = 'root';
	$bd_pass = '';
	$bd_banc = 'sistema_financeiro';


	try{
		$link = new mysqli($bd_serv, $bd_user, $bd_pass, $bd_banc);
	}
	catch(Error $e){
	    echo "Error. Não foi possível conectar com a base de dados " . PHP_EOL;
	    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	    exit;
	}

?>
