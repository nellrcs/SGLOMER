<h1>EM DESENVOLVIMENTO TRABALHE C. - GEROU TABELA E PSATA "trabalhe_conosco" </h1>
<?php
	class trabalhe_conosco extends Principal
	{

	}
	$ll = new trabalhe_conosco();
	
	//Monstr aonde esta a class
	$ll::onde_estou();

	//cria tabela
	$sql = "CREATE TABLE IF NOT EXISTS `trabalhe_conosco` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `nome` varchar(200) NOT NULL DEFAULT '',
		  `data_nascimento` varchar(200) NOT NULL DEFAULT '',
		  `cpf` varchar(20) NOT NULL DEFAULT '',
		  `rg` varchar(20) NOT NULL DEFAULT '',
		  `estado_civil` varchar(200) NOT NULL DEFAULT '',
		  `formacao` varchar(4) NOT NULL DEFAULT '',
		  `email` varchar(200) NOT NULL DEFAULT '',
		  `telefone` varchar(20) NOT NULL DEFAULT '',
		  `celular` varchar(20) NOT NULL DEFAULT '',
		  `endereco` varchar(255) NOT NULL DEFAULT '',
		  `cep` varchar(15) NOT NULL DEFAULT '',
		  `cidade` varchar(100) NOT NULL DEFAULT '',
		  `estado` varchar(50) NOT NULL DEFAULT '',
		  `area_atuacao` varchar(200) NOT NULL DEFAULT '', -- Administração, Web desing, Programação
		  `pretencao` varchar(50) NOT NULL DEFAULT '',
		  `curriculo` varchar(255) NOT NULL DEFAULT '',
		  `facebook` text NOT NULL,
		  `sobre` text NOT NULL,
		  `data_cat` varchar(11) NOT NULL DEFAULT '',
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Table with abuse reports' AUTO_INCREMENT=1;
	";

	$ll->criar_table($sql);


	//AGORA CRIA PASTA DE UPLOAD
	Principal::cria_diretorios_upload('trabalhe_conosco');
?>