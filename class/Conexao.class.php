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
		public static function sql_comando($string){
			$quer = mysql_query($string) or die(mysql_error());
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


		public function sql_update_otimizado($tabela,$campos_valores = array(),$where = array())
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



		function sql_criar_tabela($tabela,$campos_valores)
		{


			$string = "CREATE TABLE IF NOT EXISTS `". $tabela ."` (`ID` int(11) NOT NULL AUTO_INCREMENT,";

			$i = 1;

			foreach($campos_valores as $campo => $valor)
			{

				$string .= $valor;

				if ($i!= count($campos_valores))
				{
					$string .= ', ';
				}

				$i++;
			}

			$string .= ", PRIMARY KEY (`ID`) ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Table with abuse reports' AUTO_INCREMENT=1;";

			$quer =  mysql_query($string) or die(mysql_error());

			return true;

		}

		//MELHORAR ESTA FUNCAO! COM MAIS OPCOES
		function campo_para_tabela($nome,$tipo)
		{
			switch ($tipo)
			{
				case 'input':
					$campo = " `".$nome."` varchar(200) NOT NULL DEFAULT '0'";
				break;

				case 'textarea':
					$campo = " `".$nome."` text NOT NULL DEFAULT '' ";
				break;

				case 'select':
					$campo = " `".$nome."` text NOT NULL DEFAULT '' ";
				break;

				case 'radio':
					$campo = " `".$nome."` text NOT NULL DEFAULT '' ";
				break;

				case 'checkbox':
					$campo = " `".$nome."` text NOT NULL DEFAULT '' ";
				break;

			}

			return $campo;
		}




	}

?>
