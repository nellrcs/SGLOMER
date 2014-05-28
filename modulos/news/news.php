<h1>EM DESENVOLVIMENTO NEWSLETTER - GEROU TABELA "newsletter"</h1>
<?php
	class newsletter extends Principal
	{

	}
	$ll = new newsletter();
	
	//Monstr aonde esta a class
	$ll::onde_estou();

	//cria tabela
	$sql = "CREATE TABLE IF NOT EXISTS `newsletter` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `nome` varchar(200) NOT NULL DEFAULT '0',
		  `email` varchar(200) NOT NULL DEFAULT '',
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Table with abuse reports' AUTO_INCREMENT=1;
	";


	$ll->criar_table($sql);	
	//
?>