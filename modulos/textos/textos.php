<h1>EM DESENVOLVIMENTO TEXTOS - GEROU TABELA "textos"</h1>
<?php
	class textos extends Principal
	{

	}
	$ll = new textos();
	
	//Monstr aonde esta a class
	$ll::onde_estou();

	//cria tabela
	$sql = "CREATE TABLE IF NOT EXISTS `textos` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `tipo` varchar(200) NOT NULL DEFAULT '0',
		  `texto` text NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Table with abuse reports' AUTO_INCREMENT=1;
	";

	$ll->criar_table($sql);	
	//
?>