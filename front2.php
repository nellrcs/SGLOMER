<?php
if(Principal::se_plugin('social'))
{
	echo "<h3>Plugin social</h3>";

	$social = new Social($id_desta_pagina);

	//isso eh esencial
	$social->define_insere_social('rede_social');

}	

?>