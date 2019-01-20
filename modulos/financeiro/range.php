<script> mascaras(); calendario('inicio');  calendario('final'); </script>
<div class="row-fluid">
    
    <span class="span2"><span id="tfantasia"><?php echo utf8_encode('Início');?></span>:<br />
    <input name="inicio" type="text" class="obrigatorio masc_data span12" id="inicio"  size="50" maxlength="100" required="required">
    </span>
	<span class="span2"><span id="tfantasia">Final</span>:<br />
    <input name="final" type="text" class="obrigatorio masc_data span12" id="final" size="50" maxlength="100" required="required">
    </span>
</div>

<div class="row-fluid">
    <center>
        <button class="btn btn-primary" onclick="rangefinanceiro();" >Enviar</button>
    </center>
</div>