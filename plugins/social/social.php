<?php
	
	class Social extends Principal
	{



			function Social($id_pagina)
			{	
				$this->id_pagina = $id_pagina;
			}


			public function montar_social()
			{
				$sql_social = "CREATE TABLE IF NOT EXISTS `social` (
		                      `ID` int(11) NOT NULL AUTO_INCREMENT,
		                      `nome` text,
		                      PRIMARY KEY (`ID`)
		                    ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Table with abuse reports' AUTO_INCREMENT=1;";	

				$this->slq_comando($sql_social);
			}


			public function lista_social()
			{
				$this->montar_social();

				$bol = new Textos();

				$sql = mysql_query("SELECT * FROM social");

                while($row = mysql_fetch_array($sql))
                {

					$bol->mod_texto($this->id_pagina,'PLUGIN_SOCIAL_'.$row["ID"],'1',$row["nome"],'');	

					echo "<div>";
					echo $bol->mod_texto($this->id_pagina,'PLUGIN_SOCIAL_'.$row["ID"],'0','script','');	
					echo "<div>";


                }

			}
			//a rede social eh adiciona da pelo painel
			public function insere_social($nome_rede_social)
			{
				$this->montar_social();

				 if(!$this->slq_comando_select("SELECT * FROM social WHERE nome='$nome_rede_social'", 1 ) )
				 {
				 	$string ="INSERT INTO `social` (`ID`, `nome`) VALUES (NULL, '$nome_rede_social' )";

				 	$this->slq_comando($string);

				 	return true;	
				 }
				 else
				 {
				 	return false;
				 }		

			}

			//define a rede social que so pode ser editada
			public function define_insere_social($nome_rede_social)
			{
				$bol = new Textos();

				$this->montar_social();

				 if(!$this->slq_comando_select("SELECT * FROM social WHERE nome='$nome_rede_social'", 1 ) )
				 {
				 	$string ="INSERT INTO `social` (`ID`, `nome`) VALUES (NULL, '$nome_rede_social' )";

				 	$ultimo_id = $this->slq_comando_insert($string);

				 	$bol->mod_texto($this->id_pagina,'PLUGIN_SOCIAL_'.$ultimo_id,'1',$nome_rede_social,'');

				 	echo $bol->mod_texto($this->id_pagina,'PLUGIN_SOCIAL_'.$ultimo_id,'0','script','');	

				 }
				 else
				 {
				 	$rede = $this->slq_comando_select("SELECT * FROM social WHERE nome='$nome_rede_social'");

				 	$bol->mod_texto($this->id_pagina,'PLUGIN_SOCIAL_'.$rede['ID'],'1',$nome_rede_social,'');

				 	echo $bol->mod_texto($this->id_pagina,'PLUGIN_SOCIAL_'.$rede['ID'],'0','script','');	

				 }	
	

			}




			public function social_backend()
			{
				$bol = new Textos();

				$bol->montar();

				$bol->mod_texto_backend($this->id_pagina,'PLUGIN_SOCIAL');
			}

			

	}





	//$social = new Social('23');

	//$social->lista_social();

	//$social->insere_social('facebook');

	//$social->social_backend();


?>