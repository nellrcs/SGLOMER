<?php

	class Imagem extends Principal
	{		

		public $icone = "http://www.iconesbr.net/iconesbr/2008/07/263/263_256x256.png";

        public $sql_imagem = "CREATE TABLE IF NOT EXISTS `imagem` (
          `ID` int(11) NOT NULL AUTO_INCREMENT,
          `nome` varchar(200) NOT NULL,
          `grupo` varchar(200) NOT NULL,
          `arquivo` longblob NOT NULL,
          PRIMARY KEY (`ID`)
        ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Table with abuse reports' AUTO_INCREMENT=1;";	

		public $imagen_relacionada = "CREATE TABLE IF NOT EXISTS `imagem_rl` (
          `ID` int(11) NOT NULL AUTO_INCREMENT,
          `id_pagina` int(11) NOT NULL,
          `id_imagem` int(11) NOT NULL,
          `posicao` varchar(200) NOT NULL,
          PRIMARY KEY (`ID`)
        ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Table with abuse reports' AUTO_INCREMENT=1;";	

		function Imagem()
		{

		}

		function montar_imagem()
		{
			$this->sql_comando($this->sql_imagem);

			$this->sql_comando($this->imagen_relacionada);	
		}

		function upload_imagem($arquivo_imagem,$nome_imagem,$grupo)
		{
			$this->montar_imagem();

			$string = array(

				'nome'=>$nome_imagem,

				'arquivo'=>$arquivo_imagem,

				'grupo'=>$grupo
				);		

			$this->sql_insert_otimizado('imagem',$string);
		}


		function mod_imagem($id_pagina,$posicao,$imagem = null)
		{
			//TIPO = unico/multiplo

			//GRUPO = grupo a qual esta imagem pertence

			$this->montar_imagem();

			$campos = array('ID','id_imagem');

			$where = array(

				'id_pagina' => $id_pagina, 
				
				'posicao' => $posicao
				);

			$imagen_relacionada = $this->sql_select_otimizado('imagem_rl',$campos,$where);

			if( count($imagen_relacionada) <= 0 )
			{

				//INSERE UMA NOVA IMAGEM
				$campos_imagem =  array('arquivo' => $imagem,'grupo'=>'grupo_pagina_'.$id_pagina);
				
				$retorno_id_imagem = $this->sql_insert_otimizado('imagem',$campos_imagem);

				
				$campos_imgem_relacionada = array(
					'id_pagina' => $id_pagina, 
					'id_imagem' => $retorno_id_imagem,
					'posicao' => $posicao
				);

				$this->sql_insert_otimizado('imagem_rl',$campos_imgem_relacionada);
				
				//MOSTRA A NOVA IMAGEM
				$imagen_relacionada = $this->sql_select_otimizado('imagem_rl',$campos,$where);

				$campos = array('ID','arquivo','nome');

				$where = array('ID'=>$imagen_relacionada[0]['id_imagem']);

				$imagen = $this->sql_select_otimizado('imagem',$campos,$where);

				return $imagen;
		
			}
			else
			{	

				$imagens = array();

				$imagens_limpa = array();

				foreach ($imagen_relacionada as $n =>$valor) 
				{	
					$campos = array('ID','arquivo','nome');

					$where = array('ID'=>$valor['id_imagem']);
					
					$imagens[$n] = $this->sql_select_otimizado('imagem',$campos,$where);

					if(count($imagens[$n]) > 0)
					{
						$imagens_limpa[] = array('ID'=>$imagens[$n][0]['ID'],'nome'=>$imagens[$n][0]['nome'],'arquivo'=>$imagens[$n][0]['arquivo']);						
					}	

				}
				
				return $imagens_limpa;
			}	

		}


		function define_insere_imagem($id_pagina,$posicao,$imagem = null,$tag = false)
		{
			
			$img = $this->mod_imagem($id_pagina,$posicao,$imagem);

			if($tag == true)
			{	
				$tag_img =  "<img src='".$img[0]['arquivo']."' alt='".$img[0]['nome']."'>";
			}
			else
			{
				$tag_img = $img[0]['arquivo'];
			}
			return $tag_img;
		}



		function lista_imagens($grupo=null)
		{

			$this->montar_imagem();

			$campos = array(

				'ID',
				
				'nome',
				
				'arquivo'
				
				);

			if($grupo != null)
			{
				$where = array('grupo' => $grupo);

				$dados = $this->sql_select_otimizado('imagem',$campos,$where);

				$array = array();

				foreach ($dados as $dado) 
				{

					$array[] = array('ID'=>$dado['ID'],'posicao'=>$grupo,'editar'=>'imagem','icone'=>$this->icone);
				}

				return $array;

			}
			else
			{
				$dados = $this->sql_select_otimizado('imagem',$campos);

				return $dados;
			}

			

		}


		function backend()
		{

			if(!empty($_FILES['file']))
			{

				$data = file_get_contents($_FILES['file']['tmp_name']);

				$tipo = $_FILES['file']['type'];

				$nome = $_FILES['file']['name'];
		
				$base64 = 'data:image/' . $tipo . ';base64,' . base64_encode($data);

				$this->upload_imagem($base64,$nome);

				echo "<img src='".$base64."'>";
			}


			$inpu_imgem = "<form enctype='multipart/form-data' method='post'><input type='file' name='file'><button type='submit'>ENVIAR</button></form>";

			echo $inpu_imgem;
		}

	}


?>



