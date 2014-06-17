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
                //verifica se o bnaco existe
                $this->montar();

                //verifica se os campos nao existem ou os ou os cria
                if( !$this->slq_comando_select("SELECT * FROM textos WHERE id_pagina='$id_pagina' AND posicao='$posicao' AND tipo='$tipo' ", 1 ) )
                {
                    $string ="INSERT INTO `textos` (`ID`, `id_pagina`, `posicao`, `tipo`, `texto`, `traducao`) VALUES (NULL, '$id_pagina', '$posicao', '$tipo', '$texto','$traducao' )";

                    $ultimo_id = $this->slq_comando_insert($string);

                    $retorno_dados = $this->slq_comando_select("SELECT * FROM textos WHERE ID='$ultimo_id'", 0 );
                }
                else
                {
                    $retorno_dados = $this->slq_comando_select("SELECT * FROM textos WHERE id_pagina='$id_pagina' AND posicao='$posicao' AND tipo='$tipo' ", false );
                }    

                return $retorno_dados['texto'];

            }



            function remove_mod_texto( $id_pagina, $posicao, $tipo = 0, $texto = null, $traducao = null)
            {
                //verifica se o bnaco existe
                $this->montar();

                //verifica se os campos nao existem ou os ou os cria
                if( !$this->slq_comando_select("SELECT * FROM textos WHERE id_pagina='$id_pagina' AND posicao='$posicao' AND tipo='$tipo' ", 1 ) )
                {
                    $string = "SELECT * FROM textos WHERE id_pagina='$id_pagina' AND posicao='$posicao' AND tipo='$tipo' ";

                    $this->slq_comando($string);

                    return true;
                }
                else
                {
                    return true;
                }    

            }



            function mod_texto_update($id_texto,$texto)
            {
                $this->slq_comando("UPDATE textos SET texto='$texto' WHERE ID ='$id_texto'"); 
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
                  echo "<fieldset>";
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
                   echo "</fieldset>";
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

