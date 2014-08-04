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

				//estrutura defalt
                                $obj->nome = array('name'=>'nome','label'=>'Nome','tipo'=>'input','mask'=>'ttt','maxlenth'=>'30','opcoes_json','options','ordem'=>1,'value'=>'');
				$obj->preco = array('name'=>'preco','label'=>'Preco','tipo'=>'input','mask'=>'ttt','maxlenth'=>'30','opcoes_json','options','ordem'=>2,'value'=>'');
				$obj->categoria = array('name'=>'categoria','label'=>'Categoria','tipo'=>'select','mask'=>'ttt','maxlenth'=>'10','opcoes_json'=>$arrayJson,'options','ordem'=>3,'value'=>'');
				
                                
                                
				$itens::$nome_tabela = 'produtos';
				$itens::$categoria = 'categoria_produtos';
				$itens::$campos	 = $obj;
				$front = $itens::front($campos);
				return $front;

			}
                        
                        
                        public static function subistituir_produto()
                        {
                            $base = new Base();
                            
                            $itens = new Itens();
                            
                            $valores = $base::dados_post();                       
                            
                            if($valores)
                            {
                                $novo_cmapo = "{".$valores->jsonX."}";
                                
                                $array = json_decode($novo_cmapo,true);
                                
                                $procura_nome = false;
                                
                                $procura_categoria = false;
                                
                                foreach ($array as $chave => $v)
                                {
                                    if(($procura_nome == false) && strtoupper($chave) == 'NOME' ) 
                                    {
                                        $procura_nome = true;
                                    }   
                                    if(($procura_categoria == false) && strtoupper($chave) == 'CATEGORIA' ) 
                                    {
                                        $procura_categoria = true;
                                    }         
                                }        
                                if($procura_categoria == false )
                                {   
                                    $Formularios =  new Formularios();
                                    $c = array('categoria');
                                    $arrayJson = $Formularios->estrutura_option($c,true);
                                    $array['categoria'] = array('name'=>'categoria','label'=>'Categoria','tipo'=>'select','mask'=>'ttt','maxlenth'=>'10','opcoes_json'=>$arrayJson,'options','ordem'=>0,'value'=>'');
                                }    
                                
                                if($procura_nome == false )
                                {   
                                    $array['nome'] = array('name'=>'nome','label'=>'Nome','tipo'=>'input','mask'=>'ttt','maxlenth'=>'30','opcoes_json','options','ordem'=>0,'value'=>'');
                                } 

                                $base->sql_apagar_tabela('produtos');
                                
                                $c = array('estrutura'=> json_encode($array) );
                                
                                $w = array('nome'=>'produtos');
  
                                $base->sql_update_otimizado('itens',$c,$w);
                                
                                $itens::$nome_tabela = 'produtos';
                                
                                $itens::$categoria = 'categoria_produtos';
                                
                                $itens::$campos	 = $array;
                                
                                $front = $itens::front();
                                
                                echo self::menssagem("<strong>Criado </strong> com sucesso !", 'sucesso');
                                
                            }

                            
                            $itens::modelo_substituir_item();
                            
                            
                        }        

                        

                        public function lista()
                        {
                            return false;
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

				$nome = array('nome'=>'PRODUTOS','url'=>'plugin/produtos/listar.html');

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

			private static function item_lista_html($nome,$tipo,$url)
			{

					$html =  "<ol class='breadcrumb'>";
					$html .=     "<li><a href='$url/editar/$tipo.html'>Editar <span class='glyphicon glyphicon-edit'></span></a></li>";
					$html .=      "<li><a href='$url/apagar/$tipo.html'>Apagar <span class='glyphicon glyphicon-trash'></span></a></li>";
					$html .=     "<li class='navbar-right'><strong>$nome</strong></li>";
					$html .=   "</ol>";
					return $html;
			}
                        //glyphicon glyphicon-edit
                        private static function menu_produto_html()
                        {
                            ?>
                            <div class="bs-example">
                                <div class="btn-group">

                                  <div class="btn-group">
                                    <button id="btnGroupVerticalDrop3" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                     Categorias
                                      <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="btnGroupVerticalDrop3">
                                      <li><a href="plugin/produtos/categorias/novo.html">Nova</a></li>
                                      <li><a href="plugin/produtos/categorias/listar.html">Listar</a></li>
                                    </ul>
                                  </div>
                                    
                                  <div class="btn-group">
                                    <button id="btnGroupVerticalDrop4" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                      Produtos
                                      <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="btnGroupVerticalDrop4">
                                      <li><a href="plugin/produtos/novo.html">Novo</a></li>
                                      <li><a href="plugin/produtos/listar.html">Listar</a></li>
                                    </ul>
                                  </div>

                                  <div class="btn-group">
                                    <button id="btnGroupVerticalDrop4" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                      Opcoes
                                      <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="btnGroupVerticalDrop4">
                                      <li><a href="plugin/produtos/reconfigurar.html">Mudar estrutura</a></li>
                                    </ul>
                                  </div>                                    
                                    
                                </div>
                              </div>
                            <br>  
                            

                            
                            <?php
                        }        

                        
                        public function back($url)
			{

					$dados = new stdClass();

					$itens = new Itens();

					$formulario = new Formularios();
                                        
                                        self::menu_produto_html();
                                        
					switch($url['2'])
					{
						case 'listar':
                                                        
                                                                                                                                    
							$dados->campos = array('ID','nome');

							$dados->where = array('');

							$lista = $itens::backend($url['1'],$dados,$url['2']);
                                                        
          
                                                        if(count($lista) < 1)
                                                        {
                                                            echo self::menssagem('Nemhum item cadastrado', 'cuidado');
                                                        }  

							foreach ($lista as $valores)
							{
								echo self::item_lista_html($valores['nome'],$valores['ID'],'plugin/produtos');
							}

						break;

						case 'editar':
                                                    
							$base = new Base();

							$dados->id = $url['3'];

							$dados->post = $base::dados_post();

							$edita = $itens::backend($url['1'],$dados,$url['2']);
                                                        
                                                        if($dados->post == true && $edita == true)
                                                        {
                                                            echo self::menssagem("<strong>Atualizado</strong> com sucesso !", 'sucesso');
                                                        }    

							$formulario->form($edita,'','EDITAR','');

						break;
                                                
                                                case 'apagar':
                                                    
							$base = new Base();

							$dados->id = $url['3'];

							$apaga = $itens::backend($url['1'],$dados,$url['2']);
                                                        
                                                        echo $apaga;
							

						break;

						case 'novo':
                                                    
							$base = new Base();

							$dados = $base::dados_post();
                                                        
							$lista = $itens::backend($url['1'],$dados,$url['2']);
                                                        
                                                        if($dados == true && $lista == true)
                                                        {
                                                            echo self::menssagem("<strong>Inserido</strong> com sucesso !", 'sucesso');
                                                        }    

							$formulario->form($lista,'','SALVAR','');

						break;
                                                
                                                
                                                case 'reconfigurar':
                                                    
                                                    self::subistituir_produto();  
                                                    
						break;

						case 'categorias':


							switch ($url['3'])
							{
								case 'listar':
									$dados->campos = array('ID','nome');

									$dados->where = array('');

									$lista = $itens::$nome_tabela = 'categoria_produtos';

									$lista = $itens::backend('categoria_produtos',$dados,'listar');
                                                                        
                                                                        if(count($lista) < 1)
                                                                        {
                                                                            echo self::menssagem('Nemhuma categoria cadastrada', 'cuidado');
                                                                        }    

									foreach ($lista as $valores)
									{
										echo self::item_lista_html($valores['nome'],$valores['ID'],'plugin/produtos/categorias');
									}

								break;

								case 'editar':
                                                                       
									$base = new Base();

									$dados->id = $url['4'];

									$dados->post = $base::dados_post();

									$edita = $itens::backend('categoria_produtos',$dados,'editar');

									$formulario->form($edita,'','EDITAR','');

								break;
                                                            
                                                                case 'apagar':
                                                    
                                                                    $base = new Base();

                                                                    $dados->id = $url['4'];

                                                                    $apaga = $itens::backend('categoria_produtos',$dados,$url['3']);

                                                                    echo $apaga;
                                                                    
                                                                break;

								case 'novo':

									$base = new Base();

									$dados = $base::dados_post();
                                                                        
                                                                            
									$lista = $itens::backend('categoria_produtos',$dados,'novo');
                                                                        
                                                                        if($dados == true && $lista == true)
                                                                        {
                                                                            echo self::menssagem("<strong>Inserido</strong> com sucesso !", 'sucesso');
                                                                        }    

									$formulario->form($lista,'','SALVAR','');

								break;


								default:
									$dados->campos = array('ID','nome');

									$dados->where = array('');

									$lista = $itens::$nome_tabela = 'categoria_produtos';

									$lista = $itens::backend('categoria_produtos',$dados,'listar');

									foreach ($lista as $valores)
									{
										echo self::item_lista_html($valores['nome'],$valores['ID'],'plugin/produtos/categorias');
									}
									break;
							}

						break;

						default:

								$dados->campos = array('ID','nome');

								$dados->where = array('');

								$lista = $itens::backend($url['1'],$dados,$url['2']);

								foreach ($lista as $valores)
								{

									echo self::item_lista_html($valores['nome'],$valores['ID'],'plugin/produtos');
								}
						break;

					}


			}

	}


?>

