<?php
if(Principal::se_plugin('googlemaps'))
{
	echo "<h3>Plugin googlemaps</h3>";

	$googlemaps = new Googlemaps($id_desta_pagina);

	$googlemaps->define_insere_googlemaps('mapas_contato');

}


?>