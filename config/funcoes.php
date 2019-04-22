<?php
# CALCULA TOTAL
function calculatotal($campo,$tabela,$filtro) {
    include 'mysql.php'; 
	$query1 = mysqli_query($link,"SELECT SUM($campo) AS soma FROM $tabela $filtro")or die(mysqli_error());
	$cont1 = mysqli_fetch_array($query1,MYSQLI_ASSOC);
	return $cont1["soma"];
		
}

#anti mysqli_
function anti_mysqli_($sql) {
    $sql = mysqli_real_escape_string($sql);
    return $sql;
}
#CALCULA DIAS
function calculadias($data_inicial,$data_final)
{

	// Usa a função strtotime() e pega o timestamp das duas datas:
	$time_inicial = strtotime($data_inicial);
	$time_final = strtotime($data_final);
	
	// Calcula a diferença de segundos entre as duas datas:
	$diferenca = $time_final - $time_inicial; // 19522800 segundos
	
	// Calcula a diferença de dias
	$dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias
	
	// Exibe uma mensagem de resultado:
	return $dias;

}

#FORMATA CPF OU CNPJ
function cnpjcpf($cnpj)
{
	if (strlen($cnpj) == 15)
	{
		$p1 = substr($cnpj, 0, 3);
		$p2 = substr($cnpj, 3, 3);
		$p3 = substr($cnpj, 6, 3);
		$p4 = substr($cnpj, 9, 4);
		$p5 = substr($cnpj, -2);
		
		return $p1.'.'.$p2.'.'.$p3.'/'.$p4.'-'.$p5;
	}
	else if (strlen($cnpj) == 11)
	{
		
		$p1 = substr($cnpj, 0, 3);
		$p2 = substr($cnpj, 3, 3);
		$p3 = substr($cnpj, 6, 3);
		$p4 = substr($cnpj, -2);
		
		return $p1.'.'.$p2.'.'.$p3.'-'.$p4;
	}
	

}

#chama campo
function chamacampo($tabela,$campo,$id)
{
    include 'mysql.php';
	// CONSULTA CLIENTE
	$consulta_cliente = mysqli_query($link,"SELECT $campo FROM $tabela WHERE id='$id'") or die (mysqli_error());
	$n_cliente = mysqli_fetch_array($consulta_cliente,MYSQLI_ASSOC);

	return utf8_encode($n_cliente[''.$campo.'']);	
}
#select
function select($tp,$tabela,$campo,$titulo,$class,$id)
{
    include 'mysql.php';
	$selected = '  <select name="'.$campo.'" id="'.$campo.'" class="'.$class.' span12">';
	
	if ($tp == 'edit' || $tp == 'ver' || $tp == 'copia')
	{
		
		$consulta_selected1 = mysqli_query($link,"SELECT * FROM $tabela WHERE id='$id'") or die (mysqli_error());
		$n_selected1  = mysqli_fetch_array($consulta_selected1,MYSQLI_ASSOC);
		
		$id_selected1	 = $n_selected1['id'];
		$nome_selected1 = utf8_encode($n_selected1[''.$titulo.'']);
		
		$selected .=  '
		<option value="'.$id_selected1.'" selected="selected">'.$nome_selected1.'</option>
		<option value="">---</option>';
		
	}
	else if ($tp == 'add')
	{ 
		$selected .=  '
		<option value="" selected="selected">Selecione</option>';
	}
	
	// LISTAGEM DE FILIAIS EM ADD
	$sql = "SELECT * FROM $tabela ORDER BY $titulo";
	//echo $sql;
	$consulta_selected = mysqli_query($link,$sql) or die (mysqli_error($link));
	while($n_selected  = mysqli_fetch_array($consulta_selected,MYSQLI_ASSOC))
	{
		
		$id_selected	 = $n_selected['id'];
		$nome_selected = utf8_encode($n_selected[''.$titulo.'']);
		
		$selected .=  '
		<option value="'.$id_selected.'">'.$nome_selected.'</option>';
	
	}
	$selected .=  '
	</select>';
	
	return $selected;
	
		
}
#select
function select2($tp,$tabela,$campo,$titulo,$class,$id,$filtro)
{
	include 'mysql.php';
	$selected = '  <select name="'.$campo.'" id="'.$campo.'" class="'.$class.' span12">';
	
	if ($tp == 'edit' || $tp == 'ver' || $tp == 'copia')
	{
		
		$consulta_selected1 = mysqli_query($link,"SELECT * FROM $tabela WHERE id='$id'") or die (mysqli_error());
		$n_selected1  = mysqli_fetch_array($consulta_selected1,MYSQLI_ASSOC);
		
		$id_selected1	 = $n_selected1['id'];
		$nome_selected1 = utf8_encode($n_selected1[''.$titulo.'']);
		
		$selected .=  '
		<option value="'.$id_selected1.'" selected="selected">'.$nome_selected1.'</option>
		<option value="">---</option>';
		
	}
	else if ($tp == 'add')
	{ 
		$selected .=  '
		<option value="" selected="selected">Selecione</option>';
	}
	
	// LISTAGEM DE FILIAIS EM ADD
	$sql = "SELECT * FROM $tabela $filtro ORDER BY $titulo";
	$consulta_selected = mysqli_query($link,$sql) or die (mysqli_error());
	while($n_selected  = mysqli_fetch_array($consulta_selected,MYSQLI_ASSOC))
	{
		
		$id_selected	 = $n_selected['id'];
		$nome_selected = utf8_encode($n_selected[''.$titulo.'']);
		
		$selected .=  '
		<option value="'.$id_selected.'">'.$nome_selected.'</option>';
	
	}
	$selected .=  '
	</select>';
	return $selected;
	
		
}
#menu
function menu($modulo,$nome,$icone,$atributos)
{
	return '<li class="sub-menu menu '.$modulo.'">
                  <a href="#'.$modulo.'" onClick="'.$modulo.'(\''.$atributos.'\');" class="">
                      <i class="'.$icone.'"></i>
                      <span>'.$nome.'</span>
                  </a>
              </li>';	
}
#metro nav
function metronav($ancora,$modulo,$nome,$numero,$icone,$cor,$tamanho)
{
	return  '<div class="metro-nav-block nav-block-'.$cor.' '.$tamanho.'">
	<a data-original-title="" href="#'.$ancora.'" onclick="'.$modulo.'(\'\');">
		<i class="'.$icone.'"></i>
		<div class="info">'.$numero.'</div>
		<div class="status">'.$nome.'</div>
	</a>
</div>';
}

#NUMERO NA TABELA
function numeroentradas($tabela,$filtro)
{
	include 'mysql.php';
	$sql  = "SELECT * FROM $tabela $filtro";
	$sql1 = mysqli_query($link,$sql) or die('Erro gerado -> '. mysqli_error($link) . '<br/>' .$sql);
	if($sql1){
	$numero = mysqli_num_rows($sql1);
	return $numero;
	}else{
	return 0;
	}
}
#MES POR EXTENÇO
function mesextenco($mes)
{
	switch($mes) {
		case"01": $mes = "Janeiro";	  break;
		case"02": $mes = "Fevereiro"; break;
		case"03": $mes = "Março";	  break;
		case"04": $mes = "Abril";	  break;
		case"05": $mes = "Maio";	  break;
		case"06": $mes = "Junho";	  break;
		case"07": $mes = "Julho";	  break;
		case"08": $mes = "Agosto";	  break;
		case"09": $mes = "Setembro";  break;
		case"10": $mes = "Outubro";	  break;
		case"11": $mes = "Novembro";  break;
		case"12": $mes = "Dezembro";  break;
	}
	return $mes;
}
#MOEDA
function moeda($valor)
{
	return number_format($valor, 2, ',', '.');
}
#MOEDA2
function moeda2($valor)
{
	return number_format($valor, 7, ',', '.');
}
#VIRGULA
function virgula($valor)
{
	return str_replace(".",",",$valor);
}
#PONTO
function ponto($valor)
{
	return str_replace(",",".",$valor);
}
#TIRA SINAL NEGATIVO DE INTEIRO
function negativo($valor)
{
	return str_replace("-","",$valor);
}
#GRAVA NO BANCO TIPO FLOAT
function vfloat($valor)
{
	$array = explode(",",$valor);
	
	$um 	= str_replace(".","",$array[0]);
	
	$novo = $um.'.'.$array[1];
	
	return $novo;
}
#ENTER EM AREA DE TEXTO
function enter($string)
{ 
	$string = str_replace(array("\r\n", "\r", "\n"), "<br>", $string); 
	return $string; 
}
#ENTER EM AREA DE TEXTO
function enter2($string)
{ 
	$string = str_replace('<br>', "\n", $string); 
	return $string; 
}
#SENHA ENCODE
function senha_encode($senha)
{
	return base64_encode(base64_encode(base64_encode(base64_encode($senha))));
	
}
#SENHA DECODE
function senha_decode($senha)
{
	return base64_decode(base64_decode(base64_decode(base64_decode($senha))));
	
}
#DATA BARRA TRAÇO
function data_barra()
{
	return str_replace("/","-",$data);
}
#DATA EUA
function data_eua()
{
	return date("Y-m-d");
}
#DATA BRASIL
function data_br()
{
	return date("d/m/Y");
}
#DATA HORA
function data_hora()
{
	return date("Y-m-d H:i:s");
}
#DATA BRASIL EUA
function data_brasil_eua($data)
{
	$array = explode("/",$data);
	
	return $array[2].'-'.$array[1].'-'.$array[0];
}
#DATA EUA BRASIL
function data_eua_brasil($data)
{
    $data =	(isset($data) ?  $data : Date('Y-m-d'));
	
	$array = explode("-",$data);
	
	return $array[2].'/'.$array[1].'/'.$array[0];
}
#DATA E HORA EUA BRASIL
function data_hora_eua_brasil($data)
{
	$array = explode(" ",$data);
	
	$hora = $array[1];
	
	$array2 = explode("-",$array[0]);
	
	return $array2[2].'/'.$array2[1].'/'.$array2[0].' '.$hora;
}
#DATA E HORA EUA BRASIL
function data_hora_brasil_eua($data1)
{
	$array1 = explode(" ",$data1);
	
	$hora1 = $array1[1];
	
	$array21 = explode("/",$array1[0]);
	
	return $array21[2].'-'.$array21[1].'-'.$array21[0].' '.$hora1;
}

#REMOVER ACENTOS
function remover_acentos($string)
{ 
     // Converte todos os caracteres para minusculo 
     $string = strtolower($string); 
     // Remove os acentos 
     $string = eregi_replace('[aáàãâä]', 'a', $string); 
     $string = eregi_replace('[eéèêë]', 'e', $string); 
     $string = eregi_replace('[iíìîï]', 'i', $string); 
     $string = eregi_replace('[oóòõôö]', 'o', $string); 
     $string = eregi_replace('[uúùûü]', 'u', $string); 
     // Remove o cedilha e o ñ 
     $string = eregi_replace('[ç]', 'c', $string); 
     $string = eregi_replace('[ñ]', 'n', $string); 
     // Substitui os espaços em brancos por underline 
     $string = eregi_replace('( )', '_', $string); 
     // Remove hifens duplos 
     $string = eregi_replace('--', '_', $string); 
     return $string;

}
#TAMANHO AQUIVO
function tamanho($Url)
{
	$N = array('Bytes','KB','MB','GB');
	$Tam = filesize($Url);
	for ($Pos=0;$Tam>=1024;$Pos++) { $Tam /= 1024; }
	return @round($Tam,2)." ".$N[$Pos];
}
?>