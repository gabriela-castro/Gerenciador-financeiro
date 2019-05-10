<?php

include '../../config/mysql.php';
include '../../config/funcoes.php';
include '../../config/check.php';
	
$id   = (isset($_GET['id']) ? $_GET["id"] : '' );
$acao = (isset($_GET['acao']) ? $_GET["acao"] : '' );
$funcao = (isset($_GET['funcao']) ? $_GET['funcao'] : '');


// CONSULTA FATURA
$consulta_fatura = mysqli_query($link,"SELECT * FROM faturas WHERE id='$id'");

$n_fatura = mysqli_fetch_array($consulta_fatura,MYSQLI_ASSOC);

$id				= $n_fatura['id'];
$id_cliente 	= $n_fatura['id_cliente'];
$vencimento		= data_eua_brasil($n_fatura['vencimento']);
$id_servico1	= $n_fatura['id_servico1'];
$id_servico2	= $n_fatura['id_servico2'];
$id_servico3	= $n_fatura['id_servico3'];
$id_servico4	= $n_fatura['id_servico4'];
$id_servico5	= $n_fatura['id_servico5'];

// TOTAL DE VALORES
//$valor = $valor1+$valor2+$valor3+$valor4+$valor5;

// TOTAL DE SERVI�OS
$servico1 = chamacampo('tiposervicos','nome',$id_servico1);
$servico2 = chamacampo('tiposervicos','nome',$id_servico2);
$servico3 = chamacampo('tiposervicos','nome',$id_servico3);
$servico4 = chamacampo('tiposervicos','nome',$id_servico4);
$servico5 = chamacampo('tiposervicos','nome',$id_servico5);

$servicos = $servico1;

if ($id_servico2 != 0)
{
	$servicos .= ' | '.$servico2;
}
if ($id_servico3 != 0)
{
	$servicos .= ' | '.$servico3;
}
if ($id_servico4 != 0)
{
	$servicos .= ' | '.$servico4;
}
if ($id_servico5 != 0)
{
	$servicos .= ' | '.$servico5;
}



// CONSULTA EMAIl CLIENTE
$email = chamacampo('clientes','email',$id_cliente);

if ($acao == 'envio' || $acao == 'reenvio')
{
	# Faz o include do PEAR Mail e do Mime.
	include ("Mail.php");
	include ("Mail/mime.php");
	
	# Vari�vel de teste de upload
	$up=0;
	
	# E-mail de destino. Caso seja mais de um destino, crie um array de e-mails.
	# *OBRIGAT�RIO*
	//$recipients = $email;
	$recipients = ''.$email.','.$email_copia_seguranca.'';
	
	# Cabe�alho do e-mail.
	$headers = 
	array (
	  'From'    => ''.utf8_decode($nome_remetende_cobranca).' <'.$email_remetente_cobranca.'>', # O 'From' � *OBRIGAT�RIO*.
	  'To'      => $recipients,
	  'Subject' => 'Lembrete de vencimento da mensalidade'
	);
	
	# Utilize esta op��o caso deseje definir o e-mail de resposta
	# $headers['Reply-To'] = 'EMailDeResposta@DominioDeResposta.com';
	
	# Utilize esta op��o caso deseje definir o e-mail de retorno em caso de erro de envio
	# $headers['Errors-To'] = 'EMailDeRerornoDeERRO@DominioDeretornoDeErro.com';
	
	# Utilize esta op��o caso deseje definir a prioridade do e-mail
	# $headers['X-Priority'] = '3'; # 1 UrgentMessage, 3 Normal  
	
	# Define o tipo de final de linha.
	$crlf = "\r\n";
	
	# Corpo da Mensagem e texto e em HTML
	//  $text = "Nome: ".$_POST['nome'];
	
	$text = '<font face="arial" size="2">
	
	Prezado cliente,
	<br><br>
	<i>Este � um e-mail AUTOM�TICO para lhe lembrar de sua mensalidade junto � '.utf8_decode($nome_remetende_cobranca).'.</i>
	<br><br>
	Descri��o da fatura: <b>'.utf8_decode($servicos).'</b>
	<br><br>
	Caso ainda n�o tenha efetuado o pagamento do vencimento abaixo, entre em <b><a href="'.$urlsistema.'fatura.php?i='.decbin($id).'">'.$urlsistema.'fatura.php?i='.decbin($id).'</a></b>
	<br><br>
	<b>Voc� pode efetuar seu pagamento por '.utf8_decode($recebimentos_ativos).'. A data de vencimento da sua conta ser� dia '.$vencimento.'.</b>
	<br>
	Pague sempre sua mensalidade em dia. Em caso de imprevistos, e precisar atrasar seu pagamento, por gentileza nos avise com anteced�ncia, desta forma evitamos a suspens�o de seus servi�os.
	<br><br>
	Em caso de atraso superior a 10 dias, sem aviso de atraso de pagamento seus servi�os ser�o suspensos automaticamente.
	<br><br>
	Atenciosamente,
	<br><br>
	Departamento Financeiro - '.utf8_decode($nome_remetende_cobranca).'<br>
	'.$email_remetente_cobranca.'<br>
	'.$tel_remetente_cobranca.'<br>
	<a href="'.$site_remetente_cobranca.'">'.$site_remetente_cobranca.'</a>
	</font>';
	
	////////////////////////////////////////////////////////////////////////
	
	
	$html = '<HTML><BODY>'.$text.'</BODY></HTML>';
	
	
	# Instancia a classe Mail_mime
	$mime = new Mail_mime($crlf);
	# Coloca o HTML no email
	$mime->setHTMLBody($html);

	/*
	# Efetua o upload do arquivo
	if (is_uploaded_file($_FILES['anexo']['tmp_name']))
	{
		$caminho= "/home/dragonsb/tmp/".$_FILES['anexo']['name'];
		
		# grava o $arquivo no $caminho especificado
		if(copy($_FILES["anexo"]["tmp_name"],$caminho))
		{
			//echo "O arquivo foi transferido!<br>";
			$up=1;
		}
	}
	else
	{
		//echo "<h1>O arquivo n�o foi transferido!</h1>";
		//echo "<h2><font color='red'>Caminho ou nome de arquivo Inv�lido</font></h2>";
	}
	
	##  # Anexa um arquivo ao email.
	$mime->addAttachment($caminho);
	*/
	
	# Procesa todas as informa��es.
	$body = $mime->get();
	$headers = $mime->headers($headers);
	
	# Par�metros para o SMTP. *OBRIGAT�RIO*
	$params = 
	array (
	  'auth' => true, # Define que o SMTP requer autentica��o.
	  /*'port' => '465',
	  'StartTLS' => true,*/
	  'host' => ''.$servidor_smtp.'', # Servidor SMTP
	  'username' => ''.$usuario_smtp.'', # Usu�rio do SMTP
	  'password' => ''.$senha_smtp.'' # Senha do seu MailBox.
	
	);
	/*
	$params = 
	array (
	  'auth' => true, # Define que o SMTP requer autentica��o.
	  'port' => '465',
	  'host' => 'ssl://smtp.gmail.com', # Servidor SMTP
	  'username' => 'contato@sistemafinanceiro.com.br', # Usu�rio do SMTP
	  'password' => 'rdsmilionario$' # Senha do seu MailBox.
	
	);*/

	$data = data_hora();
	# Define o m�todo de envio
	$mail_object =& Mail::factory('smtp', $params);
	
	# Envia o email. Se n�o ocorrer erro, retorna TRUE caso contr�rio, retorna um
	# objeto PEAR_Error. Para ler a mensagem de erro, use o m�todo 'getMessage()'.
	$result = $mail_object->send($recipients, $headers, $body);
	if (PEAR::IsError($result))
	{
		echo "ERRO ao tentar enviar o email. (" . $result->getMessage(). ")";
	}   
	else
	{
		if ($acao == 'envio')
		{
			mysqli_query($link,"UPDATE faturas SET enviado='$data', status='2' WHERE id='$id'");
			echo '<script>';
			echo '$(\'#envio_'.$id.'\').html(\'\'); ';
			echo '</script>';
			echo "<button onclick=\"abrirpopup('modulos/faturas/status.php?id=".$id."&".$atributos."','Fatura #".$id."'); return false;\" class=\"btn btn-warning center\" data-toggle=\"modal\"><i class=\"icon-signin\"></i> ENVIADO</button><br>".data_hora_eua_brasil($data);
		}
		else if ($acao == 'reenvio')
		{
			mysqli_query($link,"UPDATE faturas SET reenviado='$data', status='3' WHERE id='$id'");	
			echo '<script>';
			echo '$(\'#envio_'.$id.'\').html(\'\'); ';
			echo '</script>';
			echo "<button onclick=\"abrirpopup('modulos/faturas/status.php?id=".$id."&".$atributos."','Fatura #".$id."'); return false;\" class=\"btn btn-primary center\" data-toggle=\"modal\"><i class=\"icon-retweet\"></i> REENVIADO</button><br>".data_hora_eua_brasil($data);
		}
		//echo "Email enviado com sucesso!";
	}   
	exit;
}
?>			

<div class="row-fluid">
        <center><br />
<p>Tem certeza que deseja <?php if ($funcao == 'envio') { echo 'enviar'; } else if ($funcao == 'reenvio') { echo 'reenviar'; } ?> essa fatura manualmente?</p>
      <p>
      <button class="btn btn-<?php if ($funcao == 'envio') { echo 'danger'; } else if ($funcao == 'reenvio') { echo 'primary'; } ?>" onclick="envio('<?php echo $funcao; ?>','<?php echo $id; ?>'); return false;"><i class="icon-<?php if ($funcao == 'envio') { echo 'envelope'; } else if ($funcao == 'reenvio') { echo 'retweet'; } ?> icon-white"></i> <?php if ($funcao == 'envio') { echo 'Enviar'; } else if ($funcao == 'reenvio') { echo 'Reenviar'; } ?></button>
    </p></center>
    </div>