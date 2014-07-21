<?php
    class Tipo_textos
    {
        public $id;        
        public $id_pagina;      
        public $posicao;      
        public $tipo;      
        public $texto;      
    }

    class Textos extends Principal
    {


        public $id_pagina;

        //Constroi a classe Textos
        function __construct($id_pagina = null) 
        {

            $this->id_pagina = $id_pagina;

            $this->montar_textos(); 

        }

            //Funcao que cria o banco de dados se ele não existir.
            function montar_textos()
            {       
               
               $sql = "CREATE TABLE IF NOT EXISTS `textos` (
                      `ID` int(11) NOT NULL AUTO_INCREMENT,
                      `id_pagina` int(11) NOT NULL,
                      `posicao` varchar(200) NOT NULL DEFAULT '',
                      `tipo` int(11) NOT NULL DEFAULT '0',
                      `texto` text NOT NULL,
                      `traducao` text,
                      PRIMARY KEY (`ID`)
                    ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Table with abuse reports' AUTO_INCREMENT=1;"; 

                $this->sql_comando($sql);
            }


            //funcao que cria textos para o pagina/local
           function preciso_texto_aqui($posicao, $tipo = 0, $texto = null, $traducao = null)
            {
  
                 $this->montar_textos();   

                //campos que o select deve trazer
                $campos = array('texto');

                //campos que o select deve filtar
                $where = array('id_pagina' => $this->id_pagina,'posicao'=> $posicao,'tipo'=>$tipo);

                //funcao que recebe *( nome da tabela , campos trazidos , campos filtrados )
                $select_texto = $this->sql_select_otimizado('textos',$campos,$where);


                //verifica se os campos nao existem ou os ou os cria
                if( count($select_texto) <= 0 )
                {

                    $campos_textos = array(
                        'id_pagina' =>$this->id_pagina, 
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
            private function mod_texto_editar($dados)
            {
                foreach($dados as $chave =>$val) 
                { 
                   $this->mod_texto_update($chave,$val);
                }
            }

            //lista plugins que usam textos na pagina
            public function mod_text_lista_plugin($prefixo_plugin)
            {

                $array = array();

                $sql = mysql_query("SELECT * FROM textos WHERE id_pagina='$this->id_pagina' GROUP BY posicao");

                while( $row1 = mysql_fetch_array($sql) )
                {
                    $pos = explode('_', $row1['posicao']);

                    $novo = $pos[0].'_'.$pos[1];

                    if($prefixo_plugin == $novo)
                    {
                       $array[] = array('ID'=>$row1['ID'],'posicao'=>$row1['posicao'],'editar'=>'textos'); 
                    }   
                    
                }

                return $array;
           }


            //mod texto lista textos
            public function mod_text_lista()
            {

                $array = array();

                $sql = mysql_query("SELECT * FROM textos WHERE id_pagina='$this->id_pagina' GROUP BY posicao");

                while( $row1 = mysql_fetch_array($sql) )
                {
                    $pos = explode('_', $row1['posicao']);

                    $novo = $pos[0].'_';

                    if("PLUGIN_" != $novo)
                    {
                       $array[] = array('ID'=>$row1['ID'],'posicao'=>$row1['posicao'],'editar'=>'textos'); 
                    }    
                }

                return $array;

           }


           //CRIA O CAMPO DO FORMULARIO PARA EDICAO
           function campo_form($tipo,$value,$name)
           {
                switch ($tipo) 
                {
                    case '0': $campo = "<textarea name='$name' cols='30' rows='10'>$value</textarea>"; break;

                    case '1': $campo = "<input type='text' value='$value' name='$name'>"; break;

                    case '2': $campo = "<input type='text' value='$value' name='$name'>"; break;

                    case '3': $campo = "<input type='hidden' value='$value' name='$name'>"; break;

                    default: $campo = "<input type='text' value='$value' name='$name'>"; break;
                }
                return $campo;
           }


           function backend($id_texto,$obj = null)
           {
                $id_pagina = $this->id_pagina;

                if(!empty($obj))
                {   
                    foreach($obj as $key => $value) 
                    {
                        $this->mod_texto_update($key,$value);
                    }
                }  



                $campos = array('posicao');

                $where = array('ID' => $id_texto);

                $select_texto = $this->sql_select_otimizado('textos',$campos,$where);


                $campos2 = array('texto','ID','posicao','tipo');

                $where2 = array('posicao' => $select_texto[0]['posicao']);

                $select_texto2 = $this->sql_select_otimizado('textos',$campos2,$where2);


                foreach ($select_texto2 as $select) 
                {
                   echo $this->campo_form($select["tipo"],$select["texto"],$select["ID"]);
                   echo "<br>";
                }



/*                $sql = mysql_query("SELECT * FROM textos WHERE id_pagina='$id_pagina' GROUP BY posicao");

                while( $row1 = mysql_fetch_array($sql) )
                {  
                  $sql2 = mysql_query("SELECT * FROM textos WHERE posicao='".$row1['posicao']."' ORDER BY tipo DESC");
                    while($row = mysql_fetch_array($sql2))
                    {

                        if($ini_pocicao)
                        {
                            $pos = explode('_', $row1['posicao']);

                            $novo = $pos[0].'_'.$pos[1];

                            if($novo == $ini_pocicao)
                            {
                                echo $this->campo_form($row["tipo"],$row["texto"],$row["ID"]);

                                echo "<br>";  
                            }    

                        }
                        else
                        {    

                            echo $this->campo_form($row["tipo"],$row["texto"],$row["ID"]);

                            echo "<br>";    
                        }                    
                    }
                }*/

                
            }   


            function traducao($id_do_texto)
            {
                 //le o jason com as traduçoes e altera   
                //ainda falta definir habilita e desabilita
            }
}


//////////////// + F R O N T + /////////////////////////////
//  este echo cria e mostra o campo no front do site     //
//                                                      //
///////////mod_texto('id da pagina','nome do local','tipos[0,1,2]','texto passado')/////
//echo $bol->mod_texto('23','CAMPO_MENU_1','1','String','{"pt":"texto"}');///
//---------------------------------------------------////


///////////////// + B A C K + ///////////////////////
//                                                //
// esta funcao cria um formulario                //
//  com os campos para serem editados.          //
//                                             //
//////mod_texto_backend('id da pagina')//////////////
//$bol->mod_texto_backend('23');//////////////////////
//---------------------------------------------////

?>

