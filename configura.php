<?php
	print_r($_SERVER);
	echo '<br>';
	echo '<br>';
	echo '<br>';
	print_r($_SERVER['DOCUMENT_ROOT']);

	define('DIR_SISTEMA',$_SERVER['DOCUMENT_ROOT']);
	define('URL_SISTEMA',$_SERVER['REMOTE_ADDR']);

	define('DB_DATABASE','sglomer');
	
?>