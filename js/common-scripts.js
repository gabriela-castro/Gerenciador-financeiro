var Script = function () {

//    sidebar dropdown menu

    jQuery('#sidebar .sub-menu > a').click(function () {
        var last = jQuery('.sub-menu.open', $('#sidebar'));
        last.removeClass("open");
        jQuery('.arrow', last).removeClass("open");
        jQuery('.sub', last).slideUp(200);
        var sub = jQuery(this).next();
        if (sub.is(":visible")) {
            jQuery('.arrow', jQuery(this)).removeClass("open");
            jQuery(this).parent().removeClass("open");
            sub.slideUp(200);
        } else {
            jQuery('.arrow', jQuery(this)).addClass("open");
            jQuery(this).parent().addClass("open");
            sub.slideDown(200);
        }
    });

//sidebar toggle

    $('.icon-reorder').click(function () {
        if ($('#sidebar > ul').is(":visible") === true) {
            $('#main-content').css({
                'margin-left': '0px'
            });
            $('#sidebar').css({
                'margin-left': '-180px'
            });
            $('#sidebar > ul').hide();
            $("#container").addClass("sidebar-closed");
        } else {
            $('#main-content').css({
                'margin-left': '180px'
            });
            $('#sidebar > ul').show();
            $('#sidebar').css({
                'margin-left': '0'
            });
            $("#container").removeClass("sidebar-closed");
        }
    });

// custom scrollbar
    $(".sidebar-scroll").niceScroll({styler:"fb",cursorcolor:"#4A8BC2", cursorwidth: '5', cursorborderradius: '0px', background: '#404040', cursorborder: ''});

    $("html").niceScroll({styler:"fb",cursorcolor:"#4A8BC2", cursorwidth: '8', cursorborderradius: '0px', background: '#404040', cursorborder: '', zindex: '1000'});


// theme switcher

    var scrollHeight = '60px';
    jQuery('#theme-change').click(function () {
        if ($(this).attr("opened") && !$(this).attr("opening") && !$(this).attr("closing")) {
            $(this).removeAttr("opened");
            $(this).attr("closing", "1");

            $("#theme-change").css("overflow", "hidden").animate({
                width: '20px',
                height: '22px',
                'padding-top': '3px'
            }, {
                complete: function () {
                    $(this).removeAttr("closing");
                    $("#theme-change .settings").hide();
                }
            });
        } else if (!$(this).attr("closing") && !$(this).attr("opening")) {
            $(this).attr("opening", "1");
            $("#theme-change").css("overflow", "visible").animate({
                width: '226px',
                height: scrollHeight,
                'padding-top': '3px'
            }, {
                complete: function () {
                    $(this).removeAttr("opening");
                    $(this).attr("opened", 1);
                }
            });
            $("#theme-change .settings").show();
        }
    });

    jQuery('#theme-change .colors span').click(function () {
        var color = $(this).attr("data-style");
        setColor(color);
    });

    jQuery('#theme-change .layout input').change(function () {
        setLayout();
    });

    var setColor = function (color) {
        $('#style_color').attr("href", "css/style-" + color + ".css");
    }

// widget tools

    jQuery('.widget .tools .icon-chevron-down, .widget .tools .icon-chevron-up').click(function () {
        var el = jQuery(this).parents(".widget").children(".widget-body");
        if (jQuery(this).hasClass("icon-chevron-down")) {
            jQuery(this).removeClass("icon-chevron-down").addClass("icon-chevron-up");
            el.slideUp(200);
        } else {
            jQuery(this).removeClass("icon-chevron-up").addClass("icon-chevron-down");
            el.slideDown(200);
        }
    });

    jQuery('.widget .tools .icon-remove').click(function () {
        jQuery(this).parents(".widget").parent().remove();
    });
    
//    tool tips

    $('.element').tooltip();

    $('.tooltips').tooltip();

//    popovers

    $('.popovers').popover();

// scroller

    $('.scroller').slimscroll({
        height: 'auto'
    });


}();

//DATA TABLE
function datatable(camada)
{
	var i = 0;
	// Verifica se existe uma DataTable a ser transformada
	$(camada).each(function()
	{
		if (!$(this).parent().is(".dataTables_wrapper"))
		{
			i = i+1;
		}
	});
	// se existir, essa datatable é acionada
	if(i>0)
	{
		$(camada).dataTable(
		{
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
			"sPaginationType": "bootstrap",
			"bPaginate" :true,
			"oLanguage": {
			"oPaginate": {
			"sFirst" : "First",
			"sLast" : "Last",
			"sPrevious" : "Anterior",
			"sNext" : "Próxima",
			"sEmptyTable" : "Nenhum Resultado"
			},
			"sInfo" : "Mostrando _START_ até _END_ do total de _TOTAL_ entradas",
			"sInfoEmpty" : "Mostrando 0 a 0 de 0 entradas",
			"sInfoFiltered" : "(Filtrado de um total de _MAX_ entradas)",
			"sLengthMenu" : "_MENU_ resultados por página",
			"sLoadingRecords" : "Carregando...",
			"sProcessing" : "Processando...",
			"sZeroRecords" : "<center>Nenhum Resultado Encontrado :(</center>",
			"sSearch" : "Buscar:"
			},
			"bLengthChange" :true,
			"bFilter" :true,
			"bSort" :true,
			"bInfo" :true,
			"bAutoWidth" :true/*,                         
		  "iDisplayLength": 25 */
		});
		jQuery('.dataTables_filter input').addClass("input"); // modify table search input
		jQuery('.dataTables_length select').addClass("input-mini"); // modify table per page dropdown
	}
}
//OCULTAR
function ocultar(camada1,camada2)
{
	$(''+camada1+'').hide('fast');
	$(''+camada2+'').show('fast');
	
}
//abrir url em botao
function abrirurl(url)
{
	return window.open(url);	
}
// ANCORA
function ancora(ancora)
{
	return document.location.replace(ancora);
}
// CALENDARIO
function calendario(id)
{
	$('#'+id+'').datepicker(
	{
		format: 'dd/mm/yyyy'		
    });
}
// SOMENTE NUMEROS
function numeros(e)
{
	if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57))
	{
		return false;
	}
}
function numeros2(evt)
{
var theEvent = evt || window.event;  
  var key = ( theEvent.which ) ? theEvent.which : theEvent.keyCode  
  key = String.fromCharCode( key );  
  var regex = /[0-9]|\,/;  
  if ([evt.keyCode||evt.which]== 8 || [evt.keyCode||evt.which]== 9) //this is to allow backspace  
    return true;  
  if( !regex.test(key) ) {  
    theEvent.returnValue = false;  
    theEvent.preventDefault();  
  } 	
}

// MASCARAS
function mascaras()
{
   $(".masc_data").mask("99/99/9999");
   $(".masc_hora").mask("99:99");
   $(".masc_cep").mask("99.999-999");
   $(".masc_cpf").mask("999.999.999-99");
   $(".masc_cnpj").mask("99.999.999/9999-99");
   $(".masc_tel").mask("(99) 9999-9999?9");
   $(".masc_num").keypress(numeros);
   $(".masc_preco").priceFormat({
     prefix: '',
     centsSeparator: ',',
     thousandsSeparator: '.'
 });
}

//AJAX
function ajax(camada,pagina)
{
	$(camada).html('<div class="progress progress-striped active"><div class="bar" style="width: 100%;"></div></div>');
	$.ajax(
	{
		url: pagina,
		cache: false,
		async: true,
		success: function(html)
		{
			$(camada).html(html);
		}
	});
}

//ABRIR POPUP
function abrirpopup(pagina,titulo)
{
	largura = $(window).width();
	altura = $(window).height();

	
	$('.conteudopopup').html('<div class="progress progress-striped active"><div class="bar" style="width: 100%;"></div></div>');
	$('#titulo').text(titulo);
	$('.luz').fadeIn('fast');
	$(".popup").fadeIn('fast');
	
	ajax('.conteudopopup',pagina);
	

}
//FECHAR POPUP
function fecharpopup()
{
	$('.luz').fadeOut('fast');
	$(".popup").fadeOut('fast');
	$('.conteudopopup').html('');
	$('#titulo').text('');
}
//meio
function meio(camada,pagina,titulo,modulo)
{
	
	$('.titulomeio').text(titulo);
	$('.menu').removeClass('active');
	$('.'+modulo).addClass('active');
	$(camada).html('<div class="progress progress-striped active"><div class="bar" style="width: 100%;"></div></div>');
	$.ajax(
	{
		url: 'modulos/'+modulo+'/'+pagina,
		cache: false,
		async: true,
		success: function(html)
		{
			$(camada).html(html);
		}
	});
}
// inicial
function inicial(atributos)
{
	meio('#conteudo','index.php'+atributos+'','Home','inicial');
}
// baixa
function baixa(atributos)
{
	meio('#conteudo','baixa.php'+atributos+'','Baixa de fatura','faturas');
}
// financeiro
function financeiro(atributos)
{
	meio('#conteudo','index.php'+atributos+'','Financeiro','financeiro');
}
// recebimento
function recebimento(atributos)
{
	meio('#conteudo','index.php'+atributos+'','Tipos de recebimento','recebimento');
}
// contatos
function contatos(atributos)
{
	meio('#conteudo','index.php'+atributos+'','Contatos','contatos');
}
// biblioteca
function biblioteca(atributos)
{
	meio('#conteudo','index.php'+atributos+'','Biblioteca','biblioteca');
}
// Fornecedores
function fornecedores(atributos)
{
	meio('#conteudo','index.php'+atributos+'','Fornecedores','fornecedores');
}
// ADICIONAR PASTA
function addpasta(pai)
{
	var titulo		= escape($("#titulop").val());
	var descricao	= escape($("#descricao").val());

	
	if (titulo == '')
	{
		alert ('Os campos com borda marcada são obrigatorios.');
		
		$(".obrigatorio").css('border', '1px solid #FFAEB0');
	}
	else 
	{
		ajax('.conteudopopup', 'modulos/biblioteca/adicionar.php?acao=adicionar&pai='+pai+'&titulo='+titulo+'&descricao='+descricao);
	}	

}
// EDITAR PASTA E ARQUIVOS
function editbiblioteca(id,pai)
{
	var titulo		= escape($("#titulop").val());
	var descricao	= escape($("#descricao").val());
	
	if (titulo == '')
	{
		alert ('Os campos com borda marcada são obrigatorios.');
		
		$(".obrigatorio").css('border', '1px solid #FFAEB0');
	}
	else 
	{
		ajax('.conteudopopup', 'modulos/biblioteca/editar.php?acao=editar&id='+id+'&pai='+pai+'&titulo='+titulo+'&descricao='+descricao);
	}	

}
//DELETAR PASTA E ARQUIVOS
function delbiblioteca(id,pai,tipo,arquivo)
{
	ajax('.conteudopopup','modulos/biblioteca/deletar.php?acao=deletar&id='+id+'&pai='+pai+'&tipo='+tipo+'&arquivo='+arquivo);
}

// UPLOAD
function upload(pai)
{
$('#upload').uploadify({
    'uploader' 		: 'upload/uploadify.swf',
    'script'   		: 'upload/upload.php?pai='+pai,
    'cancelImg'		: 'upload/cancel.png',
    'folder'   		: 'arquivos/',
  	'fileExt'  		: '*.jpg;*.jpeg;*.doc;*.docx;*.pdf;*.gif;*.xls;*.xlsx;*.ppt;*.pptx;*.pps;*.ppsx;*.png;*.txt;*.odt',
  	'fileDesc' 		: 'Arquivos de texto, planilhas e imagens...',
	'width'    		: '180',
  	'height'    	: '42',
	'buttonImg'		: 'img/enviar.png',
  	'auto'     		: true,
  	'multi'     	: true,
	'wmode'			: 'transparent',
	'onAllComplete' : function(event,data)
	{
		biblioteca('?pai='+pai);
    }
  });
  
}
// usuarios
function usuarios(atributos)
{
	meio('#conteudo','index.php'+atributos+'','Usuários','usuarios');
}
// ADICIONAR usuarios
function addusuario()
{
	var nome	= escape($("#nome").val());
	var email	= escape($("#email").val());
	var login	= escape($("#login").val());
	var senha	= escape($("#senha").val());
	
	if (nome == '' || email == '' || login == '' || senha == '')
	{
		alert ('Os campos com borda marcada são obrigatorios.');
		
		$(".obrigatorio").css('border', '1px solid #FFAEB0');
	}
	else 
	{
		ajax('.conteudopopup', 'modulos/usuarios/adicionar.php?acao=adicionar&nome='+nome+'&email='+email+'&login='+login+'&senha='+senha);
	}	

}
// EDITAR usuarios
function editusuario(id)
{
	var nome	= escape($("#nome").val());
	var email	= escape($("#email").val());
	var login	= escape($("#login").val());
	var senha	= escape($("#senha").val());
	
	if (nome == '' || email == '' || login == '' || senha == '')
	{
		alert ('Os campos com borda marcada são obrigatorios.');
		
		$(".obrigatorio").css('border', '1px solid #FFAEB0');
	}
	else 
	{
		ajax('.conteudopopup', 'modulos/usuarios/editar.php?acao=editar&id='+id+'&nome='+nome+'&email='+email+'&login='+login+'&senha='+senha);
	}	

}
//DELETAR usuarios
function delusuario(id)
{
	ajax('.conteudopopup','modulos/usuarios/deletar.php?acao=deletar&id='+id);
}
// CONHECEU
function conheceu(atributos)
{
	meio('#conteudo','index.php'+atributos+'','Como Conheceu','conheceu');
}
// ADICIONAR CONHECEU
function formconheceu(id,acao)
{
	var nome		= escape($("#nome").val());
	
	if (nome == '')
	{
		alert ('Os campos com borda marcada são obrigatorios.');
		
		$(".obrigatorio").css('border', '1px solid #FFAEB0');
	}
	else 
	{
		ajax('.conteudopopup', 'modulos/conheceu/form.php?acao='+acao+'&id='+id+'&nome='+nome);
	}	

}
//DELETAR CONHECEU
function delconheceu(id)
{
	ajax('.conteudopopup','modulos/conheceu/deletar.php?acao=deletar&id='+id);
}

// TIPO SERVIÇOS
function tiposervicos(atributos)
{
	meio('#conteudo','index.php'+atributos+'','Serviços','tiposervicos');
}
// FORM TIPO SERVIÇOS
function formtiposervicos(id,acao)
{
	var nome		= escape($("#nome").val());
	
	if (nome == '')
	{
		alert ('Os campos com borda marcada são obrigatorios.');
		
		$(".obrigatorio").css('border', '1px solid #FFAEB0');
	}
	else 
	{
		ajax('.conteudopopup', 'modulos/tiposervicos/form.php?acao='+acao+'&id='+id+'&nome='+nome);
	}	

}
//DELETAR TIPO SERVIÇOS
function deltiposervicos(id)
{
	ajax('.conteudopopup','modulos/tiposervicos/deletar.php?acao=deletar&id='+id);
}

// FILIAIS
function filiais(atributos)
{
	meio('#conteudo','index.php'+atributos+'','Filiais','filiais');
}
// ADICIONAR FILIAIS
function formfiliais(id,acao)
{
	var nome		= escape($("#nome").val());
	
	if (nome == '')
	{
		alert ('Os campos com borda marcada são obrigatorios.');
		
		$(".obrigatorio").css('border', '1px solid #FFAEB0');
	}
	else 
	{
		ajax('.conteudopopup', 'modulos/filiais/form.php?acao='+acao+'&id='+id+'&nome='+nome);
	}	

}
//DELETAR FILIAIS
function delfiliais(id)
{
	ajax('.conteudopopup','modulos/filiais/deletar.php?acao=deletar&id='+id);
}

// CLIENTES
function clientes(atributos)
{
	meio('#conteudo','index.php'+atributos+'','Clientes','clientes');
}
//TIPO CLIENTES
function tipoclientes()
{
	$('#tipo').on('change', function() {
				
		var tipo = this.value;
		
		if (tipo == '1')
		{
			$(".fisica").fadeOut('fast');
			$(".juridica").fadeIn('fast');
			$("#tfantasia").text('Nome Fantasia');
		}
		else if (tipo == '2')
		{
			$(".juridica").fadeOut('fast');
			$(".fisica").fadeIn('fast');
			$("#tfantasia").text('Nome');			
		}
	});
}
// FORM CLIENTES
function formclientes(id,acao)
{	
	var id_filial	=	escape($('#id_filial').val());
	var id_conheceu	=	escape($('#id_conheceu').val());
	var tipo		=	escape($('#tipo').val());
	var nome		=	escape($('#nome').val());
	var razao		=	escape($('#razao').val());
	var fantasia	=	escape($('#fantasia').val());
	var email		=	escape($('#email').val());
	var nascimento	= 	escape($('#nascimento').val());
	var cpf			=	escape($('#cpf').val());
	var cnpj		=	escape($('#cnpj').val());
	var rg			=	escape($('#rg').val());
	var orgao		=	escape($('#orgao').val());
	var endereco	=	escape($('#endereco').val());
	var cep			=	escape($('#cep').val());
	var bairro		=	escape($('#bairro').val());
	var cidade		=	escape($('#cidade').val());
	var uf			=	escape($('#uf').val());
	var tel1		=	escape($('#tel1').val());
	var tel2		=	escape($('#tel2').val());
	var tel3		=	escape($('#tel3').val());
	var obs			=	escape($('#obs').val());
	
	if ((conheceu == '' || nome == '' || fantasia == '' || email == '' || cpf == '' || tel1 == '' || cidade == '') && tipo == '2')
	{
		alert ('Os campos com borda marcada são obrigatorios.');
		
		$(".obrigatorio").css('border', '1px solid #FFAEB0');
	}
	else if ((conheceu == '' || nome == '' || razao == '' || fantasia == '' || email == '' || cnpj == '' || tel1 == '' || cidade == '') && tipo == '1')
	{
		alert ('Os campos com borda marcada são obrigatorios.');
		
		$(".obrigatorio").css('border', '1px solid #FFAEB0');
	}
	else 
	{
		ajax('.conteudopopup', 'modulos/clientes/form.php?acao='+acao+'&id='+id+'&id_filial='+id_filial+'&id_conheceu='+id_conheceu+'&tipo='+tipo+'&nome='+nome+'&razao='+razao+'&fantasia='+fantasia+'&email='+email+'&nascimento='+nascimento+'&cpf='+cpf+'&cnpj='+cnpj+'&rg='+rg+'&orgao='+orgao+'&endereco='+endereco+'&cep='+cep+'&bairro='+bairro+'&cidade='+cidade+'&uf='+uf+'&tel1='+tel1+'&tel2='+tel2+'&tel3='+tel3+'&obs='+obs);
	}

}
//DELETAR CLIENTES
function delclientes(id)
{
	ajax('.conteudopopup','modulos/clientes/deletar.php?acao=deletar&id='+id);
}

//ATUALIZAR STATUS
function status(tabela,status,id,modulo)
{
		if (status == 1)
		{
			ajax('#status_'+modulo+'_'+id,'modulos/status.php?id='+id+'&tabela='+tabela+'&modulo='+modulo+'&status=2');
		}
		else if (status == 2)
		{
			ajax('#status_'+modulo+'_'+id,'modulos/status.php?id='+id+'&tabela='+tabela+'&modulo='+modulo+'&status=1');
		}
}


// FATURAS
function faturas(atributos)
{
	meio('#conteudo','index.php'+atributos+'','Faturas','faturas');
}
// ENVIA FATURAS
function envio(acao,id)
{
	ajax('#status_faturas_'+id, 'modulos/faturas/envio.php?acao='+acao+'&id='+id);
	fecharpopup();
	//ajax('.conteudopopup', 'modulos/faturas/envio.php?acao='+acao+'&id='+id);
}

//TIPO FATURAS
function tipofaturas()
{
	$('#tipo').on('change', function() {
				
		var tipo = this.value;
		
		if (tipo == '1')
		{
			$(".fisica").fadeOut('fast');
			$(".juridica").fadeIn('fast');
		}
		else if (tipo == '2')
		{
			$(".juridica").fadeOut('fast');
			$(".fisica").fadeIn('fast');			
		}
	});
}
// FORM FATURAS
function formfaturas2(id,acao)
{	

	var fechado	=	escape($('#fechado').val());
	var status	=	escape($('#status').val());
	
	if (fechado == '' || fechado == '00/00/0000' || status != '5')
	{
		alert ('Os campos com borda marcada são obrigatorios.');
		
		$(".obrigatorio").css('border', '1px solid #FFAEB0');
	}
	else 
	{
		fecharpopup();
		ajax('#status_faturas_'+id, 'modulos/faturas/status.php?acao='+acao+'&id='+id+'&fechado='+fechado+'&status='+status);
	}

}
// FORM FATURAS
function formfaturas(id,acao)
{	
	var id_cliente	=	escape($('#id_cliente').val());
	var vencimento	=	escape($('#vencimento').val());
	var id_servico1	=	escape($('#id_servico1').val());
	var id_servico2	=	escape($('#id_servico2').val());
	var id_servico3	=	escape($('#id_servico3').val());
	var id_servico4	=	escape($('#id_servico4').val());
	var id_servico5	=	escape($('#id_servico5').val());
	var valor1		=	escape($('#valor1').val());
	var valor2		=	escape($('#valor2').val());
	var valor3		=	escape($('#valor3').val());
	var valor4		=	escape($('#valor4').val());
	var valor5		=	escape($('#valor5').val());
	var obs			=	escape($('#obs').val());
	
	if (id_cliente == '' || vencimento == '' || id_servico1 == '' || valor1 == '')
	{
		alert ('Os campos com borda marcada são obrigatorios.');
		
		$(".obrigatorio").css('border', '1px solid #FFAEB0');
	}
	else 
	{
		ajax('.conteudopopup', 'modulos/faturas/form.php?acao='+acao+'&id='+id+'&id_cliente='+id_cliente+'&vencimento='+vencimento+'&id_servico1='+id_servico1+'&id_servico2='+id_servico2+'&id_servico3='+id_servico3+'&id_servico4='+id_servico4+'&id_servico5='+id_servico5+'&valor1='+valor1+'&valor2='+valor2+'&valor3='+valor3+'&valor4='+valor4+'&valor5='+valor5+'&obs='+obs);
	}

}

// FORM financeiro
function rangefinanceiro()
{	

	var inicio	=	escape($('#inicio').val());
	var fina	=	escape($('#final').val());
	
	if (inicio == '' || fina == '00/00/0000' )
	{
		alert ('Os campos com borda marcada são obrigatorios.');
		
		$(".obrigatorio").css('border', '1px solid #FFAEB0');
	}
	else 
	{
		fecharpopup();
		abrirurl('emissao.php?inicio='+inicio+'&final='+fina);
		//ajax('#status_faturas_'+id, 'modulos/faturas/status.php?acao='+acao+'&id='+id+'&fechado='+fechado+'&status='+status);
	}

}
//DELETAR FATURAS
function delfaturas(id,atributos)
{
	ajax('.conteudopopup','modulos/faturas/deletar.php?acao=deletar&id='+id+atributos);
}

// CONTAS A PAGAR
function contasapagar(atributos)
{
	meio('#conteudo','index.php'+atributos+'','Contas a pagar','contasapagar');
}
// ADICIONAR CONTAS A PAGAR
function formcontasapagar(id,acao,atributos)
{
	var titulo		= escape($("#titulof").val());
	var valor		= escape($("#valor").val());
	var valor_pago	= escape($("#valor_pago").val());
	var vencimento	= escape($("#vencimento").val());
	var pagamento	= escape($("#pagamento").val());
	var obs			= escape($("#obs").val());
	var fornecedor  = escape($("#id_fornecedor").val())
	
	if (titulo == '' || valor == '' || vencimento == '')
	{
		alert ('Os campos com borda marcada são obrigatorios.');
		
		$(".obrigatorio").css('border', '1px solid #FFAEB0');
	}
	else 
	{
		ajax('.conteudopopup', 'modulos/contasapagar/form.php?acao='+acao+'&fornecedor='+fornecedor+'&id='+id+'&titulo='+titulo+'&valor='+valor+'&valor_pago='+valor_pago+'&vencimento='+vencimento+'&pagamento='+pagamento+'&obs='+obs+atributos);
	}	

}
//DELETAR CONTAS A PAGAR
function delcontasapagar(id,atributos)
{
	ajax('.conteudopopup','modulos/contasapagar/deletar.php?acao=deletar&id='+id+atributos);
}

// BOLETOS
function boletos(atributos)
{
	meio('#conteudo','index.php'+atributos+'','Boletos','boletos');
}
// FORM BOLETOS
function formboletos(id,acao)
{	
	var banco				= escape($('#banco').val());
	var prazo				= escape($('#prazo').val());
	var taxa				= escape($('#taxa').val());
	var conta_cedente		= escape($('#conta_cedente').val());
	var conta_cedente_d		= escape($('#conta_cedente_d').val());
	var agencia				= escape($('#agencia').val());
	var agencia_d			= escape($('#agencia_d').val());
	var conta				= escape($('#conta').val());
	var conta_d				= escape($('#conta_d').val());
	var carteira			= escape($('#carteira').val());
	var carteira_descricao	= escape($('#carteira_descricao').val());
	var identificacao		= escape($('#identificacao').val());
	var cpf_cnpj			= escape($('#cpf_cnpj').val());
	var endereco			= escape($('#endereco').val());
	var cidade				= escape($('#cidade').val());
	var uf					= escape($('#uf').val());
	var cedente				= escape($('#cedente').val());
	var convenio			= escape($('#convenio').val());
	var contrato			= escape($('#contrato').val());
	var instrucoes1			= escape($('#instrucoes1').val());
	var instrucoes2			= escape($('#instrucoes2').val());
	var instrucoes3			= escape($('#instrucoes3').val());
	var instrucoes4			= escape($('#instrucoes4').val());
	var obs					= escape($('#obs').val());
	
	if (prazo == '' || taxa == '' || carteira == '' || identificacao == '' || cpf_cnpj == '' || endereco == '' || cidade == '' || uf == '' || cedente == '' || instrucoes1 == '')
	{
		alert ('Os campos com borda marcada são obrigatorios.');
		
		$(".obrigatorio").css('border', '1px solid #FFAEB0');
	}
	else 
	{
		ajax('.conteudopopup', 'modulos/boletos/form.php?acao='+acao+'&id='+id+'&banco='+banco+'&prazo='+prazo+'&taxa='+taxa+'&conta_cedente='+conta_cedente+'&conta_cedente_d='+conta_cedente_d+'&agencia='+agencia+'&agencia_d='+agencia_d+'&conta='+conta+'&conta_d='+conta_d+'&carteira='+carteira+'&carteira_descricao='+carteira_descricao+'&identificacao='+identificacao+'&cpf_cnpj='+cpf_cnpj+'&endereco='+endereco+'&cidade='+cidade+'&uf='+uf+'&cedente='+cedente+'&convenio='+convenio+'&contrato='+contrato+'&instrucoes1='+instrucoes1+'&instrucoes2='+instrucoes2+'&instrucoes3='+instrucoes3+'&instrucoes4='+instrucoes4+'&obs='+obs);
	}

}

// INTERMEDIARIOS
function intermediarios(atributos)
{
	meio('#conteudo','index.php'+atributos+'','Intermediarios','intermediarios');
}
// FORM INTERMEDIARIOS
function formintermediarios(id,acao)
{	
	var nome				= escape($('#nome').val());
	var email				= escape($('#email').val());
	
	if (nome == '' || email == '')
	{
		alert ('Os campos com borda marcada são obrigatorios.');
		
		$(".obrigatorio").css('border', '1px solid #FFAEB0');
	}
	else 
	{
		ajax('.conteudopopup', 'modulos/intermediarios/form.php?acao='+acao+'&id='+id+'&nome='+nome+'&email='+email);
	}

}


// FORM FORNECEDORES
function formfornecedores(id,acao)
{	
	var id_filial	=	escape($('#id_filial').val());
	var id_conheceu	=	escape($('#id_conheceu').val());
	var tipo		=	escape($('#tipo').val());
	var nome		=	escape($('#nome').val());
	var razao		=	escape($('#razao').val());
	var fantasia	=	escape($('#fantasia').val());
	var email		=	escape($('#email').val());
	var nascimento	= 	escape($('#nascimento').val());
	var cpf			=	escape($('#cpf').val());
	var cnpj		=	escape($('#cnpj').val());
	var rg			=	escape($('#rg').val());
	var orgao		=	escape($('#orgao').val());
	var endereco	=	escape($('#endereco').val());
	var cep			=	escape($('#cep').val());
	var bairro		=	escape($('#bairro').val());
	var cidade		=	escape($('#cidade').val());
	var uf			=	escape($('#uf').val());
	var tel1		=	escape($('#tel1').val());
	var tel2		=	escape($('#tel2').val());
	var tel3		=	escape($('#tel3').val());
	var obs			=	escape($('#obs').val());
	
	if ((conheceu == '' || nome == '' || fantasia == '' || email == '' || cpf == '' || tel1 == '' || cidade == '') && tipo == '2')
	{
		alert ('Os campos com borda marcada são obrigatorios.');
		
		$(".obrigatorio").css('border', '1px solid #FFAEB0');
	}
	else if ((conheceu == '' || nome == '' || razao == '' || fantasia == '' || email == '' || cnpj == '' || tel1 == '' || cidade == '') && tipo == '1')
	{
		alert ('Os campos com borda marcada são obrigatorios.');
		
		$(".obrigatorio").css('border', '1px solid #FFAEB0');
	}
	else 
	{
		ajax('.conteudopopup', 'modulos/fornecedores/form.php?acao='+acao+'&id='+id+'&id_filial='+id_filial+'&id_conheceu='+id_conheceu+'&tipo='+tipo+'&nome='+nome+'&razao='+razao+'&fantasia='+fantasia+'&email='+email+'&nascimento='+nascimento+'&cpf='+cpf+'&cnpj='+cnpj+'&rg='+rg+'&orgao='+orgao+'&endereco='+endereco+'&cep='+cep+'&bairro='+bairro+'&cidade='+cidade+'&uf='+uf+'&tel1='+tel1+'&tel2='+tel2+'&tel3='+tel3+'&obs='+obs);
	}

}
//DELETAR CLIENTES
function delfornecedores(id)
{
	ajax('.conteudopopup','modulos/fornecedores/deletar.php?acao=deletar&id='+id);
}
