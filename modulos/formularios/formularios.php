<h1>CRIAR FORMULARIOS PESONALIZADOS </h1>
<?php
	class Objeto_formulario
	{	
        public $nome_posicao;
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
              public $id_pagina;

		function montar_formulario(){
			
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
                                     `default` int(2) NOT NULL,
					  PRIMARY KEY (`ID`)
					) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Padrao de formularios' AUTO_INCREMENT=1;		
			";

			$this->slq_comando_insert($sql);

			$sql = "CREATE TABLE IF NOT EXISTS `formulario` (
				  `ID` int(11) NOT NULL AUTO_INCREMENT,
				  `nome` varchar(255) NOT NULL,
				  PRIMARY KEY (`ID`)
				) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Padrao de formularios' AUTO_INCREMENT=1;		
			";

			$this->slq_comando_insert($sql);

			$this->cria_diretorios_upload('formularios');
			
		}

		function __construct($id_pagina = null)
       	{
                     $this->id_pagina = $id_pagina;
                     $this->montar_formulario();
       	}

       	function slq_monta_form($posicao = '')
       	{      		

                     $campos = array('name','tipo','mask','maxlenth','opcoes_json','options','label','ordem');
                     //$campos = array('name');
                     $where = array('id_pagina'=>$this->id_pagina,'id_posicao'=>$posicao);

                     $campos = $this->sql_select_otimizado('padrao_formulario',$campos,$where);

                     //print_r($campos);
                     foreach($campos as $campo){


                            switch($campo['tipo']){
                                   case 'input':
                                          echo '<div>';
                                          echo '<span>'.$campo['label'].'</span>';
                                          echo '<input type="text" name="'.$campo['name'].'" maxlength="'.$campo['maxlenth'].'" required />';
                                          echo '</div>';
                                   break;

                                   case 'select':
                                          echo '<div>';
                                          echo '<span>'.$campo['label'].'</span>';
                                          //var_dump(explode(':',$campo->opcoes_json));
                                          $var = $campo['opcoes_json'];
                                          $var2 = json_encode($var);
                                          //$var3 = json_decode($var);
                                          var_dump($var);
                                          echo '<select name="'.$campo['name'].'" required>';
                                          
                                          foreach($var as $chave => $value){
                                                 echo '<option value="'.$chave['option'].'">'.$value['option'].'</option>';
                                          }
                                          echo '</select>';
                                          echo '</div>';
                                   break;

                                   case 'textarea':
                                          echo '<div>';
                                          echo '<span>'.$campo['label'].'</span>';
                                          echo '<textarea name="'.$campo['name'].'"></textarea>';
                                          echo '</div>';
                                   break;
                            }


                     }

       	}


       	function criar_formulario($nome_posicao,$obj){
       		
       		$sql = "INSERT INTO `padrao_formulario` (`ID`, `name`, `id_pagina`, `id_posicao`, `tipo`, `mask`, `maxlenth`, `opcoes_json`, `options`, `label`, `ordem`) VALUES (NULL, '$obj->name', '$this->id_pagina', '$nome_posicao', '$obj->tipo', '$obj->mask', '$obj->maxlenth', '$obj->opcoes_json', NULL,'$obj->label','$obj->ordem')";

       		//echo $sql;

       		$this->slq_comando_insert($sql);      		
       	}

       	function formulario_back_test(){

       		$obj = new Objeto_formulario();

       		if(!empty($_POST)){
       			$nome_posicao = 'BBBBB';
       			$obj->tipo = $_POST['tipo_formulario'];
                            $obj->name = $_POST['name_formulario'];
                            $obj->label = $_POST['label_formulario'];
       			$obj->mask = $_POST['mask_formulario'];
       			$obj->maxlenth = $_POST['maxlenth_formulario'];
       			$obj->opcoes_json = $_POST['opcoes_json_formulario'];

                            $campos = array('id_pagina'=>$this->id_pagina,'id_posicao'=>$nome_posicao,'tipo'=>$obj->tipo,'name'=>$obj->name,'label'=>$obj->label,'mask'=>$obj->mask,'maxlenth'=>$obj->maxlenth,'opcoes_json'=>$obj->opcoes_json);

       			$this->sql_insert_otimizado('padrao_formulario',$campos);
       		}

       		$inp = '<select name="tipo_formulario" required>';

	       		$inp .='<option value="input">INPUT</option>';
	       		$inp .='<option value="select">SELECT</option>';
	       		$inp .='<option value="textarea">TEXTAREA</option>';
	       		$inp .='<option value="radio">RADIO</option>';
	       		$inp .='<option value="checkbox">CHECKBOX</option>';

       		$inp .= '</select>';

       		$inp .= '<br>';

                     $inp .= '<input name="name_formulario" placeholder="Name" type="text" maxlenth="50" />';

                     $inp .= '<br>';

                     $inp .= '<input name="label_formulario" placeholder="Label" type="text" maxlenth="50" />';

                     $inp .= '<br>';

       		$inp .= '<input name="mask_formulario" placeholder="MASK" type="text" maxlenth="50" />';

       		$inp .= '<br>';

       		$inp .= '<input name="maxlenth_formulario" placeholder="MAXLENTH" type="text" maxlenth="10" />';

       		$inp .= '<br>';

       		$inp .= '<input name="opcoes_json_formulario" placeholder="OPTION_JSON" type="text" maxlenth="500" />';

       		return $inp;
       	}



       	function define_insere_formulario($nome_posicao)
       	{

                     $campos = array('ID','nome');

                     $where = array('nome'=>$nome_posicao);

                     $for = $this->sql_select_otimizado('formulario',$campos,$where);

                     // echo $for[0]['ID'];

                     // echo $for[0]['nome'];

       		if(count($for) <= 0)
			{

                            $campos =  array('nome' => $nome_posicao);
                            
                            $retorno_id = $this->sql_insert_otimizado('formulario',$campos);

                            $ultimo_id = $retorno_id;


			 	$obj = new Objeto_formulario();

                            $obj->tipo = 'input';

                            $obj->name = 'nome';

                            $obj->label = 'Nome:';			 	

       			$obj->mask =  '';
       			
       			$obj->maxlenth = ''; 
       			
       			$obj->opcoes_json = '';

                            $default = '1';

			 	$this->criar_formulario($nome_posicao,$obj);

                            $campos = array('nome');
                            $where = array('ID'=>$ultimo_id,'nome'=>$nome_posicao);
                            $nome_posicao = $this->sql_select_otimizado('formulario',$campos,$where);                            

				echo $this->slq_monta_form($nome_posicao[0]['nome']);

			 }
			 else
			 {
			 	echo $this->slq_monta_form($for[0]['nome']);

			 }
       	}
	}
/*
    echo '<h4>FRONT FORMULARIO</h4>';
    $id_pagina = '15';
    $for = new Formularios($id_pagina);
	$for->montar_formulario();*/

//FRONT
/*	 $for->define_insere_formulario('AAAAA');
    echo '<br><br><br><br>';
    $for->define_insere_formulario('BBBBB');
    $for->slq_monta_form();*/
 	//echo 'Formulario';

//BACK
/*    echo '<h4>BACK FORMULARIO</h4>';
	$obj = new Objeto_formulario();
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