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
			{


			}

			public static function montar_produtos($campos = null)
			{

				self::montar_categorias();

				$itens = new Itens();

				$obj = new stdClass();

				$Formularios =  new Formularios();

				$array = array('categoria');

				$arrayJson = $Formularios->estrutura_option($array,true);

				$obj->nome = array('name'=>'nome','label'=>'Nome','tipo'=>'input','mask'=>'ttt','maxlenth'=>'30','opcoes_json','options','ordem'=>1,'value'=>'');

				$obj->preco = array('name'=>'preco','label'=>'Preco','tipo'=>'input','mask'=>'ttt','maxlenth'=>'30','opcoes_json','options','ordem'=>2,'value'=>'');

				$obj->categoria = array('name'=>'categoria','label'=>'Categoria','tipo'=>'select','mask'=>'ttt','maxlenth'=>'10','opcoes_json'=>$arrayJson,'options','ordem'=>3,'value'=>'');

				$obj->descricao = array('name'=>'descricao','label'=>'Descricao','tipo'=>'textarea','mask'=>'ttt','maxlenth'=>'10','opcoes_json','options','ordem'=>4,'value'=>'');

				$obj->peso = array('name'=>'peso','label'=>'peso','tipo'=>'input','mask'=>'ttt','maxlenth'=>'10','opcoes_json','options','ordem'=>5,'value'=>'');

				$obj->cor = array('name'=>'cor','label'=>'cor','tipo'=>'input','mask'=>'ttt','maxlenth'=>'10','opcoes_json','options','ordem'=>6,'value'=>'');

				$obj->quantidade = array('name'=>'quantidade','label'=>'quantidade','tipo'=>'input','mask'=>'ttt','maxlenth'=>'10','opcoes_json','options','ordem'=>7,'value'=>'');

				$obj->imagem = array('name'=>'imagem','label'=>'Imagem','tipo'=>'input','mask'=>'ttt','maxlenth'=>'10','opcoes_json','options','ordem'=>8,'value'=>'');

				$itens::$nome_tabela = 'produtos';

				$itens::$categoria = 'categoria_produtos';

				$itens::$campos	 = $obj;

				$front = $itens::front($campos);

				return $front;

			}

		public static function montar_categorias($campos = null)
		{

			$itens = new Itens();

			$obj = new stdClass();

			$Formularios =  new Formularios();

			$array = array('categoria');

			$arrayJson = $Formularios->estrutura_option($array,true);

			$obj->nome = array('name'=>'nome','label'=>'Nome','tipo'=>'input','mask'=>'ttt','maxlenth'=>'30','opcoes_json','options','ordem'=>1,'value'=>'');

			$obj->categoria = array('name'=>'categoria','label'=>'Categoria pai','tipo'=>'select','mask'=>'ttt','maxlenth'=>'30','opcoes_json'=>$arrayJson,'options','ordem'=>1,'value'=>'');

			$itens::$nome_tabela = 'categoria_produtos';

			$itens::$categoria = 'categoria_produtos';

			$itens::$campos	 = $obj;

			$front = $itens::front($campos);

			return $front;

		}


			public function plugin_menu()
			{
				//por enquanto

				self::montar_produtos();

				$nome = array('nome'=>'Produtos','url'=>'plugin/produtos/listar.html');

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

			private static function item_lista_html($nome,$url)
			{

					$html =  "<ol class='breadcrumb'>";
					$html .=     "<li class='active'>Editar</li>";
					$html .=      "<li><a href='$url.html'>EDITAR</a></li>";
					$html .=     "<li class='navbar-right'><strong>$nome</strong></li>";
					$html .=   "</ol>";
					return $html;
			}

			public function back($url)
			{

					$dados = new stdClass();

					$itens = new Itens();

					$formulario = new Formularios();

					switch($url['2'])
					{
						case 'listar':

							echo "<h3><a href='plugin/produtos/novo.html'>NOVO</a></h3>";

							echo "<h3><a href='plugin/produtos/categorias/listar.html'>CATEGORIA</a></h3>";

							$dados->campos = array('ID','nome');

							$dados->where = array('');

							$lista = $itens::backend($url['1'],$dados,$url['2']);

							foreach ($lista as $valores)
							{
								echo self::item_lista_html($valores['nome'],"plugin/produtos/editar/".$valores['ID']);
							}

						break;

						case 'editar':

							$base = new Base();

							$dados->id = $url['3'];

							$dados->post = $base::dados_post();

							$edita = $itens::backend($url['1'],$dados,$url['2']);

							$formulario->form($edita,'','EDITAR','');

						break;

						case 'novo':

							$base = new Base();

							$dados = $base::dados_post();

							$lista = $itens::backend($url['1'],$dados,$url['2']);

							$formulario->form($lista,'','SALVAR','');

						break;

						case 'categorias':

							self::montar_categorias();

							echo "<h3><a href='plugin/produtos/categorias/novo.html'>NOVA</a></h3>";

							echo "<h3><a href='plugin/produtos/categorias/listar.html'>CATEGORIA</a></h3>";

							switch ($url['3'])
							{
								case 'listar':
									$dados->campos = array('ID','nome');

									$dados->where = array('');

									$lista = $itens::$nome_tabela = 'categoria_produtos';

									$lista = $itens::backend('categoria_produtos',$dados,'listar');

									foreach ($lista as $valores)
									{
										echo self::item_lista_html($valores['nome'],"plugin/produtos/categorias/editar/".$valores['ID']);
									}

								break;

								case 'editar':

									$base = new Base();

									$dados->id = $url['4'];

									$dados->post = $base::dados_post();

									$edita = $itens::backend('categoria_produtos',$dados,'editar');

									$formulario->form($edita,'','EDITAR','');

								break;

								case 'novo':

									$base = new Base();

									$dados = $base::dados_post();

									$lista = $itens::backend('categoria_produtos',$dados,'novo');

									$formulario->form($lista,'','SALVAR','');

								break;


								default:
									$dados->campos = array('ID','nome');

									$dados->where = array('');

									$lista = $itens::$nome_tabela = 'categoria_produtos';

									$lista = $itens::backend('categoria_produtos',$dados,'listar');

									foreach ($lista as $valores)
									{
										echo self::item_lista_html($valores['nome'],"plugin/produtos/categorias/editar/".$valores['ID']);
									}
									break;
							}

						break;

						default:
								echo "<h2><a href='plugin/produtos/novo.html'>NOVO</a></h2>";

								echo "<h2><a href='plugin/produtos/categorias/listar.html'>CATEGORIA</a></h2>";

								$dados->campos = array('ID','nome');

								$dados->where = array('');

								$lista = $itens::backend($url['1'],$dados,$url['2']);

								foreach ($lista as $valores)
								{

									echo self::item_lista_html($valores['nome'],"plugin/produtos/editar/".$valores['ID']);
								}
						break;

					}


			}


			function categorias()
			{


			}



	}


?>
