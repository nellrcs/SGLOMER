<?php
	
	class Conexao
	{
		public function conecta(){
			
			$conn = mysql_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD) or die (mysql_error());
			$Select = mysql_select_db(DB_DATABASE) or die (mysql_error());
		}
	}

?>