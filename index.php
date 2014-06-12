<!doctype html>
<html lang="pt-br">
<head>
	<link rel="stylesheet" href="bootstrap-3.1.1/css/bootstrap.css">
	<meta charset="UTF-8">
	<title>Modulos</title>
</head>
<body>
<?php
	require_once './class/Principal.class.php';
	/*
		Layout exclusivo
		Inserção de conteúdo inicial
		Sistema de busca interna
		Mapa de localização
		Formulário de contato
		Redes sociais (integração);
		Imagens rotativas
		Galeria de imagens ou vídeos
		Integração ao Google
		Integração ao Google Maps
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

	//GERA TABELA SLIDER
	include ('modulos/banner/banner.php');

	//GERA TABELA NEWSLETTER
	include ('modulos/news/news.php');

	//GERA TABELA TRABALHE CONOSCO
	include ('modulos/trabalhe_conosco/trabalhe_conosco.php');

	//GERA TABELA ADMIN
	include ('modulos/admin/admin.php');

	//GERA TABELA ADMIN
	include ('modulos/galeria/galeria.php');

	//GERA TABELA REPRESENTANTES
	include ('modulos/representantes/representantes.php');

	//GERA TABELA TEXTOS
	include ('modulos/textos/textos.php');

?>

</body>
</html>
