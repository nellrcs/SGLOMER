<?php
	
    $temas = Principal::lista_temas();
    echo "<ul>";
    foreach ($temas as $ver)
    {
        echo "<li>".$ver."</li>";     
    }    
    echo "</ul>";
   

    //$tema = 'laranja_sorte';
    $tema = 'goiaba_sites';
    //$tema = 'rodrigo';
    
    //ADICIONA TEMA
    $tpl = new \raelgc\view\Template('./temas/'.$tema.'/index.html');
    $tpl->CAMINHO = $_SERVER['REQUEST_URI'].'temas/'.$tema.'/';
       
       
    //ADICIONAR MODULOS  
    $tpl->addFile("MODULO1", "./modulos/ratos/estrutura.html");     
    $tpl->addFile("MODULO3", "./modulos/lorem/estrutura.html");     
    include 'modulos/lorem/lorem.php';
       
    if($tpl->exists("MODULO2"))
    {    
        $tpl->addFile("MODULO2", "./modulos/ratos/estrutura.html");
        //include 'modulos/pudin/pudin.php';  
    }    
    
       

    //DADOS DO SITE 
    if($tpl->exists("TITULO")) 
    {    
        $tpl->TITULO = 'POWwwww!';
    }
    
    
    $tpl->show();
       
?>