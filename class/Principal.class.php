<?php
	include 'Conexao.class.php';

	class Principal extends Conexao
	{
	
        function __construct() {
    		include_once 'configura.php';
    		$this->conecta();
        }


        public static function caminho_diretorio(){
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

        public static function lista_modulos()
        {
        	$mt = new Principal();
            $lista = $mt->extencoes('modulos');
            return $lista;
            
        }

        public static function onde_estou()
        {
        	
            echo 'ESTOU NA CLASSE PRINCIPAL';
            
        }


        public static function cria_diretorios_upload($new_folder='')
        {
            if(!is_dir("uploads")){
                mkdir("uploads", 0777) or die("erro ao criar diretório com permissão.");
            }

            if($new_folder){
                if(!is_dir("uploads/".$new_folder)){
                    mkdir("uploads/".$new_folder, 0777) or die("erro ao criar sub-diretório com permissão.");
                }
            }
        }


	}
?>