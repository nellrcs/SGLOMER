<?php
$Sec = $_GET['Secao'];

$url = explode('/', $_GET['Secao']);

//Envia o Id do Produto.
@$idUrl = $url[1];
//Verifica qual a categoria do produto.
@$catUrl = $url[2];
//VERIFICA PAGINAÇÃO

if ($url[0] == "exibe_galeria") 					{$Sec = "list_imagens";}
elseif ($url[0] == "exibe_onde") 					{$Sec = "desc_onde";}
else {$Sec = $url[0];}

if ($Sec == "") { if ($prod == 1)
		{ include "home.php";}else{include "home.php";} }

if ($Sec == "Inicial")							{include "home.php";}

elseif ($Sec == "quem_somos") 					{ include "empresa.php";}
elseif ($Sec == "servicos") 					{ include "servicos.php";}
elseif ($Sec == "contato") 						{ include "contato.php";}

else {include "pg_erro.php";}

?>