<?php
	class Base extends Principal 
	{

		private static $plugins;

		private static $caminho_padrao = 'plugins';

		public static $id_pagina;
                
		public static $nome_plugin;

		
		function __construct($id_pagina = null,$nome_plugin = null) 
		{
			self::montat_plugin();

			self::montat_paginas();

			self::definir_plugins();

			self::$id_pagina = $id_pagina;
                        
			self::$nome_plugin = $nome_plugin;

		}

		private static function montat_plugin()
		{

            $sql_plugin = "CREATE TABLE IF NOT EXISTS `plugins` (
              `ID` int(11) NOT NULL AUTO_INCREMENT,
              `nome` text NOT NULL,
              `status` text NOT NULL DEFAULT '',
              PRIMARY KEY (`ID`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Table with abuse reports' AUTO_INCREMENT=1;";  

            self::sql_comando($sql_plugin);  
		}


		private static function montat_paginas()
		{

            $sql_paginas = "CREATE TABLE IF NOT EXISTS `paginas` (
              `ID` int(11) NOT NULL AUTO_INCREMENT,
              `nome` text NOT NULL,
              `status` text NOT NULL DEFAULT '',
              PRIMARY KEY (`ID`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Table with abuse reports' AUTO_INCREMENT=1;";  

            self::sql_comando($sql_paginas);  
		}

		private static function definir_plugins()
		{
			$dados = self::sql_select_otimizado('plugins',$campos = array('nome','status'));

			$lista_plugins = array();

			foreach ($dados as $dado) 
			{

				//define( "_" . strtoupper($dado['nome']) . "_" , $dado['status']);

				$arquivo = self::$caminho_padrao . DIRECTORY_SEPARATOR .$dado['nome'] . DIRECTORY_SEPARATOR .$dado['nome']. '.php';

				if (file_exists($arquivo) && is_file($arquivo)) 
				{
		        	
					if($dado['status'] == 1)
					{
						require_once $arquivo;	

						$lista_plugins[$dado['nome']] = $dado['status'];
					}	

		        }

			}
			
			self::$plugins  = $lista_plugins;
		}


        public static function dados_post()
        {
            $obj = new stdClass();

            if(!empty($_POST))
            {   

                foreach ($_POST as $key => $value)
                {
                    $obj->$key = $value;
                }
                return $obj;  
            }  
            else
            {

               return false; 
            }    

             
        }




		public static function lista_paginas_ativas()
		{
			
			$paginas = array();

			$dados = self::sql_select_otimizado('paginas',$campos = array('nome','ID','status'));

			foreach($dados as $pag) 
			{
				if($pag['status'] == '1')
				{
					$paginas[] = $pag;	
				}	

			}
			return $paginas;
		}


		public static function front_end($obj)
		{       
            $nome_plugin = self::$nome_plugin;

            $nome_pluginX = "";

            if($nome_plugin != false)
             {
                    
                $funcao = false;

                foreach (self::$plugins as $nome => $valor) 
                {

                    if($nome == $nome_plugin)
                    {
                        $nome_pluginX = ucfirst($nome_plugin);

                        $plugin = new $nome_pluginX(self::$id_pagina);

                        $funcao = $plugin->front($obj);
                    }
  	
                }

                return $funcao;
            }
            else 
            {   

               return false; 
            }
                        
		}

        public static function obj_plugin()
        {
               $nome_plugin = self::$nome_plugin;

               $obj_plugin = new stdClass();
               
	            if($nome_plugin != false)
                {
            
                    foreach (self::$plugins  as $nome => $valor) 
                    {

                        if($nome == $nome_plugin)
                        {
                            $nome_plugin = ucfirst($nome_plugin);

                            $nome_plugin = $nome_plugin.'_obj';

                            $obj_plugin = new $nome_plugin();
  
                        }

                    }
     
                }

                return  $obj_plugin;   
        }


        public static function lista_plugin_menu()
        {
            $campos = array('nome','ID');  

            $where = array('status'=>1);   

            $plugins = self::sql_select_otimizado('plugins',$campos,$where);

            $para_a_pagina = array();

            foreach ($plugins as $plugin) 
            {
                $nome_plugin = ucfirst($plugin['nome']);

                $obj_plugin = new $nome_plugin(self::$id_pagina);

                if($obj_plugin->plugin_menu())
                {
                    $para_a_pagina[] =  $obj_plugin->plugin_menu(); 
                }      
            }

            return $para_a_pagina; 
 
        }

        

        public static function back_end_lista()
        {
             
             //LISTA PLUGINS   
             $campos = array('nome','ID');  

             $where = array('status'=>1);   

             $plugins = self::sql_select_otimizado('plugins',$campos,$where);

             $para_a_pagina = array();

             foreach ($plugins as $plugin) 
             {
                $nome_plugin = ucfirst($plugin['nome']);

                $obj_plugin = new $nome_plugin(self::$id_pagina);

                $para_a_pagina[] = array('plugins'=>$obj_plugin->plugin_lista());

             }


            //LISTA TEXTOS 
            $bol = new Textos(self::$id_pagina);

            $lista = $bol->mod_text_lista();

            $para_a_pagina[] = array('textos'=>$lista);

            

            //LISTA IMAGENS
            $imagem = new Imagem();

            $grupo = 'grupo_pagina_'.self::$id_pagina;

            $para_a_pagina[] = array('imagens'=>$imagem->lista_imagens($grupo)); 


           return $para_a_pagina;



        }    


	}


?>