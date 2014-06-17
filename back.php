
<?php
if(!empty($_GET['id']))
{
	$id_desta_pagina = $_GET['id'];
	
}


echo "<form action='' method='POST'>";

if(Principal::se_plugin('social'))
{
	echo "<h3>Plugin social</h3>";
	$social = new Social($id_desta_pagina);
	$social->social_backend();
}	


if(Principal::se_plugin('buscainterna'))
{
	echo "<h3>Plugin Busca interna</h3>";
}

if(Principal::se_plugin('googlemaps'))
{
	$googlemaps = new Googlemaps($id_desta_pagina);
	$googlemaps->googlemaps_backend();
	echo "<h3>Plugin Google Maps</h3>";
}



echo "<button>Salvar</button></form>";
?>