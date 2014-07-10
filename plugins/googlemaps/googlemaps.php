<?php
	class Googlemaps_obj
	{
		public $nome_posicao_plugin;
	}


	class Googlemaps extends Principal
	{

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

				$this->slq_comando($sql_googlemaps);
			}


			private  function define_insere_googlemaps($nome_posicao_plugin)
			{
				$bol = new Textos();

				$campos = array('ID','nome');

				$where = array('nome' => $nome_posicao_plugin);

				$plugin_googlemaps = $this->sql_select_otimizado('googlemaps',$campos,$where);


				 if( count($plugin_googlemaps) <= 0  )
				 {

				 	$campos_googlemaps =  array('nome' => $nome_posicao_plugin);
				
					$retorno_id_plugin = $this->sql_insert_otimizado('googlemaps',$campos_googlemaps);

				 	$ultimo_id = $retorno_id_plugin;

				 	$bol->mod_texto($this->id_pagina,'PLUGIN_GOOGLEMAPS_'.$ultimo_id,'1',$nome_posicao_plugin,'');

				 	echo $bol->mod_texto($this->id_pagina,'PLUGIN_GOOGLEMAPS_'.$ultimo_id,'0','# GOOGLEMAPS #','');	

				 }
				 else
				 {

				 	$gmaps = $plugin_googlemaps[0];

				 	$bol->mod_texto($this->id_pagina,'PLUGIN_GOOGLEMAPS_'.$gmaps['ID'],'1',$nome_posicao_plugin,'');

				 	echo $bol->mod_texto($this->id_pagina,'PLUGIN_GOOGLEMAPS_'.$gmaps['ID'],'0','# GOOGLEMAPS #','');	

				 }	
	

			}
			
			public function googlemaps_backend()
			{
				$bol = new Textos();

				$bol->montar();

				$this->montar_googlemaps();

				$bol->mod_texto_backend($this->id_pagina,'PLUGIN_GOOGLEMAPS');
			}



			public function front($obj)
			{			
				
				$nome = $obj->nome_posicao_plugin;

				$this->define_insere_googlemaps($nome);
			}

			public function back()
			{			
				$this->googlemaps_backend();
			}


			




	}





	//$googlemaps = new Googlemaps('23');

	//$googlemaps->lista_googlemaps();

	//$googlemaps->insere_googlemaps('facebook');

	//$googlemaps->googlemaps_backend();


?>