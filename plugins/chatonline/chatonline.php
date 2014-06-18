<?php
	
	class Chatonline extends Principal
	{

			function Chatonline($id_pagina)
			{	
				$this->id_pagina = $id_pagina;
			}


			public function montar_chatonline()
			{
				$sql_chatonline = "CREATE TABLE IF NOT EXISTS `chatonline` (
		                      `ID` int(11) NOT NULL AUTO_INCREMENT,
		                      `nome` text,
		                      PRIMARY KEY (`ID`)
		                    ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Table with abuse reports' AUTO_INCREMENT=1;";	

				$this->slq_comando($sql_chatonline);
			}


			public function lista_chatonline()
			{
				$this->montar_chatonline();

				$bol = new Textos();

				$sql = mysql_query("SELECT * FROM chatonline");

                while($row = mysql_fetch_array($sql))
                {
					$bol->mod_texto($this->id_pagina,'PLUGIN_CHATONLINE_'.$row["ID"],'1',$row["nome"],'');	

					echo "<div>";
					echo $bol->mod_texto($this->id_pagina,'PLUGIN_CHATONLINE_'.$row["ID"],'0','script','');	
					echo "</div>";
                }
			}

			//O plugin eh adicionado da pelo painel
			public function insere_chatonline($nome_rede_chatonline)
			{
				$this->montar_chatonline();

				 if(!$this->slq_comando_select("SELECT * FROM chatonline WHERE nome='$nome_rede_chatonline'", 1 ) )
				 {
				 	$string ="INSERT INTO `chatonline` (`ID`, `nome`) VALUES (NULL, '$nome_rede_chatonline' )";

				 	$this->slq_comando($string);

				 	return true;	
				 }
				 else
				 {
				 	return false;
				 }		
			}

			//define O plugin que so pode ser editada
			public function define_insere_chatonline($nome_rede_chatonline)
			{
				$bol = new Textos();

				$this->montar_chatonline();

				 if(!$this->slq_comando_select("SELECT * FROM chatonline WHERE nome='$nome_rede_chatonline'", 1 ) )
				 {
				 	$string ="INSERT INTO `chatonline` (`ID`, `nome`) VALUES (NULL, '$nome_rede_chatonline' )";

				 	$ultimo_id = $this->slq_comando_insert($string);

				 	$bol->mod_texto($this->id_pagina,'PLUGIN_CHATONLINE_'.$ultimo_id,'1',$nome_rede_chatonline,'');

				 	echo $bol->mod_texto($this->id_pagina,'PLUGIN_CHATONLINE_'.$ultimo_id,'0','script','');	

				 }
				 else
				 {
				 	$rede = $this->slq_comando_select("SELECT * FROM chatonline WHERE nome='$nome_rede_chatonline'");

				 	$bol->mod_texto($this->id_pagina,'PLUGIN_CHATONLINE_'.$rede['ID'],'1',$nome_rede_chatonline,'');

				 	echo $bol->mod_texto($this->id_pagina,'PLUGIN_CHATONLINE_'.$rede['ID'],'0','script','');	

				 }	
	

			}




			public function chatonline_backend()
			{
				$bol = new Textos();

				$bol->montar();

				$this->montar_chatonline();

				$bol->mod_texto_backend($this->id_pagina,'PLUGIN_CHATONLINE');
			}

			

	}





	//$chatonline = new Chatonline('15');

	//$chatonline->lista_chatonline();

	//$chatonline->insere_chatonline('facebook');

	//$chatonline->chatonline_backend();
?>