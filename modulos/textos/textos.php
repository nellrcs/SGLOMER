<?php
    class Textos extends Base
    {

        public $icone = "http://www.mistersabido.com/wp-content/uploads/2014/05/icone-texto.png";

        //Constroi a classe Textos
            function __construct()
            {
                $this->montar_textos();

            }

            //Funcao que cria o banco de dados se ele não existir.
            function montar_textos()
            {
               $campos_valores =  array("`id_pagina` int(11) NOT NULL","`posicao` varchar(200) NOT NULL DEFAULT ''", "`tipo` int(11) NOT NULL DEFAULT '0'","`texto` text NOT NULL","`traducao` text");        
               $this->sql_criar_tabela('textos', $campos_valores);
            }


            //funcao que cria textos para o pagina/local
           function preciso_texto_aqui($posicao, $tipo = 0, $texto = null, $traducao = null)
            {

                 $this->montar_textos();

                //campos que o select deve trazer
                $campos = array('texto');

                //campos que o select deve filtar
                $where = array('id_pagina' => self::$id_pagina,'posicao'=> $posicao,'tipo'=>$tipo);

                //funcao que recebe *( nome da tabela , campos trazidos , campos filtrados )
                $select_texto = $this->sql_select_otimizado('textos',$campos,$where);


                //verifica se os campos nao existem ou os ou os cria
                if( count($select_texto) <= 0 )
                {

                    $campos_textos = array(
                        'id_pagina' =>self::$id_pagina,
                        'posicao' =>$posicao,
                        'tipo' =>$tipo,
                        'texto' =>$texto,
                        'traducao' =>$traducao,

                        );

                    $insere_textos =  $this->sql_insert_otimizado('textos',$campos_textos);

                    $ultimo_id = $insere_textos;

                    $campos = array('texto');

                    $where = array('ID' => $ultimo_id);

                    $select_texto = $this->sql_select_otimizado('textos',$campos,$where);

                }
                else
                {
                    $select_texto = $this->sql_select_otimizado('textos',$campos,$where);
                }

                return $select_texto[0]['texto'];

            }


            //passando o id e o texto ele faz update
            private function mod_texto_update($id_texto,$texto)
            {
                $this->sql_comando("UPDATE textos SET texto='".addslashes($texto)."' WHERE ID ='$id_texto'");
            }


            //esta funcao substituira o post
//            private function mod_texto_editar($dados)
//            {
//                foreach($dados as $chave =>$val)
//                {
//                   $this->mod_texto_update($chave,$val);
//                }
//            }

            //mod texto lista textos
            public function lista()
            {
                
                $array = array();

                $sql = mysql_query("SELECT * FROM textos WHERE id_pagina='".self::$id_pagina."' GROUP BY posicao");

                while( $row1 = mysql_fetch_array($sql) )
                {
                    $obj = new obj_base();
                    $obj->id = $row1['ID'];
                    $obj->posicao = $row1['posicao'];
                    $obj->editar = 'textos';
                    $obj->icone = $this->icone;
                    $obj->prev = $row1['texto'];
                    $array[] = $obj;   
                } 
                return $array;

           }

           //CRIA O CAMPO DO FORMULARIO PARA EDICAO
           private static function campo_form($select_texto2)
           {
                $obj = new stdClass();

                $Formularios =  new Formularios();

                $contador = 0;

                foreach ($select_texto2 as $select)
                {
                  $contador++;

                  $n = 'n'.$select["ID"];

                   switch ($select["tipo"])
                   {
                       case '0': $obj->$n = array('name'=>$select["ID"],'label'=>'','tipo'=>'textarea','mask'=>'','maxlenth'=>'','opcoes_json','options','ordem'=>$contador,'value'=>$select["texto"]); break;

                       case '1': $obj->$n = array('name'=>$select["ID"],'label'=>'','tipo'=>'input','mask'=>'','maxlenth'=>'100','opcoes_json','options','ordem'=>$contador,'value'=>$select["texto"]); break;

                       case '2': $obj->$n = array('name'=>$select["ID"],'label'=>'','tipo'=>'input','mask'=>'','maxlenth'=>'100','opcoes_json','options','ordem'=>$contador,'value'=>$select["texto"]); break;

                       case '3': $obj->$n = array('name'=>$select["ID"],'label'=>'','tipo'=>'hidden','mask'=>'','maxlenth'=>'100','opcoes_json','options','ordem'=>$contador,'value'=>$select["texto"]); break;

                       default: $obj->$n = array('name'=>$select["ID"],'label'=>'','tipo'=>'input','mask'=>'','maxlenth'=>'100','opcoes_json','options','ordem'=>$contador,'value'=>$select["texto"]); break;
                   }

                }

              return $Formularios->formulario_template($obj);

           }


           function backend($id_texto,$obj = null)
           {
                $id_pagina = self::$id_pagina;

                if(!empty($obj))
                {
                    foreach($obj as $key => $value)
                    {
                        $this->mod_texto_update($key,$value);
                    }
                    
                    echo self::menssagem("<strong>Atualizado</strong> com sucesso !", 'sucesso');
                }

                $campos = array('posicao');

                $where = array('ID' => $id_texto);

                $select_texto = $this->sql_select_otimizado('textos',$campos,$where);


                $campos2 = array('texto','ID','posicao','tipo');

                $where2 = array('posicao' => $select_texto[0]['posicao']);

                $select_texto2 = $this->sql_select_otimizado('textos',$campos2,$where2);

                $formulario = self::campo_form($select_texto2);

                return $formulario;
            }

}


?>

