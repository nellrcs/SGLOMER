<h1>EM DESENVOLVIMENTO ADMIN - GEROU TABELA "admin"</h1>
<?php
	class admin extends Principal
	{

	}
	$ll = new admin();
	
	//Monstr aonde esta a class
	$ll::onde_estou();

	//cria tabela
	$sql = "CREATE TABLE IF NOT EXISTS `admin` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `nome` varchar(200) NOT NULL DEFAULT '',
		  `login` varchar(200) NOT NULL DEFAULT '',
		  `senha` varchar(200) NOT NULL DEFAULT '',
		  `ultimo_login` varchar(200) NOT NULL DEFAULT '', -- Exp: Último login 25/25/2555
		  `logins` varchar(200) NOT NULL DEFAULT '', -- Soma a quantidade de logins
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Table with abuse reports' AUTO_INCREMENT=1;
	";


	$ll->criar_table($sql);	
	//
?>