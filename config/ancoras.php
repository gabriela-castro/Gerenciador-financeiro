	if (ancora)
	{
		if (ancora == 'home' || ancora == '1' || ancora == 'inicial')
		{
			inicial('');
		}
		else if (ancora == 'usuarios')
		{
			usuarios('');
		}
		else if (ancora == 'filiais')
		{
			filiais('');
		}
		else if (ancora == 'tiposervicos')
		{
			tiposervicos('');
		}
		else if (ancora == 'conheceu')
		{
			conheceu('');
		}
		else if (ancora == 'clientes')
		{
			clientes('');
		}
		else if (ancora == 'faturas')
		{
			faturas('?id_cliente='+ancora2);
		}
		else if (ancora == 'contasapagar')
		{
			contasapagar('');
		}
		else if (ancora == 'recebimento')
		{
			recebimento('');
		}
		else if (ancora == 'boletos')
		{
			boletos('');
		}
		else if (ancora == 'intermediarios')
		{
			intermediarios('');
		}
		else if (ancora == 'financeiro')
		{
			financeiro('');
		}
		else if (ancora == 'baixa')
		{
			baixa('');
		}
		else if (ancora == 'fornecedores')
		{
			fornecedores('');
		}
		else
		{
			inicial('');
		}
	}
	else
	{
		inicial('');
	}