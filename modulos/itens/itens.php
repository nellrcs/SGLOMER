<?php

class Itens extends Base
{
	public static $nome_tabela;

	public static $campos;

	public static $categoria;

	function Itens()
	{

	}

	private static function criar_item()
	{

		$principal = new Principal();

		$campos_item = array($principal->campo_para_tabela('nome','input'),$principal->campo_para_tabela('estrutura','textarea'));

		$principal->sql_criar_tabela('itens',$campos_item);

	}

	private static function montar()
	{

		self::criar_item();

		$principal = new Principal();

		$tabela = self::$nome_tabela;

		if(!empty($tabela))
		{

			$campos = array('ID','estrutura');

			$where = array('nome' => $tabela);

		    $xox = $principal->sql_select_otimizado('itens',$campos,$where);

		    if( count($xox) <= 0  )
		    {
		    	$templte_form = json_encode(self::$campos);

		    	$campos_itens =  array('nome' => $tabela,'estrutura'=>$templte_form);

					$principal->sql_insert_otimizado('itens',$campos_itens);
		    }


			$campos_tabela = array();

			foreach (self::$campos as $key => $value)
			{
				$campos_tabela[] =  $principal->campo_para_tabela($key,$value['tipo']);
			}

			$principal->sql_criar_tabela($tabela,$campos_tabela);
		}

	}

	public static function formulario_item($valores = null)
	{

		$formularios = new Formularios();

		$principal = new Principal();

		$tabela = self::$nome_tabela;

		if($valores)
		{
			$elemento = $valores;
		}
		else
		{

			///

			$formularios = new Formularios();

			$o = self::listagem_categoria();

			$select = array();

			foreach ($o as $d)
			{
				$select[$d['ID']] = $d['nome'];
			}

			$options = $formularios->estrutura_option($select);


			///

			$campos = array('estrutura');

			$where = array('nome' => $tabela);

			$xox = $principal->sql_select_otimizado('itens',$campos,$where);

			$elm2 = json_decode($xox[0]['estrutura'],true);

			$novo = $elm2;

			foreach ($elm2 as $chave => $item)
			{
				if($novo[$chave]['name'] == 'categoria')
				{
					if($options)
					{
						$novo[$chave]['opcoes_json'] = "0|nehuma..,".$options;
					}
				}
			}
			$elemento = $novo;
		}

		$campos = $formularios->formulario_template($elemento);

	 return $campos;

	}

	public static function inserir_item($obj)
	{
		self::criar_item();

		$principal = new Principal();

		$tabela = self::$nome_tabela;

		$campos_valores = array();

		$form = self::formulario_item();

		if($obj)
		{
			foreach($obj as $key => $value)
			{
				$campos_valores[$key] =  $value;
			}

			$ultimo_id = $principal->sql_insert_otimizado($tabela,$campos_valores);
                        
                        return self::editar_item($ultimo_id,null);
                        
		}
                else 
                { 
                  return $form;  
                }

		
	}

	public static function lista_itens()
	{
		self::criar_item();

		$principal = new Principal();

		$campos = array('ID','nome');

		$xox = $principal->sql_select_otimizado('itens',$campos);

		$array = array();

		$array[] = array('ID'=>$xox[0]['ID'],'posicao'=>$xox[0]['nome'],'editar'=>'itens');

		return false;

	}

	//mostra um lista de itens ! elaborar melhor para paginacao
	public static function listagem_tebela($campos,$where = null)
	{
			$principal = new Principal();

	    $xox = $principal->sql_select_otimizado(self::$nome_tabela,$campos,$where);

	    return $xox;
	}

	//mostra um lista de itens ! elaborar melhor para paginacao
	public static function listagem_categoria()
	{
			$principal = new Principal();

			$campos = array('ID','nome');

			$xox = $principal->sql_select_otimizado(self::$categoria,$campos);

			return $xox;
	}

        public static function modelo_substituir_item()
        {
        ?>  
            <style>
                #modules {
                    padding: 20px;
                    background: #eee;
                    margin-bottom: 20px;
                    z-index: 1;
                    border-radius: 10px;
                  }

                  #dropzone {
                    padding: 20px;
                    background: #eee;
                    min-height: 200px;
                    margin-bottom: 20px;
                    z-index: 0;
                    border-radius: 10px;
                  }

                  .item .active {
                    outline: 1px solid red;
                  }

                  .item .hover {
                    outline: 1px solid blue;
                  }

                  .item .drop-item {
                    cursor: pointer;
                    margin-bottom: 10px;
                    background-color: rgb(255, 255, 255);
                    padding: 5px 10px;
                    border-radisu: 3px;
                    border: 1px solid rgb(204, 204, 204);
                    position: relative;
                  }

                  .drop-item .remove {
                    position: absolute;
                    top: 4px;
                    right: 4px;
                  }

                  .ds {
                    cursor: pointer;
                    margin-bottom: 10px;
                    background-color: rgb(255, 255, 255);
                    padding: 15px 15px;
                    border-radisu: 3px;
                    border: 1px solid rgb(204, 204, 204);
                    position: relative;
                  }

                  .ds .remove {
                    position: absolute;
                    top: 8px;
                    right: 8px;
                  }
                  .hide{
                    display: none;
                  }
            </style>  
            <div class="item">
              <h1>Modelo Item</h1>
              <div class="row">
                <div class="col-sm-6">
                  <div id="modules">

                    <p class="drag"><a class="btn btn-default">textarea</a></p>
                    <p class="drag"><a class="btn btn-default">input</a></p>
                    <p class="drag"><a class="btn btn-default">imagem</a></p>
                    <p class="drag"><a class="btn btn-default">hidden</a></p>

                  </div>
                </div>

                <div class="col-sm-6">
                  <div id="dropzone"></div>
                </div>

              </div>

              <div>
                <label for="">Mostrar codigo</label>
                <input id="check"  type="checkbox" > 
              </div>
              <form role="form" action="" method="POST">
                <div class="form-group">
                  <textarea class="form-control" type="text" rows="6" name="jsonX" id="tex2" placeholder="Codigo" readonly></textarea>
                </div>
                  <button class="btn btn-primary pull-right" type="submit">Salvar</button>
              </form>
            </div>
            
             <script>
            $('.drag').draggable({ 
                appendTo: 'body',
                helper: 'clone'
              });

              var cont = 0;
              var pos = [];

              $('#dropzone').droppable({
                activeClass: 'active',
                hoverClass: 'hover',
                accept: ":not(.ui-sortable-helper)", // Reject clones generated by sortable
                drop: function (e, ui) {

                  cont = cont+1;
                  var p = 0;

                  var fm = '<div class="ds"><input name="name_formulario" placeholder="Name" class="form-control" type="text" maxlenth="50" /><details><summary><strong>Tipo:</strong>' + ui.draggable.text() +'</summary><div>';
                      fm = fm + '<br>';
                      fm = fm + '<br><input name="label_formulario" placeholder="Label" class="form-control"  type="text" maxlenth="50" />';
                      fm = fm + '<br><input name="mask_formulario" placeholder="MASK" class="form-control" type="text" maxlenth="50" />';
                      fm = fm + '<br><input name="maxlenth_formulario" placeholder="MAXLENTH" class="form-control" type="text" maxlenth="10" />';
                      fm = fm + '</div></details></div>';

                  var $el = $(fm);


                  $el.p = cont;
                  $el.tipo = ui.draggable.text();


                  function lecampos()
                  {
                    $el.nm = $el.find('input[name="name_formulario"]').val();
                    
                    if($el.find('input[name="label_formulario"]').val() == '')
                    {
                        $el.lb = $el.find('input[name="name_formulario"]').val();
                    }
                    else
                    {
                       $el.lb = $el.find('input[name="label_formulario"]').val(); 
                    }    

                    $el.mk = $el.find('input[name="mask_formulario"]').val();
                    $el.ml = $el.find('input[name="maxlenth_formulario"]').val();

                    pos[$el.p] =' "'+$el.nm+'":{"name":"'+$el.nm+'","label":"'+$el.lb+'","tipo":"'+$el.tipo+'","mask":"'+$el.mk+'","maxlenth":"'+$el.ml+'","0":"opcoes_json","1":"options","ordem":"'+$el.p+'","value":""} ';
                    
                    if($el.find('input[name="name_formulario"]').val() == '')
                    {    
                        pos[$el.p] = null;
                    }
                } 

                  function evento()
                  {
                      var jasons = null;

                      $.each( pos, function( key, value ) {

                        if(value != null)
                        {
                          if(jasons == null)
                          {
                            jasons = value;
                          }
                          else
                          {
                            jasons = jasons+","+value;
                          }  
                        }

                      });

                      $('#tex2').val(jasons);
                  }


                  $el.find('input').on("keyup",function()
                  {  
                    lecampos();
                    evento();
                  })


                  $el.click(function () 
                  { 
                    evento();          
                  } )


                  $el.append($('<button type="button" class="btn btn-default btn-xs remove"><span class="glyphicon glyphicon-trash"></span></button>').click(function () { $(this).parent().detach(); pos[$el.p] = null; }));
                  $(this).append($el);
                }
              }).sortable({
                items: '.drop-item',
                sort: function() {
                  $( this ).removeClass( "active" );
                }
              });


              $( "#check" ).change(function() {

                 var $input = $( this );

                 if( $input.is( ":checked" ) == false )
                 {
                   $('#tex2').addClass( "hide" );
                 } 
                 else
                 {
                    $('#tex2').removeClass( "hide" );
                 }  

              }).change();

        </script>
        <?php     
        }
                

        
        public static function editar_item($item_id,$obj)
	{
		$principal = new Principal();

		$tabela = self::$nome_tabela;

		if($obj)
		{
			foreach($obj as $key => $value)
			{
				$campos_valores[$key] =  $value;
			}
			$where = array('ID'=>$item_id);

			$principal->sql_update_otimizado($tabela,$campos_valores,$where);
		}

		$campos = array('estrutura');

		$where = array('nome' => $tabela);

		$xox = $principal->sql_select_otimizado('itens',$campos,$where);

		$elm2 = json_decode($xox[0]['estrutura'],true);

		$camposX = array();

		foreach ($elm2 as $chave => $valor)
		{
				$camposX[] = $chave;
		}

		$novo = $elm2;

		$where = array('ID'=>$item_id);

		$itens = $principal->sql_select_otimizado($tabela,$camposX,$where);

		///

		$formularios = new Formularios();

		$o = self::listagem_categoria();

		$select = array();

		foreach ($o as $d)
		{
			$select[$d['ID']] = $d['nome'];
		}

		$options = $formularios->estrutura_option($select);

		///

		foreach ($itens[0] as $chave => $item)
		{
			$novo[$chave]['value'] = $item;
			if($novo[$chave]['name'] == 'categoria')
			{
				if($options)
				{
					$novo[$chave]['opcoes_json'] = "0|nemhuma..,".$options;
				}
			}
		}

		$form = self::formulario_item($novo);

		return $form;
	}

        
    public static function apagar_item($item_id)
	{
		$principal = new Principal();

		$tabela = self::$nome_tabela;

                $where = array('ID'=>$item_id);
                
		$principal->slq_apagar_otimizado($tabela,$where);
                
                return true;
	}
        
        
	public static function front($obj = null)
	{
		self::montar();

		if($obj)
		{
			return self::listagem_tebela($obj->campos,$obj->where);
		}
		else
		{
			return false;
		}
	}

	public static function backend($pagina,$dados,$acao)
	{
		self::montar();

		switch($acao)
		{
			case 'listar':
				$lista = self::listagem_tebela($dados->campos,$dados->where);
				return $lista;
			break;

			case 'editar':
                                self::$nome_tabela = $pagina;
				$form_editar = self::editar_item($dados->id,$dados->post);
				return $form_editar;
			break;

			case 'novo':
				self::$nome_tabela = $pagina;
				$form_novo = self::inserir_item($dados);
				return $form_novo;
			break;
                    
                        case 'apagar':
				self::$nome_tabela = $pagina;
                            
				$apagar = self::apagar_item($dados->id);
                                
				return self::menssagem('Excluido com sucesso', 'cuidado');
			break;

			default:
				$lista = self::listagem_tebela($dados->campos,$dados->where);
				return $lista;

		}



	}

}
?>