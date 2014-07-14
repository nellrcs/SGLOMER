	<h2>NOME</h2>
	<ol class="breadcrumb">
	  <li class="active">Editar</li>
	   <li><a href="editar/pag1/modelo.html">EDITAR</a></li>
	  <li class="navbar-right"><strong>TESTE</strong></li>
	</ol>


<?php
        //echo $url[1];
        
       //echo $bol->mod_texto($url[1],'CAMPO_MENU_1','1','WAR CAST','{"pt":"texto"}');
       
        $base::$id_pagina = $url[1]; 
        
        $base::$nome_plugin = 'googlemaps'; 
        
        $obj = $base::obj_plugin();
        
        $obj->nome_posicao_plugin = "testanto_aqui2";

       $base::back_end_lista();

       // $base::front_end($obj);
        


?>
