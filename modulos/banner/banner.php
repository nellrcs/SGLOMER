<h1>EM DESENVOLVIMENTO MODULO SLIDER - GEROU TABELA E PASTA "banner"</h1>
<?php
	class banner extends Principal
	{

	}
	$ll = new banner();
	
	//Monstr aonde esta a class
	$ll::onde_estou();

	//cria tabela
	$sql = "CREATE TABLE IF NOT EXISTS `banner` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `imagem` varchar(200) NOT NULL DEFAULT '',
		  `titulo` varchar(200) NOT NULL DEFAULT '',
		  `tipo` varchar(15) NOT NULL DEFAULT '', -- FIXO ou ROTATIVO
		  `descricao` text NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Table with abuse reports' AUTO_INCREMENT=1;
	";

	$ll->criar_table($sql);


	//AGORA CRIA PASTA DE UPLOAD
	Principal::cria_diretorios_upload('banner');
?>