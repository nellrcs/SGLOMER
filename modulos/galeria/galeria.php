<h1>EM DESENVOLVIMENTO MODULO SLIDER - GEROU TABELA E PASTA "galeria"</h1>
<?php
	class galeria extends Principal
	{

	}
	$ll = new galeria();
	
	//Monstr aonde esta a class
	$ll::onde_estou();

	//cria tabela
	$sql = "CREATE TABLE IF NOT EXISTS `galeria` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `imagem` varchar(200) NOT NULL DEFAULT '',
		  `titulo` varchar(200) NOT NULL DEFAULT '',
		  `tipo` varchar(15) NOT NULL DEFAULT '', -- CARROCEL ou FIXA
		  `descricao` text NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Table with abuse reports' AUTO_INCREMENT=1;
	";

	$ll->criar_table($sql);


	//AGORA CRIA PASTA DE UPLOAD
	Principal::cria_diretorios_upload('galeria');
?>