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

            public $sql = "CREATE TABLE IF NOT EXISTS `textos` (
                      `ID` int(11) NOT NULL AUTO_INCREMENT,
                      `id_pagina` int(11) NOT NULL,
                      `posicao` varchar(200) NOT NULL DEFAULT '',
                      `tipo` int(11) NOT NULL DEFAULT '0',
                      `texto` text NOT NULL,
                      `traducao` text,
                      PRIMARY KEY (`ID`)
                    ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Table with abuse reports' AUTO_INCREMENT=1;";	

           function __construct()
           { 
                
           }

            /* MONTAR */
            function montar()
            {       
                $this->slq_comando($this->sql);
            }


            function mod_texto( $id_pagina, $posicao, $tipo = 0, $texto = null, $traducao = null)
            {
                //verifica se o banco existe
                $this->montar();

                $campos_select = array('ID','id_pagina','posicao','tipo','texto','traducao');

                $where = array('id_pagina'=>$id_pagina,'posicao'=>$posicao,'tipo'=>$tipo);  

                $select_textos = $this->sql_select_otimizado('textos',$campos_select,$where);

                //verifica se os campos nao existem ou o os cria
                if(count($select_textos) <= 0) 
                {
                    

                    $campos_inserir = array('id_pagina' => $id_pagina,'posicao'=>$posicao,'tipo'=>$tipo,'texto'=>addslashes($texto),'traducao'=>$traducao);
                
                    $insere_textos = $this->sql_insert_otimizado('textos',$campos_inserir);

                    $where = array('ID'=>$id_pagina);

                    $campos = array('texto');

                    $retorno_textos = $this->sql_select_otimizado('textos',$campos,$where);

                }
                else
                {
                    $retorno_textos = $select_textos;
                }    


                return $retorno_textos[0]['texto'];

            }



            function remove_mod_texto( $id_pagina, $posicao, $tipo = 0, $texto = null, $traducao = null)
            {
                //verifica se o bnaco existe
                $this->montar();

                $campos_select = array('ID','id_pagina','posicao','tipo','texto','traducao');

                $where = array('id_pagina'=>$id_pagina,'posicao'=>$posicao,'tipo'=>$tipo);  

                $select_textos = $this->sql_select_otimizado('textos',$campos_select,$where);


                //verifica se os campos nao existem ou os ou os cria
                if( count($select_textos) <= 0 )
                {
                    //PROGRAMAR.....
                }
                else
                {
                    //PROGRAMR.....
                }    

            }


            function mod_texto_update($id_texto,$texto)
            {
                
                $campos = array('texto' => addslashes($texto) );

                $where = array('ID' => $id_texto);

                $this->sql_updadate_otimizado('textos',$campos,$where);

            }

            function mod_texto_editar($dados)
            {
                foreach($dados as $chave =>$val) 
                { 
                   $this->mod_texto_update($chave,$val);
                }
            }


            function mod_text_lista($id_pagina,$posicao)
            {

                $array = array();

                $sql = mysql_query("SELECT * FROM textos WHERE id_pagina='$id_pagina' AND posicao='$posicao' ");

                while($row = mysql_fetch_array($sql))
                {
                    $obj = new Tipo_textos();

                    $obj->id = $row["ID"];

                    $obj->texto = $row["texto"];

                    $obj->tipo = $row["tipo"];

                    $array[] = $obj;
                }

                return $array;

	       }


           function campo_form($tipo,$value,$name)
           {

                switch ($tipo) 
                {
                    case '0': $campo = "<textarea name='$name' cols='30' rows='10'>$value</textarea>"; break;

                    case '1': $campo = "<input type='text' value='$value' name='$name'>"; break;

                    case '2': $campo = "Url:<input type='text' value='$value' name='$name'>"; break;

                    default: $campo = "<input type='text' value='$value' name='$name'>"; break;
                }
                return $campo;

           }


           function mod_texto_backend($id_pagina,$ini_pocicao = null)
           {

                if(!empty($_POST))
                {   
                    foreach($_POST as $key => $value) 
                    {
                        $this->mod_texto_update($key,$value);
                    }
                }  




                $sql = mysql_query("SELECT * FROM textos WHERE id_pagina='$id_pagina' GROUP BY posicao");


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
                }

                
            }   


            function traducao($id_do_texto)
            {
                //le o jason com as traduçoes e altera   
                //ainda falta definir habilita e desabilita
            }
}


$bol = new Textos(23);

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

