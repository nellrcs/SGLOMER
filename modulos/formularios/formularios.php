<h1>CRIAR FORMULARIOS PESONALIZADOS </h1>
<?php
	class Objeto_formulario
	{	
		public $name;
		public $tipo;
		public $mask;
		public $maxlenth;
		public $opcoes_json;
		public $options;
		public $label;
		public $ordem;
	}

	class Formularios extends Principal
	{
		function montar_formulario(){

			$form = new Principal();

			$sql = "CREATE TABLE IF NOT EXISTS `padrao_formulario` (
					  `ID` int(11) NOT NULL AUTO_INCREMENT,
					  `name` varchar(50) NOT NULL,
					  `id_pagina` int(11) NOT NULL,
					  `id_posicao` varchar(200) NOT NULL,
					  `tipo` enum('input','select','textarea','radio','checkbox') DEFAULT NULL,
					  `mask` varchar(50) NOT NULL DEFAULT '',
					  `maxlenth` varchar(10) NOT NULL DEFAULT '0',
					  `opcoes_json` varchar(500) NOT NULL DEFAULT '',
					  `options` enum('nenhum','text','file') DEFAULT NULL,
					  `label` varchar(255) NOT NULL,
					  `ordem` int(5) NOT NULL,
					  PRIMARY KEY (`ID`)
					) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Padrao de formularios' AUTO_INCREMENT=1;		
			";

			$form->slq_comando_insert($sql);

			$sql = "CREATE TABLE IF NOT EXISTS `formulario` (
				  `ID` int(11) NOT NULL AUTO_INCREMENT,
				  `nome` varchar(255) NOT NULL,
				  PRIMARY KEY (`ID`)
				) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Padrao de formularios' AUTO_INCREMENT=1;		
			";

			$form->slq_comando_insert($sql);

			$form->cria_diretorios_upload('formularios');
			
		}

		function __construct()
       	{

       	}

       	function slq_monta_form($query)
       	{
       		

       		$sql = mysql_query("SELECT * FROM padrao_formulario WHERE id_posicao='AAAAA' AND id_pagina='15' ORDER BY ordem ASC");


       		while($ln = mysql_fetch_object($sql)){


       			switch($ln->tipo){
       				case 'input':
       					echo '<div>';
       					echo '<span>'.$ln->label.'</span>';
       					echo '<input type="text" name="'.$ln->name.'" maxlength="'.$ln->maxlenth.'" required />';
       					echo '</div>';
       				break;
       				case 'select':
       					echo '<div>';
       					echo '<span>'.$ln->label.'</span>';
       					//var_dump(explode(':',$ln->opcoes_json));
       					$var = $ln->opcoes_json;
       					//$var2 = json_encode($var);
       					//$var3 = json_decode($var);
       					var_dump($var);
       					echo '<select name="'.$ln->name.'" required>';
       					
       					foreach($var as $chave => $value){
       						echo '<option value="'.$chave.'">'.$value.'</option>';
       					}
       					echo '</select>';
       					echo '</div>';
       				break;
       				case 'textarea':
       					echo '<div>';
       					echo '<span>'.$ln->label.'</span>';
       					echo '<textarea name="'.$ln->name.'"></textarea>';
       					echo '</div>';
       				break;
       			}


       		}

       		//return $sql;

       	}


       	function criar_formulario($id_pagina,$nome_posicao,$obj){
       		
       		$sql = "INSERT INTO `padrao_formulario` (`ID`, `name`, `id_pagina`, `id_posicao`, `tipo`, `mask`, `maxlenth`, `opcoes_json`, `options`, `label`, `ordem`) VALUES (NULL, '$obj->name', '$id_pagina', '$nome_posicao', '$obj->tipo', '$obj->mask', '$obj->maxlenth', '$obj->opcoes_json', NULL,'$obj->label','$obj->ordem')";

       		echo $sql;

       		$this->slq_comando_insert($sql);      		
       	}

       	function formulario_back_test(){

       		$obj = new Objeto_formulario();

       		if(!empty($_POST)){
       			$id_pagina = '15';
       			$nome_posicao = 'AAAAA';
       			$obj->tipo = $_POST['tipo_formulario'];
       			$obj->mask = $_POST['mask_formulario'];
       			$obj->maxlenth = $_POST['maxlenth_formulario'];
       			$obj->opcoes_json = $_POST['opcoes_json_formulario'];

       			$this->criar_formulario($id_pagina,$nome_posicao,$obj);
       		}

       		$inp = '<select name="tipo_formulario" required>';

	       		$inp .='<option value="input">INPUT</option>';
	       		$inp .='<option value="select">SELECT</option>';
	       		$inp .='<option value="textarea">TEXTAREA</option>';
	       		$inp .='<option value="radio">RADIO</option>';
	       		$inp .='<option value="checkbox">CHECKBOX</option>';

       		$inp .= '</select>';

       		$inp .= '<br>';

       		$inp .= '<input name="mask_formulario" placeholder="MASK" type="text" maxlenth="50" />';

       		$inp .= '<br>';

       		$inp .= '<input name="maxlenth_formulario" placeholder="MAXLENTH" type="text" maxlenth="10" />';

       		$inp .= '<br>';

       		$inp .= '<input name="opcoes_json_formulario" placeholder="OPTION_JSON" type="text" maxlenth="500" />';

       		return $inp;
       	}



       	function define_insere_formulario($id_pagina,$nome_posicao)
       	{
       		$this->montar_formulario();

       		$sql = "SELECT * FROM formulario WHERE ID = ".$id_pagina." AND nome = '".$nome_posicao."'";

       		if(!$this->slq_comando_select($sql, 1))
			 {
			 	$string ="INSERT INTO `formulario` (`ID`, `nome`) VALUES (NULL, '$nome_posicao')";

			 	$ultimo_id = $this->slq_comando_insert($string);




/*			 	$obj = new Objeto_formulario();

			 	$obj->tipo = 'input';

       			$obj->mask =  '';
       			
       			$obj->maxlenth = ''; 
       			
       			$obj->opcoes_json = '';

			 	$this->criar_formulario($id_pagina,$nome_posicao,$obj);*/



				echo $this->slq_monta_form("SELECT * FROM padrao_formulario WHERE id_posicao='$nome_posicao' AND id_pagina='$id_pagina'");



			 }
			 else
			 {
			 	echo $this->slq_comando("SELECT * FROM padrao_formulario WHERE id_posicao='$nome_posicao' AND id_pagina='$id_pagina'");	

			 }
       	}
	}


	$for = new Formularios();
	
	$for->montar_formulario();

	//FRONT
	$for->define_insere_formulario(15,'AAAAA');

	$for->slq_monta_form('aa');




//BACK
/*	$obj = new Objeto_formulario();

	$obj->tipo = 'select';
	$obj->mask = ' ';
	$obj->maxlenth = '';
	$obj->opcoes_json = '{option:1/NOME,2/SOBRENOME,3/CPF}';

	echo '<form action="#" method="post">';

	echo $for->formulario_back_test();
	echo '<br>';
	echo '<button name="submit" type="submit">ENVIAR</button>';

	echo '</form>';*/


?>