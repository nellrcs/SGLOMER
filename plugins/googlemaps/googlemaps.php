
<?php
	class Googlemaps_obj
	{
            public $nome_posicao_plugin;
	}


	class Googlemaps extends Base
	{

                public $icone = "https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcRTXSfqHH4K7eboQO6xQnW-bulqdXQbZyRyPIDnpSlG8DuQ5ZHsPrmv1ue7";

                function __construct()
                {	
                    $this->montar_googlemaps();
                }

                public function montar_googlemaps()
                {

                    $campos_valores = array("`nome` varchar(255) NOT NULL","`id_pagina` int(11) NOT NULL","`posicao` varchar(200) NOT NULL DEFAULT ''","`cep` varchar(255) NOT NULL","`endereco` text NOT NULL","`codigo` text NOT NULL");
                    $this->sql_criar_tabela('googlemaps', $campos_valores);
                }

                public function html_plugin()
                {
                    $html = 'http://maps.googleapis.com/maps/api/staticmap?center=Maringa,+PR&zoom=8&scale=1&size=600x300&maptype=roadmap&sensor=false&format=png&visual_refresh=true&markers=size:small%7Ccolor:yellow%7CMaringa,+PR';
                    return $html; 
                }
                

                private  function define_insere_googlemaps($posicao)
                {

                    $campos = array('ID','codigo');

                    $where = array('posicao' => $posicao);

                    $plugin_googlemaps = $this->sql_select_otimizado('googlemaps',$campos,$where);

                     if( count($plugin_googlemaps) <= 0  )
                     {

                            $campos_googlemaps =  array('posicao' => $posicao,'codigo'=>$this->html_plugin(),'id_pagina'=>self::$id_pagina);

                            $retorno_id_plugin = $this->sql_insert_otimizado('googlemaps',$campos_googlemaps);

                            $ultimo_id = $retorno_id_plugin;
                            

                            $where = array('ID' => $ultimo_id);

                           $plugin_googlemaps = $this->sql_select_otimizado('googlemaps',$campos,$where);

                            return $plugin_googlemaps[0]['codigo'];

                     }
                     else
                     {
                            $gmaps = $plugin_googlemaps[0];

                            return $gmaps['codigo'];
                     }	

                }
                

                
                function backend($id,$obj = null)
                {
     
                     $formularios =  new Formularios();

                     if(!empty($obj))
                     {
                         foreach($obj as $key => $value)
                         {
                             $campos[$key] = $value;    
                         }
                         
                         $where = array('ID'=>$id);
                         
                         $this->sql_update_otimizado('googlemaps', $campos,$where);
                         
                         echo self::menssagem("<strong>Atualizado</strong> com sucesso !", 'sucesso');
                     }

                     $campos = array('ID','posicao','cep','endereco','codigo');
                     
                     $where = array('ID' => $id);

                     $select = $this->sql_select_otimizado('googlemaps',$campos,$where); 
                     
                     $objx = new stdClass();
                     
                     $objx->codigo = array('name'=>'codigo','label'=>'Codigo','tipo'=>'textarea','mask'=>'ttt','maxlenth'=>'','opcoes_json','options','ordem'=>3,'value'=>$select[0]['codigo']);
                     $objx->cep = array('name'=>'cep','label'=>'cep','tipo'=>'input','mask'=>'ttt','maxlenth'=>'','opcoes_json','options','ordem'=>1,'value'=>$select[0]['cep']);
                     $objx->endereco = array('name'=>'endereco','label'=>'endereco','tipo'=>'input','mask'=>'ttt','maxlenth'=>'','opcoes_json','options','ordem'=>2,'value'=>$select[0]['endereco']);
                     
                     $html = $formularios->formulario_template($objx);
                     
                     return $html;
                 }     

                /* TODOS */
                public function plugin_menu()
                {
                        return false;
                }
                /* TODOS */
                public function lista()
                {

                    $array = array();

                   
                    
                    $sql = mysql_query("SELECT * FROM googlemaps WHERE id_pagina='".self::$id_pagina."'");

                    while( $row1 = mysql_fetch_array($sql) )
                    {
                        $obj = new obj_base();
                        $obj->id = $row1['ID'];
                        $obj->posicao = $row1['posicao'];
                        $obj->editar = 'googlemaps';
                        $obj->icone = $this->icone;
                        $obj->prev = 'Plugin google maps';
                        $array[] = $obj;   
                    } 
                    return $array;
                }

                /* TODOS */
                public function front($obj)
                {			
                        $nome = $obj->nome_posicao_plugin;

                        $this->define_insere_googlemaps($nome);
                }



	}


?>
