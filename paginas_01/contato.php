<h1>CONTATO</h1>
<?php

//PLUGIN GOOGLE MAPAS
/* DECLARA */
$base::$nome_plugin = 'googlemaps';  
$obj = $base::obj_plugin();
//--------------------------------


$obj->nome_posicao_plugin = "novo_gmapas3";
echo $base::front_end($obj);


$textos = new Textos();


echo $textos->preciso_texto_aqui('tex1', 0);
echo $textos->preciso_texto_aqui('a', 0);
echo $textos->preciso_texto_aqui('b', 0);
echo $textos->preciso_texto_aqui('c', 0);
echo $textos->preciso_texto_aqui('d', 0);
echo $textos->preciso_texto_aqui('e', 0);


?>