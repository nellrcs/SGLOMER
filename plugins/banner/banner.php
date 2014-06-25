<?php
	class Banner_tipos
	{
		public $nome_posicao_plugin;
		public $imgs;
	}


	class Banner extends Principal
	{

			function Banner($id_pagina)
			{	
				$this->id_pagina = $id_pagina;
			}


			public function montar_banner()
			{
				$sql_social = "CREATE TABLE IF NOT EXISTS `banner` (
		                      `ID` int(11) NOT NULL AUTO_INCREMENT,
		                      `id_pagina` int(11) NOT NULL,
		                      `nome` text,
		                      PRIMARY KEY (`ID`)
		                    ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Table with abuse reports' AUTO_INCREMENT=1;";	

				$this->slq_comando($sql_social);
			}


			public function define_insere_banner($obj)
			{
				
				$nome_do_banner = $obj->nome_posicao_plugin;

				$imgs = $obj->imgs;

				$bol = new Imagem();

				$bol->montar_imagem();

				$this->montar_banner();

				$nome_do_banner = "PLUGIN_BANNER_".$nome_do_banner;

				if($imgs > 0)
				{
					$imgs = $imgs - 1; 
				}

				$string = array('ID','nome','id_pagina');

				$where = array('nome'=>$nome_do_banner,'id_pagina'=>$this->id_pagina);	

				$banners = $this->sql_select_otimizado('banner',$string,$where);
			
				if( !$banners )
				{

					$insere_banner = array('nome'=>$nome_do_banner,'id_pagina'=>$this->id_pagina);	

					$this->sql_insert_otimizado('banner',$insere_banner);


					$string = array('ID','nome','arquivo');

					$where = array('grupo'=>$nome_do_banner);	

					$banners_imamgens = $this->sql_select_otimizado('imagem',$string,$where);


					 if(count($banners_imamgens ) <= $imgs )
					 {
					 	
					 	
					 	$nome_da_imagem = 'banner';

					 	$arquivo_imagem = 'http://placehold.it/640x250';

					 	$bol->upload_imagem($arquivo_imagem,$arquivo_imagem,$nome_do_banner);

					 	$imagens = $this->sql_select_otimizado('imagem',$string,$where);

					 	foreach ($imagens as $imagem) 
					 	{
					 		echo "<img src='".$imagem['arquivo']."' alt='". $imagem['nome']."'>";
					 	}

					 }
					 else
					 {
						$imagens = $this->sql_select_otimizado('imagem',$string,$where);

						foreach ($imagens as $imagem) 
					 	{
					 		echo "<img src='".$imagem['arquivo']."' alt='". $imagem['nome']."'>";
					 	}

					 }	

				}	
				else
				{
					 
					$string = array('ID','nome','arquivo');

					$where = array('grupo'=>$nome_do_banner);	

					$banners_imamgens = $this->sql_select_otimizado('imagem',$string,$where);

					if(count($banners_imamgens ) <= $imgs )
					{

					 	$nome_da_imagem = 'banner';

					 	$arquivo_imagem = 'http://placehold.it/640x250';

					 	$bol->upload_imagem($arquivo_imagem,$arquivo_imagem,$nome_do_banner);

					 	$imagens = $this->sql_select_otimizado('imagem',$string,$where);

					 	foreach ($imagens as $imagem) 
					 	{
					 		echo "<img src='".$imagem['arquivo']."' alt='". $imagem['nome']."'>";
					 	}

					 }
					 else
					 {
						$imagens = $this->sql_select_otimizado('imagem',$string,$where);

						foreach ($imagens as $imagem) 
					 	{
					 		echo "<img src='".$imagem['arquivo']."' alt='". $imagem['nome']."'>";
					 	}

					 }	


				}	

			}



			public function front($obj)
			{			
				
				$this->define_insere_banner($obj);
			}
		

	}




?>