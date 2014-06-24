<?php
	$base = new Base($id_desta_pagina);

	class ex_obj 
	{public $nome_posicao_plugin;}
	$obj = new ex_obj();



	//plugin mapas
	$obj->nome_posicao_plugin = 'mapa_maringa';
	$base::front_end('googlemaps',$obj);


?>