<?php
	class Produtos_obj
	{
		public $campos;
		public $where;
	}

	class Produtos extends Principal
	{
			public $id_pagina;

			function Produtos($id_pagina)
			{}

			public static function montar_produtos($campos = null)
			{
			
				$itens = new Itens();
		
				$obj = new stdClass();

				$obj->nome = array('name'=>'nome','label'=>'Nome','tipo'=>'input','mask'=>'ttt','maxlenth'=>'30','opcoes_json','options','ordem'=>1);

				$obj->preco = array('name'=>'preco','label'=>'Preco','tipo'=>'input','mask'=>'ttt','maxlenth'=>'30','opcoes_json','options','ordem'=>2);

				$obj->categoria = array('name'=>'categoria','label'=>'Categoria','tipo'=>'input','mask'=>'ttt','maxlenth'=>'10','opcoes_json','options','ordem'=>3);

				$obj->descricao = array('name'=>'descricao','label'=>'Descricao','tipo'=>'textarea','mask'=>'ttt','maxlenth'=>'10','opcoes_json','options','ordem'=>4);

				$obj->imagem = array('name'=>'imagem','label'=>'Imagem','tipo'=>'input','mask'=>'ttt','maxlenth'=>'10','opcoes_json','options','ordem'=>5);

				$itens::$nome_tabela = 'produtos';

				$itens::$campos	 = $obj;

				$front = $itens::front($campos);

				return $front;

			}


			public function plugin_menu()
			{
				//por enquanto 

				self::montar_produtos();

				$nome = array('nome'=>'Produtos','url'=>'editar/itens/produtos.html');

				return $nome;
			}
			

			public function plugin_lista()
			{

				$itens = new Itens();

				$lista = $itens::lista_itens();

				return $lista;
			}


			public function front($obj)
			{			
				
				$vlor = self::montar_produtos($obj); 

				return $vlor;
			}

			public function back()
			{			
				
			}


	}


?>