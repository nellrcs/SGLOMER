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

if ($Sec == "") { if ($prod == 1) { include "configuracoes.php";}else{include "configuracoes.php";} }

if ($Sec == "configuracoes")				{ include "configuracoes.php"; }
elseif ($Sec == "central") 					{ include "central.php"; }
elseif ($Sec == "editar") 					{ include "editar.php"; }
elseif ($Sec == "modulo") 					{ include "modulo.php"; }
elseif ($Sec == "plugin") 					{ include "plugin.php"; }
elseif ($Sec == "upload_de_imagem") 				{ include "upload_de_imagem.php"; }

else {include "pg_erro.php";}

?>
