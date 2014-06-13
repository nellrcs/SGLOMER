
<?php

echo "<form action='' method='POST'>";

if(Principal::se_plugin('social'))
{
	echo "<h3>Plugin social</h3>";
	$social = new Social($id_desta_pagina);
	$social->social_backend();
}	


if(Principal::se_plugin('buscainterna'))
{
	echo "<h3>Plugin Busa intena</h3>";
}



echo "<button>Salvar</button></form>";
?>