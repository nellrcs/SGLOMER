<h1>home</h1>
<?php 
	//TEXTO
	$textos_pag_home = new Textos($base::$id_pagina);
	echo $textos_pag_home->preciso_texto_aqui('TEXTO_HOME1', 0, 'ola mundo', 'nt');
	echo $textos_pag_home->preciso_texto_aqui('TEXTO_HOME2', 0, 'KKKKKKK', 'nt');
	echo $textos_pag_home->preciso_texto_aqui('TEXTO_HOME3', 0, 'RERERERER', 'nt');
	echo $textos_pag_home->preciso_texto_aqui('TEXTO_HOME4', 0, 'sksoksoskoskso', 'nt');

	echo "<br>";

	//PLUGIN GOOGLE MAPAS
	/* DECLARA */
	$base::$nome_plugin = 'googlemaps';  
    $obj = $base::obj_plugin();
	//--------------------------------

    
    $obj->nome_posicao_plugin = "novo_gmapas";
   	echo $base::front_end($obj);

   	$obj->nome_posicao_plugin = "novo_gmapas2";
   	$base::front_end($obj);






?>