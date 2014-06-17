<?php
	
	class Googlemaps extends Principal
	{

			function Googlemaps($id_pagina)
			{	
				$this->id_pagina = $id_pagina;
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


			public function lista_googlemaps()
			{
				$this->montar_googlemaps();

				$bol = new Textos();

				$sql = mysql_query("SELECT * FROM googlemaps");

                while($row = mysql_fetch_array($sql))
                {

					$bol->mod_texto($this->id_pagina,'PLUGIN_GOOGLEMAPS_'.$row["ID"],'1',$row["nome"],'');	

					echo "<div>";
					echo $bol->mod_texto($this->id_pagina,'PLUGIN_GOOGLEMAPS_'.$row["ID"],'0','script','');	
					echo "</div>";


                }

			}

			//O plugin eh adicionado da pelo painel
			public function insere_googlemaps($nome_rede_googlemaps)
			{
				$this->montar_googlemaps();

				 if(!$this->slq_comando_select("SELECT * FROM googlemaps WHERE nome='$nome_rede_googlemaps'", 1 ) )
				 {
				 	$string ="INSERT INTO `googlemaps` (`ID`, `nome`) VALUES (NULL, '$nome_rede_googlemaps' )";

				 	$this->slq_comando($string);

				 	return true;	
				 }
				 else
				 {
				 	return false;
				 }		
			}

			//define O plugin que so pode ser editada
			public function define_insere_googlemaps($nome_rede_googlemaps)
			{
				$bol = new Textos();

				$this->montar_googlemaps();

				 if(!$this->slq_comando_select("SELECT * FROM googlemaps WHERE nome='$nome_rede_googlemaps'", 1 ) )
				 {
				 	$string ="INSERT INTO `googlemaps` (`ID`, `nome`) VALUES (NULL, '$nome_rede_googlemaps' )";

				 	$ultimo_id = $this->slq_comando_insert($string);

				 	$bol->mod_texto($this->id_pagina,'PLUGIN_GOOGLEMAPS_'.$ultimo_id,'1',$nome_rede_googlemaps,'');

				 	echo $bol->mod_texto($this->id_pagina,'PLUGIN_GOOGLEMAPS_'.$ultimo_id,'0','script','');	

				 }
				 else
				 {
				 	$rede = $this->slq_comando_select("SELECT * FROM googlemaps WHERE nome='$nome_rede_googlemaps'");

				 	$bol->mod_texto($this->id_pagina,'PLUGIN_GOOGLEMAPS_'.$rede['ID'],'1',$nome_rede_googlemaps,'');

				 	echo $bol->mod_texto($this->id_pagina,'PLUGIN_GOOGLEMAPS_'.$rede['ID'],'0','script','');	

				 }	
	

			}




			public function googlemaps_backend()
			{
				$bol = new Textos();

				$bol->montar();

				$this->montar_googlemaps();

				$bol->mod_texto_backend($this->id_pagina,'PLUGIN_GOOGLEMAPS');
			}

			

	}





	//$googlemaps = new Googlemaps('23');

	//$googlemaps->lista_googlemaps();

	//$googlemaps->insere_googlemaps('facebook');

	//$googlemaps->googlemaps_backend();


?>