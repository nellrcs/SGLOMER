<!doctype html>
<html lang="pt-br">
<head>
	<link rel="stylesheet" href="bootstrap-3.1.1/css/bootstrap.css">
	<meta charset="UTF-8">
	<title>Modulos</title>
</head>
<body>
<br>
<a href="?pg=front" class="btn btn-primary btn-lg">FRONT</a>
<a href="?pg=back" class="btn btn-default btn-lg">BACK</a>
<a href="?pg=plugins" class="btn btn-danger btn-lg">PLUGINS</a>


<?php
	require_once './class/Principal.class.php';
	/*
		Layout exclusivo
		Inserção de conteúdo inicial
		*Sistema de busca interna
		*Mapa de localização
		Formulário de contato
		*Redes sociais (integração);
		Imagens rotativas
		Galeria de imagens ou vídeos
		
		Integração Google Analytics
		Definição de palavras chaves
		Responsividade
		Chat online (Atendimento)
		Sistema de gerenciamento
		Enquetes
		Mala direta (Newsletter)
		Sistema de banners
		Controle de usuários (Gerencial)
		URL amigável
		Sitemap em XML
		Integração ao Google Webmaster
		Formulário personalizável
		Sistema de Blog
		Catálogo de produtos
		Comentário de usuários
		Carrinho de pedidos
		Controle de pedidos (Gerencial)
		Relatório (Gerencial)
	*/	

	//include './controle/estrutura.php';

	//CONFIGURACAO DO SITE //	
	$diretorio_total = Principal::caminho_diretorio();

	//CRIA PASTA CENTRAL DE UPLOAD "uploads"
	Principal::cria_diretorios_upload();

	//INCLUI MODULO FIXO TEXTOS
	include ('modulos/textos/textos.php');

	include ('modulos/imagem/imagem.php');

	include ('modulos/formularios/formularios.php');


	//INCLUIR BASE
	include './class/Base.class.php';


	//CADA PAGINA TERA UM ID
	$id_desta_pagina = 15;

	//TEMPORARIO PAR TESTE
	if (!empty($_GET['pg'])) 
	{
		switch ($_GET['pg']) 
		{
			case 'front':
				include 'front.php';
			break;
			
			case 'back':
				include 'back.php';
			break;

			case 'plugins':
				include 'plugins.php';
			break;	

			default:
				include 'front.php';
			break;
		}
	}


?>

</body>
</html>
