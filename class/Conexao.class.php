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
		public static function slq_comando($string){
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


		public static function sql_select_otimizado($tabela,$campos = array(),$where = array())
		{

			//$tabela = 'tabela';

			//$campos = array('ID','nome');

			//$where =  array('ID' =>'33','nome'=>'maria');


			$string = "SELECT ";
			
			$i = 1;

			foreach ($campos as $campo) 
			{
				
				$string .= $campo;

				if ($i < count($campos))
				{	
	            	$string .= ', ';
	        	}

	            $i++;
			}

			$string .= " FROM ".$tabela;


			  if(count($where) > 0)
			  {
	                
	            $string .= " WHERE ";

	            $i = 1;

	            foreach($where as $nome => $valor)
	            {
	   
	                $string .= $nome."='".$valor."'";

	                if ($i != count($where))
	                {	
	                        $string .= ' AND ';
	                }
	                $i++;
	             }
	                
	         }
			try
	        {
	        	$quer =  mysql_query($string) or die(mysql_error());

				$arrayS = array();

				while($ln = mysql_fetch_array($quer)) 
				{
					$n_array = array();

					foreach ($campos as $campo) 
					{
					 	$n_array[$campo] = $ln[$campo];
					} 

					$arrayS[] = $n_array;
				}
	     		return $arrayS;
	        }
	        catch(Exception $e)
	        {
	            throw new Exception("Erro ao listar a tabela".$tabela.". \n\r".$e->getMessage());
	        }

		}


		public function sql_insert_otimizado($tabela,$campos_valores= array())
		{
				
			//$tabela = 'tabela';

			//$campo_valor = array('nome'=>'valor') 


			$string = "INSERT INTO ". $tabela;

			$string .= " (";

			$i = 1;

			foreach($campos_valores as $nome => $valor)
			{
				$string .= $nome;
				
				if ($i != count($campos_valores))
				{	
					$string .= ', ';
				}	
				$i++;
			}
			$string .= ") ";

			$string .= " VALUES (";

			$i = 1;

			foreach($campos_valores as $nome => $valor)
			{
				$string .= '\''.addslashes($valor) . '\' ';
				
				if ($i != count($campos_valores))
				{	
					$string .= ', ';
				}

				$i++;
			}
			
			$string .= ") ";

			$quer =  mysql_query($string) or die(mysql_error());

			$ultimo_id = mysql_insert_id();

			return $ultimo_id;
		
		}


		public function sql_updadate_otimizado($tabela,$campos_valores = array(),$where = array())
		{

			//$tabela = 'tabela';

			//$campo_valor = array('nome'=>'valor')

			//$where = array('ID'=>'valor') 


			$string = "UPDATE ". $tabela . " SET ";
			
			$i = 1;

			foreach($campos_valores as $campo => $valor)
			{

				$string .= $campo."=".'\''.addslashes($valor).'\'';
				
				if ($i!= count($campos_valores))
				{
					$string .= ', ';
				}

				$i++;
			}

			$string .= " WHERE ";
			
			$i = 1;

			foreach($where as $nome => $valor)
			{
				
				$string .= $nome. "=".'\''.addslashes($valor).'\'';
				
				if ($i != count($where))
				{	
					$string .= ' and ';
				}

				$i++;
			}
			

			$quer =  mysql_query($string) or die(mysql_error());

			return true;
		}


	}

?>