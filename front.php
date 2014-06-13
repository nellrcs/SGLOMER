

<?php
if(Principal::se_plugin('social'))
{
	echo "<h3>Plugin social</h3>";

	$social = new Social($id_desta_pagina);

	$social->define_insere_social('facebook');
}	


if(Principal::se_plugin('buscainterna'))
{
	echo "<h3>Plugin Busa intena</h3>";

	busca_interna();
}




?>