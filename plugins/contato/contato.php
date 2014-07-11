<?php

	class Contato_tipos
	{
		public $nome_posicao_plugin;
	}


	class Contato extends Principal
	{
		public $id_pagina;

		function Contato($id_pagina)
		{	
			$this->id_pagina = $id_pagina;
		}


		public function front($obj)
		{

	        echo '<h1>CONTATO</h1>';

	       	$for = new Formularios($this->id_pagina);
		    
	       	//echo $obj->id_posicao;

		    $for->define_insere_formulario($obj->id_posicao);


		    $todos_os_campos = array();


		    //usar isso para criar a tabela no banco
		    $nomes_que_vao_pro_banco = array('nome','email','telefone','celular','');

		    foreach($nomes_que_vao_pro_banco as$nomes)
		    {
		    	$todos_os_campos[] = array( 
		    	'nome_posicao' => $obj->id_posicao, 
		    	'tipo' => 'input', 
		    	'name' => $nomes, 
		    	'label' =>  ucfirst($nomes), 
		    	'mask' => ucfirst($nomes), 
		    	'maxlenth' => '30', 
		    	'opcoes_json' => '' 
		    	);
		    }


		    //print_r($todos_os_campos);


			//$for->formulario_back_test_2($todos_os_campos);

		}

		public function back()
		{			
			//echo $for->formulario_back_test($obj->id_posicao);
		}

	}
?>