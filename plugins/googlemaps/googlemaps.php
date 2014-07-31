
<?php
	class Googlemaps_obj
	{
		public $nome_posicao_plugin;
	}


	class Googlemaps extends Principal
	{
			public $id_pagina;

			public $icone = "https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcRTXSfqHH4K7eboQO6xQnW-bulqdXQbZyRyPIDnpSlG8DuQ5ZHsPrmv1ue7";

			function Googlemaps($id_pagina)
			{	
				$this->id_pagina = $id_pagina;
				
				$this->montar_googlemaps();
			}

			public function montar_googlemaps()
			{
				$sql_googlemaps = "CREATE TABLE IF NOT EXISTS `googlemaps` (
		                      `ID` int(11) NOT NULL AUTO_INCREMENT,
		                      `nome` text,
		                      PRIMARY KEY (`ID`)
		                    ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Table with abuse reports' AUTO_INCREMENT=1;";	

				$this->sql_comando($sql_googlemaps);
			}


			private  function define_insere_googlemaps($nome_posicao_plugin)
			{
				$bol = new Textos($this->id_pagina);

				$campos = array('ID','nome');

				$where = array('nome' => $nome_posicao_plugin);

				$plugin_googlemaps = $this->sql_select_otimizado('googlemaps',$campos,$where);


				 if( count($plugin_googlemaps) <= 0  )
				 {

				 	$campos_googlemaps =  array('nome' => $nome_posicao_plugin);
				
					$retorno_id_plugin = $this->sql_insert_otimizado('googlemaps',$campos_googlemaps);

				 	$ultimo_id = $retorno_id_plugin;

				 	$bol->preciso_texto_aqui('PLUGIN_GOOGLEMAPS_'.$ultimo_id,'3',$nome_posicao_plugin,'');

				 	echo $bol->preciso_texto_aqui('PLUGIN_GOOGLEMAPS_'.$ultimo_id,'0','# GOOGLEMAPS #','');	

				 }
				 else
				 {

				 	$gmaps = $plugin_googlemaps[0];

				 	$bol->preciso_texto_aqui('PLUGIN_GOOGLEMAPS_'.$gmaps['ID'],'3',$nome_posicao_plugin,'');

				 	echo $bol->preciso_texto_aqui('PLUGIN_GOOGLEMAPS_'.$gmaps['ID'],'0','# GOOGLEMAPS #','');	

				 }	
	
			}
			
			/* TODOS */
			public function plugin_menu()
			{
				return false;
			}
			/* TODOS */
			public function plugin_lista()
			{


				$bol = new Textos($this->id_pagina);

				$lista = $bol->mod_text_lista_plugin('PLUGIN_GOOGLEMAPS');
				
				$nova_lista = array();

				foreach ($lista as $key => $value) 
				{
					$nova_lista[$key]['ID'] 		= $value['ID'];
					$nova_lista[$key]['posicao'] 	= $value['posicao'];
					$nova_lista[$key]['editar'] 	= $value['editar'];
					$nova_lista[$key]['icone'] 		= $this->icone;
					$nova_lista[$key]['prev'] 		= $value['prev'];
				}

				return $nova_lista;
			}

			/* TODOS */
			public function front($obj)
			{			
				

				$nome = $obj->nome_posicao_plugin;

				$this->define_insere_googlemaps($nome);
			}
			/* TODOS */
			public function back()
			{			
				$this->googlemaps_backend();

			}


	}


?>
