<?php
	require_once './class/Principal.class.php';

	//include './controle/estrutura.php';
    
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

	//PARA CONSTRUIR A TABELA
	Textos::montar();

?>