

<?php
if(Principal::se_plugin('googlemaps'))
{	
	echo "<h2>_Plugin googlemaps</h2><hr>";

	$googlemaps = new Googlemaps($id_desta_pagina);

	$googlemaps->define_insere_googlemaps('mapas_contato');
}

?>