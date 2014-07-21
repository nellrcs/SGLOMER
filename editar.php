<form method="post">
<?php

	$dados = $base::dados_post();
	$classe;
	switch ($url[1]) 
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
	}

	$classe->backend($url[2],$dados);

?>
<button>ENVIAR</button>
</form>