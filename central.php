<?php
        echo $url[1];
        
       //echo $bol->mod_texto($url[1],'CAMPO_MENU_1','1','WAR CAST','{"pt":"texto"}');
       
        $base::$id_pagina = $url[1]; 
        
        $base::$nome_plugin = 'googlemaps'; 
        
        $obj = $base::obj_plugin();
        
        $obj->nome_posicao_plugin = "testanto_aqui";
        
        echo $base::back_end_lista();
        

?>