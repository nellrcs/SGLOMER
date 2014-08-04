<?php
	

	class Principal extends Conexao
	{
	
        function __construct() 
        {
            $this->conecta();
        }

        public static function caminho_diretorio()
        {
        	$caminho_diretorio = new Principal();
        	return DIR_SISTEMA;
        }

        public static function caminho_url(){
            $caminho_url = new Principal();
            return URL_SISTEMA;
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


        function arquivos($nome_diretorio)
        {

            $adir =  './'.$nome_diretorio;

            $lista_arquivos = array();

            if ($handle = opendir($adir))
            {

                while (false !== ($entry = readdir($handle))) {

                    if ($entry != "." && $entry != "..") 
                    {

                        if(pathinfo($entry, PATHINFO_EXTENSION) == 'php' && $entry != 'index.php')
                         {
                            $lista_arquivos[] = preg_replace('/\\.[^.\\s]{3,4}$/', '', $entry);
                         }   

                    }
                }

                closedir($handle);
            }

            return $lista_arquivos;
        }


        public static function lista_modulos()
        {
        	$mt = new Principal();
            $lista = $mt->extencoes('modulos');
            return $lista;
            
        }

        public static function lista_plugins()
        {
            $mt = new Principal();
            $lista = $mt->extencoes('plugins');
            return $lista;     
        }

        public static function pagina_erro()
        {
            echo '<script type="text/javascript">location.href="404.php";</script>';
        }
        
        public static function menssagem($msg,$tipo)
        {
            switch ($tipo)
            {
                case 'sucesso':
                    return "<div class='alert alert-success alert-dismissible' role='alert'>".$msg."<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Fechar</span></button></div>";
                    break;  
                case 'informacao':
                    return "<div class='alert alert-info alert-dismissible' role='alert'>".$msg."<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Fechar</span></button></div>";
                    break; 
                case 'cuidado':
                    return "<div class='alert alert-warning alert-dismissible' role='alert'>".$msg."<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Fechar</span></button></div>";
                    break; 
                case 'erro':
                    return "<div class='alert alert-danger alert-dismissible' role='alert'>".$msg."<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Fechar</span></button></div>";
                    break; 
                default : return false;
            }

        }        

        public static function array_sort($array, $on, $order=SORT_ASC)
        {
            $new_array = array();
            $sortable_array = array();

            if (count($array) > 0) {
                foreach ($array as $k => $v) {
                    if (is_array($v)) {
                        foreach ($v as $k2 => $v2) {
                            if ($k2 == $on) {
                                $sortable_array[$k] = $v2;
                            }
                        }
                    } else {
                        $sortable_array[$k] = $v;
                    }
                }

                switch ($order) {
                    case SORT_ASC:
                        asort($sortable_array);
                    break;
                    case SORT_DESC:
                        arsort($sortable_array);
                    break;
                }

                foreach ($sortable_array as $k => $v) {
                    $new_array[$k] = $array[$k];
                }
            }

            return $new_array;
        }


            public static function tem_imgem($file,$w,$h)
            {
                if($file == "")
                {
                    return "http://placehold.it/{$w}x{$h}";
                }   
                else
                {
                  return $file;
                }    
                
            }        
	}
?>