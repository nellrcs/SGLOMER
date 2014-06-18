
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
	echo "<h3>Plugin Google Maps</h3>";
	$googlemaps = new Googlemaps($id_desta_pagina);
	$googlemaps->googlemaps_backend();
}

if(Principal::se_plugin('chatonline'))
{
	echo "<h3>Plugin Chat Online</h3>";
	$chatonline = new Chatonline($id_desta_pagina);
	$chatonline->chatonline_backend();
}

echo "<button>Salvar</button></form>";
?>