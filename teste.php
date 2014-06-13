<?php
	require_once './class/Principal.class.php';

	$var = new Principal();

	$sql = "CREATE TABLE IF NOT EXISTS `abuses` (
		  `abuse_id` int(11) NOT NULL AUTO_INCREMENT,
		  `user_id` int(11) NOT NULL DEFAULT '0',
		  `abuser_username` varchar(100) NOT NULL DEFAULT '',
		  `comment` text NOT NULL,
		  `reg_date` int(11) NOT NULL DEFAULT '0',
		  `id` int(11) NOT NULL,
		  PRIMARY KEY (`abuse_id`),
		  KEY `reg_date` (`reg_date`)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Table with abuse reports' AUTO_INCREMENT=2;
	";

	$var->criar_table($sql);
?>