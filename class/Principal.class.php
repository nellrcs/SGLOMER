<?php

	class Principal extends Template
	{
	
        function __construct() {
    
        }

            
		function extencoes($nome_diretorio)
		{
			$adir =  './'.$nome_diretorio;
                        
            $lista_nomes = array();
                        
			if ($local = opendir($adir)) 
			{
			    while (false !== ($pasta = readdir($local))) 
			    {
			        if ($pasta != "." && $pasta != ".." && $pasta != "Thumb.db") 
			        { 

			           if(is_dir($adir."/".$pasta))
			           { 
				            $lista_nomes[] = "$pasta";            
			           } 
			        	
			    	}
			    }

			    closedir($local);
			}

            return $lista_nomes;

		}

        public static function lista_modulos()
        {
        	$mt = new Principal();
            $lista = $mt->extencoes('modulos');
            return $lista;
            
        }
	}
?>