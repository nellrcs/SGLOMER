<h1>EM DESENVOLVIMENTO REPRESENTANTES - GEROU TABELA "representantes" </h1>
<?php
	class representantes extends Principal
	{

	}
	$ll = new representantes();
	
	//Monstr aonde esta a class
	$ll::onde_estou();

	//cria tabela
	$sql = "CREATE TABLE IF NOT EXISTS `representantes` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `nome` varchar(200) NOT NULL DEFAULT '',
		  `email` varchar(200) NOT NULL DEFAULT '',
		  `telefone1` varchar(20) NOT NULL DEFAULT '',
		  `telefone2` varchar(20) NOT NULL DEFAULT '',
		  `telefone3` varchar(20) NOT NULL DEFAULT '',
		  `telefone4` varchar(20) NOT NULL DEFAULT '',
		  `telefone5` varchar(20) NOT NULL DEFAULT '',
		  `telefone6` varchar(20) NOT NULL DEFAULT '',
		  `telefone7` varchar(20) NOT NULL DEFAULT '',
		  `telefone8` varchar(20) NOT NULL DEFAULT '',
		  `cpf` varchar(20) NOT NULL DEFAULT '',
		  `rg` varchar(20) NOT NULL DEFAULT '',
		  `cidade` varchar(100) NOT NULL DEFAULT '',
		  `estado` varchar(50) NOT NULL DEFAULT '',
		  `regiao` varchar(200) NOT NULL DEFAULT '', -- Exp: Região de Londrina e Maringá
		  `data_cat` varchar(11) NOT NULL DEFAULT '',
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Table with abuse reports' AUTO_INCREMENT=1;
	";

	$ll->criar_table($sql);

?>