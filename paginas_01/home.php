<h1>home</h1>
<?php 
	//TEXTO
	$textos_pag_home = new Textos($base::$id_pagina);
	$imagem = new Imagem($base::$id_pagina);

	echo $textos_pag_home->preciso_texto_aqui('rafael', 1, 'UUUUUUUUUU', 'nt');
        
        echo $imagem->define_insere_imagem('home_im','http://www.omenorprecodobrasil.com.br/produtos/forno+eletrico+fd+18l+faet+dulka+220.jpg',true);

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