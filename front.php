

<?php
if(Principal::se_plugin('social'))
{
	echo "<h3>Plugin social</h3>";

	$social = new Social($id_desta_pagina);

	//isso eh esencial
	$social->define_insere_social('rede_social');

}	


if(Principal::se_plugin('buscainterna'))
{
	echo "<h3>Plugin Busa intena</h3>";

	//isso eh esencial
	busca_interna();
}


if(Principal::se_plugin('googlemaps'))
{
	echo "<h3>Plugin googlemaps</h3>";
	//hghjghghjghj

}




?>