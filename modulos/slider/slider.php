<h1>EM DESENVOLVIMENTO MODULO SLIDER</h1>
<?php
	class slider extends Principal
	{

	}
	$ll = new slider();
	
	//Monstr aonde esta a class
	$ll::onde_estou();

	//cria tabela
	$sql = "CREATE TABLE IF NOT EXISTS `slider` (
		  `slider_id` int(11) NOT NULL AUTO_INCREMENT,
		  `imagem` varchar(200) NOT NULL DEFAULT '0',
		  `titulo` varchar(200) NOT NULL DEFAULT '',
		  `descricao` text NOT NULL,
		  PRIMARY KEY (`slider_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Table with abuse reports' AUTO_INCREMENT=1;
	";


	$ll->criar_table($sql);	
	//
?>