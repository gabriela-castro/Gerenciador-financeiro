<?php
header('Content-Type: text/html; charset=ISO-8859-1');
$id 		= bindec($_GET['i']);
$id_banco 	= bindec($_GET['b']);

include '../config/mysql.php';
include '../config/funcoes.php';

$pagina = chamacampo('boletos','pagina',$id_banco);
// CONSULTA FATURA
$consulta_boleto = mysql_query("SELECT * FROM boletos WHERE id='$id_banco'");

$n_boleto = mysql_fetch_array($consulta_boleto);

$prazo			= $n_boleto['prazo'];
$taxa			= moeda($n_boleto['taxa']);
$conta_cedente		= $n_boleto['conta_cedente'];
$conta_cedente_d	= $n_boleto['conta_cedente_d'];
$agencia		= $n_boleto['agencia'];
$agencia_d		= $n_boleto['agencia_d'];
$conta			= $n_boleto['conta'];
$conta_d		= $n_boleto['conta_d'];
$carteira		= $n_boleto['carteira'];
$carteira_descricao	= $n_boleto['carteira_descricao'];
$identificacao		= $n_boleto['identificacao'];
$cpf_cnpj		= $n_boleto['cpf_cnpj'];
$endereco		= $n_boleto['endereco'];
$cidade			= $n_boleto['cidade'];
$uf				= $n_boleto['uf'];
$cedente		= $n_boleto['cedente'];
$convenio		= $n_boleto['convenio'];
$contrato		= $n_boleto['contrato'];
$instrucoes1		= $n_boleto['instrucoes1'];
$instrucoes2		= $n_boleto['instrucoes2'];
$instrucoes3		= $n_boleto['instrucoes3'];
$instrucoes4		= $n_boleto['instrucoes4'];
$obs			= $n_boleto['obs'];


// CONSULTA FATURA
$consulta_fatura = mysql_query("SELECT * FROM faturas WHERE id='$id'");

$n_fatura = mysql_fetch_array($consulta_fatura);
$id_fatura= $n_fatura["id"];
$id_cliente 	= $n_fatura['id_cliente'];
//$vencimento		= data_eua_brasil($n_fatura['vencimento']);
$vencimento		= $n_fatura['vencimento'];
$id_servico1		= $n_fatura['id_servico1'];
$id_servico2		= $n_fatura['id_servico2'];
$id_servico3		= $n_fatura['id_servico3'];
$id_servico4		= $n_fatura['id_servico4'];
$id_servico5		= $n_fatura['id_servico5'];
$valor1			= $n_fatura['valor1'];
$valor2			= $n_fatura['valor2'];
$valor3			= $n_fatura['valor3'];
$valor4			= $n_fatura['valor4'];
$valor5			= $n_fatura['valor5'];
$obs			= $n_fatura['obs']; 

// TOTAL DE VALORES
$valor = $valor1+$valor2+$valor3+$valor4+$valor5;

// TOTAL DE SERVIÇOS
$servico1 = chamacampo('tiposervicos','nome',$id_servico1);
$servico2 = chamacampo('tiposervicos','nome',$id_servico2);
$servico3 = chamacampo('tiposervicos','nome',$id_servico3);
$servico4 = chamacampo('tiposervicos','nome',$id_servico4);
$servico5 = chamacampo('tiposervicos','nome',$id_servico5);

$servicos = 'R$ '.moeda($valor1).' - '.$servico1;

if ($id_servico2 != 0)
{
	$servicos .= '<br> R$ '.moeda($valor2).' - '.$servico2;
}
if ($id_servico3 != 0)
{
	$servicos .= '<br> R$ '.moeda($valor3).' - '.$servico3;
}
if ($id_servico4 != 0)
{
	$servicos .= '<br> R$ '.moeda($valor4).' - '.$servico4;
}
if ($id_servico5 != 0)
{
	$servicos .= '<br> R$ '.moeda($valor5).' - '.$servico5;
}

$demonstrativo1 = 'Pagamento à empresa '.$identificacao;
$demonstrativo2 = $servicos;
$demonstrativo3 = $obs;

// CONSULTA CLIENTE
$consulta_cliente = mysql_query("SELECT * FROM clientes WHERE id='$id_cliente'");

$n_cliente = mysql_fetch_array($consulta_cliente);

$fantasia		= $n_cliente['fantasia'];
$endereco_cli		= $n_cliente['endereco'];
$cidade_cli		= $n_cliente['cidade'];
$bairro_cli		= $n_cliente['bairro'];
$cep_cli		= $n_cliente['cep'];
$uf_cli			= $n_cliente['uf'];

//CONSULTA SE JÁ ESTÁ VENCIDOU OU NÃO PARA PROLONGAR A DATA DE VENC.

if ($vencimento < date('Y-m-d'))
{
	$vencimento = date('Y-m-d');
}
else
{
	$prazo = 0;
}

include $pagina;



?>