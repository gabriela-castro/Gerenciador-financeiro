
<?php

include '../../config/mysql.php';
include '../../config/funcoes.php';
//include '../../config/check.php';

$id   = (isset($_GET['id']) ? $_GET["id"] : '' );
$acao = (isset($_GET['acao']) ? $_GET["acao"] : '' );
$tp   = (isset($_GET['tp']) ? $_GET["tp"] : '' );
$id_cliente		= (isset($_GET['id_cliente']) ? $_GET["id_cliente"] : '' );

$modulo 	= 'faturas';
$tabela 	= 'faturas';
$atributos 	= 'id_cliente='.$id_cliente;


$fechado	= @data_brasil_eua((isset($_GET['fechado']) ? $_GET["fechado"] : '' ));
$status		= (isset($_GET['status']) ? $_GET["status"] : '' );

if ($acao == 'editar')
{
	
	mysqli_query($link,"UPDATE $tabela SET fechado='$fechado', status='$status' WHERE id='$id'");
	echo '<script> $(\'#envio_'.$id.'\').html(\' \'); </script>';
	echo '<button onclick="abrirpopup(\'modulos/'.$modulo.'/status.php?id='.$id.'&'.$atributos.'\',\'Fatura #'.$id.'\'); return false;" class="btn btn-success center" data-toggle="modal"><i class="icon-thumbs-up"></i> FECHADO</button>';
	exit;
}
	
$result = mysqli_query($link,"SELECT * FROM $tabela WHERE id='$id'");

$n = mysqli_fetch_array($result,MYSQLI_ASSOC);
/*echo('<pre>');
print_r($n);
exit;
*/
$id				= $n['id'];
if ($id_cliente == '') { $id_cliente = $n['id_cliente']; }

$vencimento		= @data_eua_brasil($n['vencimento']);
$data			= @data_hora_eua_brasil($n['data']);
$enviado		= @data_hora_eua_brasil($n['enviado']);
$reenviado		= @data_hora_eua_brasil($n['reenviado']);
$visualizado	= @data_hora_eua_brasil($n['visualizado']);
$vencimento		= @data_eua_brasil($n['vencimento']);
$fechado		= @data_eua_brasil($n['fechado']);

$id_servico1	= $n['id_servico1'];
$id_servico2	= $n['id_servico2'];
$id_servico3	= $n['id_servico3'];
$id_servico4	= $n['id_servico4'];
$id_servico5	= $n['id_servico5'];
$valor1			= $n['valor1'];
$valor2			= $n['valor2'];
$valor3			= $n['valor3'];
$valor4			= $n['valor4'];
$valor5			= $n['valor5'];
$status			= $n['status'];
$obs			= utf8_encode($n['obs']); 

//STATUS
if ($status == '1')
{
	$statusn = 'PENDENTE';
}
else if ($status == '2')
{
	$statusn = 'ENVIADO';
}
else if ($status == '3')
{
	$statusn = 'REENVIADO';
}
else if ($status == '4')
{
	$statusn = 'VISUALIZADO';
}
else if ($status == '5')
{
	$statusn = 'FECHADO';
}

//STATUS
$status1 = '<button onclick="" class="btn btn-danger center" data-toggle="modal"><i class="icon-thumbs-down"></i> PENDENTE</button>';
$status2 = '<button onclick="" class="btn btn-warning center" data-toggle="modal"><i class="icon-signin"></i> ENVIADO</button>';
$status3 = '<button onclick="" class="btn btn-primary center" data-toggle="modal"><i class="icon-retweet"></i> REENVIADO</button>';
$status4 = '<button onclick="" class="btn btn-info center" data-toggle="modal"><i class="icon-check"></i> VISUALIZADO</button>';
$status5 = '<button onclick="" class="btn btn-success center" data-toggle="modal"><i class="icon-thumbs-up"></i> FECHADO</button>';

//CLIENTE
if ($id_cliente != '')
{
	$tpcli = 'edit';
}
else
{
	$tpcli = $tp;
}
?>
   <style>
   <!--
   body,tr,td,div,span,a
   {
	   color:#000;   
   }
-->
</style>
<script> mascaras(); calendario('fechado'); </script>
<div class="row-fluid">
    <span class="span6">
    <h3><?php echo chamacampo('clientes','fantasia',$id_cliente); ?></h3>
    </span>
      <span class="span2">Status:<br />
      <select id="status" name="status" class=" span12">
    <option value="<?php echo $status; ?>" selected="selected"><?php echo $statusn; ?></option>  
    <option value="">--</option>
    <option value="5">FECHADO</option>
    </select>

  </span>

    <span class="span2">Vencimento:<br />
    <?php echo $vencimento; ?>
    </span>
    <span class="span2">Pagamento:<br />
    <input name="fechado" type="text" class="obrigatorio masc_data span12" id="fechado" value="<?php echo $fechado; ?>" size="50" maxlength="100" required="required">
    </span>
</div>
<div class="row-fluid">
    <span class="span6">
        <table class="table table-hover">
        <thead>
          <tr bgcolor="#E8E8E8">
            <th><i class="icon-question"></i> Descrição</th>
            <th><i class="icon-usd"></i> Preço</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo chamacampo('tiposervicos','nome',$id_servico1); ?></td>
            <td>R$ <?php echo moeda($valor1); ?></td>
          </tr>
          <?php if ($id_servico2 != 0) { ?>
          <tr>
            <td><?php echo chamacampo('tiposervicos','nome',$id_servico2); ?></td>
            <td>R$ <?php echo moeda($valor2); ?></td>
          </tr>
          <?php } if ($id_servico3 != 0) { ?>
          <tr>
            <td><?php echo chamacampo('tiposervicos','nome',$id_servico3); ?></td>
            <td>R$ <?php echo moeda($valor3); ?></td>
          </tr>
          <?php } if ($id_servico4 != 0) { ?>
          <tr>
            <td><?php echo chamacampo('tiposervicos','nome',$id_servico4); ?></td>
            <td>R$ <?php echo moeda($valor4); ?></td>
          </tr>
          <?php } if ($id_servico5 != 0) { ?>
          <tr>
            <td><?php echo chamacampo('tiposervicos','nome',$id_servico5); ?></td>
            <td>R$ <?php echo moeda($valor5); ?></td>
          </tr>
          <?php } ?>
          <tr>
            <td><div class="text-right">Total:</div></td>
            <td><b>R$ <?php echo moeda($valor1+$valor2+$valor3+$valor4+$valor5); ?></b></td>
          </tr>
        </tbody>
        </table>
    </span>
    <span class="span6">
       <table class="table table-hover">
        <thead>
          <tr bgcolor="#E8E8E8">
            <th><i class="icon-time"></i> Data</th>
            <th><i class="icon-ok"></i> Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo $data; ?></td>
            <td><?php echo $status1; ?></td>
          </tr>
          <?php if ($enviado != '00/00/0000 00:00:00') { ?>
          <tr>
            <td><?php echo $enviado; ?></td>
            <td><?php echo $status2; ?></td>
          </tr>
          <?php } if ($reenviado != '00/00/0000 00:00:00') { ?>
          <tr>
            <td><?php echo $reenviado; ?></td>
            <td><?php echo $status3; ?></td>
          </tr>
          <?php } if ($visualizado != '00/00/0000 00:00:00') { ?>
          <tr>
            <td><?php echo $visualizado; ?></td>
            <td><?php echo $status4; ?></td>
          </tr>
          <?php } if ($fechado != '00/00/0000') { ?>
          <tr>
            <td><?php echo $fechado; ?></td>
            <td><?php echo $status5; ?></td>
          </tr>
          <?php } ?>
        </tbody>
        </table>
    </span>
</div>
<div class="row-fluid">
</div>

<?php if ($tp != 'ver') { ?>
<div class="row-fluid">
    <center>
        <button class="btn btn-primary" onclick="form<?php echo $modulo; ?>2('<?php
  
            echo $id.'\',\'editar';
        ?>');" >Salvar</button>
    </center>
</div>
<?php } ?>

