<?php
	class Base extends Principal 
	{

		private static $plugins;

		private static $caminho_padrao = 'plugins';

		private static $id_pagina;

		
		function __construct($id_pagina) 
		{
			self::montat_plugin();

			self::definir_plugins();

			self::$id_pagina = $id_pagina;

		}

		private static function montat_plugin()
		{

            $sql_plugin = "CREATE TABLE IF NOT EXISTS `plugins` (
              `ID` int(11) NOT NULL AUTO_INCREMENT,
              `nome` text NOT NULL,
              `status` text NOT NULL DEFAULT '',
              PRIMARY KEY (`ID`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Table with abuse reports' AUTO_INCREMENT=1;";  

            self::slq_comando($sql_plugin);  
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


		public static function front_end($nome_plugin,$obj)
		{
			$funcao = false;

			foreach (self::$plugins  as $nome => $valor) 
			{
				
				if($nome == $nome_plugin)
				{
					$nome_plugin = ucfirst($nome_plugin);

					$plugin = new $nome_plugin(self::$id_pagina);

					$funcao = $plugin->front($obj);
				}
				else
				{
					$funcao = false;
				}	
			}
			return $funcao;
		}


		public static function back_end()
		{


		}


	}


	/**
	* 
	*/
/*	class ex_obj 
	{
		public $nome_posicao_plugin;
	}


	$nn = new Base(23);

	$obj = new ex_obj();

	$obj->nome_posicao_plugin = 'flores';

	$nn::front_end('googlemaps',$obj);
*/


?>