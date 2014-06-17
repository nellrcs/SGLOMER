<h1>CRIAR FORMULARIOS PESONALIZADOS </h1>
<?php
	class Formularios extends Principal
	{
		function montar_formulario(){

			$form = new Principal();

			$sql = "CREATE TABLE IF NOT EXISTS `padrao_formulario` (
				  `ID` int(11) NOT NULL AUTO_INCREMENT,
				  `id_pagina` int(11) NOT NULL,
				  `id_posicao` int(11) NOT NULL,
				  `tipo` ENUM('input', 'select', 'textarea', 'radio', 'checkbox'),
				  `mask` varchar(50) NOT NULL DEFAULT '',
				  `maxlenth` varchar(10) NOT NULL DEFAULT 0,
				  `opcoes_json` varchar(500) NOT NULL DEFAULT '',
				  `options` ENUM('nenhum', 'text', 'file'),
				  PRIMARY KEY (`ID`)
				) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Padrao de formularios' AUTO_INCREMENT=1;		
			";

			$form->slq_comando_insert($sql);

			$sql = "CREATE TABLE IF NOT EXISTS `formulario` (
				  `ID` int(11) NOT NULL AUTO_INCREMENT,
				  `nome` varchar(255) NOT NULL,
				  PRIMARY KEY (`ID`)
				) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Padrao de formularios' AUTO_INCREMENT=1;		
			";

			$form->slq_comando_insert($sql);

			$form->cria_diretorios_upload('formularios');
			
		}

		function __construct()
       	{

       	}

       	function define_insere_formulario($id_pagina,$nome_posicao)
       	{
       		
       	}
	}


	$for = new Formularios();
	
	$for->montar_formulario();



?>