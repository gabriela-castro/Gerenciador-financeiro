<?php
include 'config/mysql.php';
include 'config/funcoes.php';
include("funcoes_cef_sigcb.php");

$data= data_brasil_eua($_GET["inicio"]);
$data2=data_brasil_eua($_GET["final"]);
/* //verifica data para busca de boletos, de 20 dias
	$data= date('Y-m-d');
	$data2= date('Y-m-d', strtotime("+20 days"));
	*/
	//consulta banco
$consulta_b = mysql_query("SELECT * FROM boletos WHERE status='1'") or die (mysql_error());
$n_b 	    = mysql_fetch_array($consulta_b);
$id_banco   = $n_b['id'];
//consulta fatura
$consulta_fatura = mysql_query("SELECT id FROM faturas WHERE vencimento<='$data2' && vencimento>='$data' && status ='1' "); 

while($n_fatura = mysql_fetch_array($consulta_fatura) ){

$row[]=$n_fatura['id']; //array para loop da gera��o dos boletos
}

if(is_array($row)==FALSE){
	echo '<script> window.alert("N�o h� boletos para serem gerados nas datas informadas."); javascript:window.close();</script>';
	die;
}

foreach($row as $value){
	$id= $value;
header('Content-Type: text/html; charset=ISO-8859-1');
// +----------------------------------------------------------------------+
// | BoletoPhp - Vers�o Beta                                              |
// +----------------------------------------------------------------------+
// | Este arquivo est� dispon�vel sob a Licen�a GPL dispon�vel pela Web   |
// | em http://pt.wikipedia.org/wiki/GNU_General_Public_License           |
// | Voc� deve ter recebido uma c�pia da GNU Public License junto com     |
// | esse pacote; se n�o, escreva para:                                   |
// |                                                                      |
// | Free Software Foundation, Inc.                                       |
// | 59 Temple Place - Suite 330                                          |
// | Boston, MA 02111-1307, USA.                                          |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Originado do Projeto BBBoletoFree que tiveram colabora��es de Daniel |
// | William Schultz e Leandro Maniezo que por sua vez foi derivado do	  |
// | PHPBoleto de Jo�o Prado Maia e Pablo Martins F. Costa		      		  |
// | 																	                                    |
// | Se voc� quer colaborar, nos ajude a desenvolver p/ os demais bancos :-)|
// | Acesse o site do Projeto BoletoPhp: www.boletophp.com.br             |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Equipe Coordena��o Projeto BoletoPhp: <boletophp@boletophp.com.br>   |
// | Desenv Boleto SICREDI: Rafael Azenha Aquini <rafael@tchesoft.com>    |
// |                        Marco Antonio Righi <marcorighi@tchesoft.com> |
// | Homologa��o e ajuste de algumas rotinas.				               			  |
// |                        Marcelo Belinato  <mbelinato@gmail.com> 		  |
// +----------------------------------------------------------------------+


// ------------------------- DADOS DIN�MICOS DO SEU CLIENTE PARA A GERA��O DO BOLETO (FIXO OU VIA GET) -------------------- //
// Os valores abaixo podem ser colocados manualmente ou ajustados p/ formul�rio c/ POST, GET ou de BD (MySql,Postgre,etc)	//

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

$endereco		= utf8_encode($n_boleto['endereco']);

$cidade			= utf8_encode($n_boleto['cidade']);

$uf			= $n_boleto['uf'];

$cedente		= utf8_encode($n_boleto['cedente']);

$convenio		= $n_boleto['convenio'];

$contrato		= $n_boleto['contrato'];

$instrucoes1		= utf8_encode($n_boleto['instrucoes1']);

$instrucoes2		= utf8_encode($n_boleto['instrucoes2']);

$instrucoes3		= utf8_encode($n_boleto['instrucoes3']);

$instrucoes4		= utf8_encode($n_boleto['instrucoes4']);

$obs			= utf8_encode($n_boleto['obs']);




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

$obs			= utf8_encode($n_fatura['obs']);


// TOTAL DE VALORES

$valor = $valor1+$valor2+$valor3+$valor4+$valor5;


// TOTAL DE SERVI�OS

$servico1 = chamacampo('tiposervicos','nome',$id_servico1);

$servico2 = chamacampo('tiposervicos','nome',$id_servico2);

$servico3 = chamacampo('tiposervicos','nome',$id_servico3);

$servico4 = chamacampo('tiposervicos','nome',$id_servico4);

$servico5 = chamacampo('tiposervicos','nome',$id_servico5);


$servicos = 'R$ '.moeda($valor1).' - '.utf8_encode($servico1);


if ($id_servico2 != 0)
{

$servicos .= '<br> R$ '.moeda($valor2).' - '.utf8_encode($servico2);
}


if ($id_servico3 != 0)
{

$servicos .= '<br> R$ '.moeda($valor3).' - '.utf8_encode($servico3);
}


if ($id_servico4 != 0)
{

$servicos .= '<br> R$ '.moeda($valor4).' - '.utf8_encode($servico4);
}

if ($id_servico5 != 0)
{

$servicos .= '<br> R$ '.moeda($valor5).' - '.utf8_encode($servico5);
}



$demonstrativo1 = 'Pagamento � empresa '.utf8_encode($identificacao);

$demonstrativo2 = $servicos;

$demonstrativo3 = $obs;


// CONSULTA CLIENTE

$consulta_cliente = mysql_query("SELECT * FROM clientes WHERE id='$id_cliente'");


$n_cliente = mysql_fetch_array($consulta_cliente);


$fantasia			= utf8_encode($n_cliente['fantasia']);
$endereco_cli		= utf8_encode($n_cliente['endereco']);
$cidade_cli			= utf8_encode($n_cliente['cidade']);
$bairro_cli			= $n_cliente['bairro'];
$cep_cli			= $n_cliente['cep'];
$uf_cli				= $n_cliente['uf'];


//CONSULTA SE J� EST� VENCIDOU OU N�O PARA PROLONGAR A DATA DE VENC.


if ($vencimento < date('Y-m-d'))
{

$vencimento = date('Y-m-d');
}

else
{
	$prazo = 0;
}


// DADOS DO BOLETO PARA O SEU CLIENTE
$dias_de_prazo_para_pagamento = $prazo;
$taxa_boleto = $taxa;
$data_venc = date("d/m/Y", strtotime("+$dias_de_prazo_para_pagamento days", strtotime("$vencimento")));//date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));   Prazo de X dias OU informe data: "13/04/2006";
$valor_cobrado = $valor; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
$valor_cobrado = str_replace(",", ".",$valor_cobrado);
$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

// Composi��o Nosso Numero - CEF SIGCB
$dadosboleto["nosso_numero1"] = "000"; // tamanho 3
$dadosboleto["nosso_numero_const1"] = "2"; //constanto 1 , 1=registrada , 2=sem registro
$dadosboleto["nosso_numero2"] = "000"; // tamanho 3
$dadosboleto["nosso_numero_const2"] = "4"; //constanto 2 , 4=emitido pelo proprio cliente
$dadosboleto["nosso_numero3"] = "00000". $id_fatura;; // tamanho 9


$dadosboleto["numero_documento"] = $id;//"27.030195.10" Num do pedido ou do documento
$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emiss�o do Boleto
$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
$dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com v�rgula e sempre com duas casas depois da virgula

// DADOS DO SEU CLIENTE
$dadosboleto["sacado"] = "$fantasia";
$dadosboleto["endereco1"] = "$endereco_cli - $bairro_cli";
$dadosboleto["endereco2"] = "$cep_cli - $cidade_cli - $uf_cli";

// INFORMACOES PARA O CLIENTE
$dadosboleto["demonstrativo1"] = "$demonstrativo1";
$dadosboleto["demonstrativo2"] = "$demonstrativo2";
$dadosboleto["demonstrativo3"] = "$demonstrativo3";

// INSTRU��ES PARA O CAIXA
$dadosboleto["instrucoes1"] = "$instrucoes1";
$dadosboleto["instrucoes2"] = "$instrucoes2";
$dadosboleto["instrucoes3"] = "$instrucoes3";
$dadosboleto["instrucoes4"] = "$instrucoes4";

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
$dadosboleto["quantidade"] = "";
$dadosboleto["valor_unitario"] = "";
$dadosboleto["aceite"] = "";
$dadosboleto["especie"] = "R$";
$dadosboleto["especie_doc"] = "";


// ---------------------- DADOS FIXOS DE CONFIGURA��O DO SEU BOLETO --------------- //


// DADOS DA SUA CONTA - CEF
$dadosboleto["agencia"] = "$agencia"; // Num da agencia, sem digito
$dadosboleto["conta"] = "$conta"; 	// Num da conta, sem digito
$dadosboleto["conta_dv"] = "$conta_d"; 	// Digito do Num da conta

// DADOS PERSONALIZADOS - CEF
$dadosboleto["conta_cedente"] = "$conta_cedente"; // C�digo Cedente do Cliente, com 6 digitos (Somente N�meros)
$dadosboleto["carteira"] = "$carteira";  // C�digo da Carteira: pode ser SR (Sem Registro) ou CR (Com Registro) - (Confirmar com gerente qual usar)

// SEUS DADOS
$dadosboleto["identificacao"] = "$identificacao";
$dadosboleto["cpf_cnpj"] = "$cpf_cnpj";
$dadosboleto["endereco"] = "$endereco";
$dadosboleto["cidade_uf"] = "$cidade / $uf";
$dadosboleto["cedente"] = "$cedente";

// N�O ALTERAR!
//include("include/funcoes_cef_sigcb.php");
//include("include/layout_cef.php");

$codigobanco = "104";
$codigo_banco_com_dv = geraCodigoBanco($codigobanco);
$nummoeda = "9";
$fator_vencimento = fator_vencimento($dadosboleto["data_vencimento"]);

//valor tem 10 digitos, sem virgula
$valor = formata_numero($dadosboleto["valor_boleto"],10,0,"valor");
//agencia � 4 digitos
$agencia = formata_numero($dadosboleto["agencia"],4,0);
//conta � 5 digitos
$conta = formata_numero($dadosboleto["conta"],5,0);
//dv da conta
$conta_dv = formata_numero($dadosboleto["conta_dv"],1,0);
//carteira � 2 caracteres
$carteira = $dadosboleto["carteira"];

//conta cedente (sem dv) com 6 digitos
$conta_cedente = formata_numero($dadosboleto["conta_cedente"],6,0);
//dv da conta cedente
$conta_cedente_dv = digitoVerificador_cedente($conta_cedente);

//campo livre (sem dv) � 24 digitos
$campo_livre = $conta_cedente . $conta_cedente_dv . formata_numero($dadosboleto["nosso_numero1"],3,0) . formata_numero($dadosboleto["nosso_numero_const1"],1,0) . formata_numero($dadosboleto["nosso_numero2"],3,0) . formata_numero($dadosboleto["nosso_numero_const2"],1,0) . formata_numero($dadosboleto["nosso_numero3"],9,0);
//dv do campo livre
$dv_campo_livre = digitoVerificador_nossonumero($campo_livre);
$campo_livre_com_dv ="$campo_livre$dv_campo_livre";

//nosso n�mero (sem dv) � 17 digitos
$nnum = "2400000000000";
//$nnum = formata_numero($dadosboleto["nosso_numero_const1"],1,0).formata_numero($dadosboleto["nosso_numero_const2"],1,0).formata_numero($dadosboleto["nosso_numero1"],3,0).formata_numero($dadosboleto["nosso_numero2"],3,0).formata_numero($dadosboleto["nosso_numero3"],9,0);
//nosso n�mero completo (com dv) com 18 digitos
//$nossonumero = $nnum . digitoVerificador_nossonumero($nnum);
$nossonumero= $nnum. $id_fatura;
// 43 numeros para o calculo do digito verificador do codigo de barras
$dv = digitoVerificador_barra("$codigobanco$nummoeda$fator_vencimento$valor$campo_livre_com_dv", 9, 0);
// Numero para o codigo de barras com 44 digitos
$linha = "$codigobanco$nummoeda$dv$fator_vencimento$valor$campo_livre_com_dv";

$agencia_codigo = $agencia." / ". $conta_cedente ."-". $conta_cedente_dv;

$dadosboleto["codigo_barras"] = $linha;
$dadosboleto["linha_digitavel"] = monta_linha_digitavel($linha);
$dadosboleto["agencia_codigo"] = $agencia_codigo;
$dadosboleto["nosso_numero"] = $nossonumero;
$dadosboleto["codigo_banco_com_dv"] = $codigo_banco_com_dv;


ob_start();

// N�O ALTERAR!
include("layout.php");

$content = ob_get_clean();

//cria o html e salva no servidor
require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
$html2pdf = new HTML2PDF('P','A4','fr', array(0, 0, 0, 0));
$html2pdf->pdf->SetDisplayMode('real');
$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
$nomebo='boleto'.$id.'.pdf';
$html2pdf->Output($nomebo, 'F');
$pdfarray[]=$nomebo; //array com nome dos arquivos
}
//lib to merge all files
include 'PDFMerger-master/PDFMerger.php';

$pdf = new PDFMerger;
foreach($pdfarray as $nomefiles){
	$pdf->addPDF($nomefiles, 'all');
}

$pdf->merge('browser', 'emissao.pdf');
foreach($pdfarray as $nomefiles){
	unlink($nomefiles);
}

/* convert
require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
try
{
	$html2pdf = new HTML2PDF('P','A4','fr', array(0, 0, 0, 0));
	/* Abre a tela de impress�o
	//$html2pdf->pdf->IncludeJS("print(true);");

	$html2pdf->pdf->SetDisplayMode('real');

	/* Parametro vuehtml = true desabilita o pdf para desenvolvimento do layout
	$html2pdf->writeHTML($content, isset($_GET['vuehtml']));

	/* Abrir no navegador
	$html2pdf->Output('boleto.pdf');

	/* Salva o PDF no servidor para enviar por email
	//$html2pdf->Output('caminho/boleto.pdf', 'F');

	/* For�a o download no browser
	//$html2pdf->Output('boleto.pdf', 'D');
}
catch(HTML2PDF_exception $e) {
	echo $e;
	exit;
}*/
