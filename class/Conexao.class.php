<?php
	
	class Conexao
	{
		public function conecta(){
			
			$conn = mysql_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
			$Select = mysql_select_db(DB_DATABASE) or die (mysql_error());
		}

		public function criar_table($string){
			$quer = mysql_query($string) or die(mysql_error());
		}

		//a funcao criar_table nao faz sentido por que ela não eh especifica
		public function slq_comando($string){
			$quer = mysql_query($string) or die(mysql_error());
		}	

		public function slq_comando_insert($string)
		{
			$quer =  mysql_query($string) or die(mysql_error());

			$ultimo_id = mysql_insert_id();

			return $ultimo_id;

		}

		public function slq_comando_select($string,$contar_linhas = 0)
		{
			
			$quer =  mysql_query($string) or die(mysql_error());

			if($contar_linhas == 1)
			{
				$retorno = mysql_num_rows($quer);				
			}
			else
			{
				$retorno = mysql_fetch_array($quer);
			}	

			return $retorno;

		}


	}

?>