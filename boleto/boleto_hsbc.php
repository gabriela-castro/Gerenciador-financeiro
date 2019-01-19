<?php

// DADOS DO BOLETO PARA O SEU CLIENTE
$dias_de_prazo_para_pagamento = $prazo;
$taxa_boleto = $taxa;
//$data_venc = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 
$data_venc = date("d/m/Y", strtotime("+$dias_de_prazo_para_pagamento days", strtotime("$vencimento")));
//$data_venc = date($vencimento, time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 
$valor_cobrado = $valor; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
$valor_cobrado = str_replace(",", ".",$valor_cobrado);
$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

$dadosboleto["numero_documento"] = "$id";	// Número do documento - REGRA: Máximo de 13 digitos
$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emissão do Boleto
$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
$dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com vírgula e sempre com duas casas depois da virgula

// DADOS DO SEU CLIENTE
$dadosboleto["sacado"] = "$fantasia";
$dadosboleto["endereco1"] = "$endereco_cli";
$dadosboleto["endereco2"] = "$cep_cli - $cidade_cli - $uf_cli";

// INFORMACOES PARA O CLIENTE
$dadosboleto["demonstrativo1"] = "$demonstrativo1";
$dadosboleto["demonstrativo2"] = "$demonstrativo2";
$dadosboleto["demonstrativo3"] = "$demonstrativo3";
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


// ---------------------- DADOS FIXOS DE CONFIGURAÇÃO DO SEU BOLETO --------------- //


// DADOS PERSONALIZADOS - HSBC
$dadosboleto["codigo_cedente"] = "$conta_cedente"; // Código do Cedente (Somente 7 digitos)
$dadosboleto["carteira"] = "$carteira";  // Código da Carteira

// SEUS DADOS
$dadosboleto["identificacao"] = "$identificacao";
$dadosboleto["cpf_cnpj"] = "$cpf_cnpj";
$dadosboleto["endereco"] = "$endereco";
$dadosboleto["cidade_uf"] = "$cidade / $uf";
$dadosboleto["cedente"] = "$cedente";

// NÃO ALTERAR!
include("include/funcoes_hsbc.php"); 
include("include/layout_hsbc.php");
?>
