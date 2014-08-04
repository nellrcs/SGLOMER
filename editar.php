<?php

	$dados = $base::dados_post();

	$classe;
	$tipo = $url[1];
	switch ($tipo)
	{
		case 'textos':
			$classe = new Textos();
			break;
		case 'imagem':
			$classe = new Imagem();
			break;
		case 'formularios':
			$classe = new Formularios();
		break;
		case 'itens':
			$classe = new Itens();
		break;
                default :
	        foreach ( $base::ativos('plugins') as $valor) 
			{
	        	if($valor['nome'] == $tipo)
	        	{
	        		$tipo =  ucfirst($tipo);
	        		$classe = new $tipo();
	        	}	
	        }
	        ;break;    

	}

	$campos = $classe->backend($url[2],$dados);

	$formulario =  new Formularios();

	$formulario->form($campos,'','ENVIAR','');

?>
