<h1>EM DESENVOLVIMENTO TEXTOS - GEROU TABELA "textos"</h1>
<?php
    class Tipo_textos
    {
        public $ID;        
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
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Table with abuse reports' AUTO_INCREMENT=1;";	

           function __construct()
           { 
            
           }

            /* MONTAR */
            function montar()
            {       
                $this->slq_comando($this->sql);
            }




            function mod_texto( $id_pagina, $posicao, $tipo = 0, $texto = null)
            {
                //verifica se o bnaco existe
                $this->montar();

                //verifica se os campos nao existem ou os ou os cria
                if( !$this->slq_comando_select("SELECT * FROM textos WHERE id_pagina='$id_pagina' AND posicao='$posicao' AND tipo='$tipo' ", 1 ) )
                {
                    $string ="INSERT INTO `textos` (`ID`, `id_pagina`, `posicao`, `tipo`, `texto`) VALUES (NULL, '$id_pagina', '$posicao', '$tipo', '$texto')";

                    $ultimo_id = $this->slq_comando_insert($string);

                    $retorno_dados = $this->slq_comando_select("SELECT * FROM textos WHERE ID='$ultimo_id'", 0 );
                }
                else
                {
                    $retorno_dados = $this->slq_comando_select("SELECT * FROM textos WHERE id_pagina='$id_pagina' AND posicao='$posicao' AND tipo='$tipo' ", false );
                }    

                return $retorno_dados;

            }


            function mod_texto_update($id_texto,$texto)
            {
                $this->slq_comando("UPDATE textos SET texto='$texto' WHERE ID ='$ultimo_id'"); 
            }



            function mod_texto_editar($dados)
            {
                foreach($dados as $chave =>$val) 
                { 
        
                   $this->mod_texto_update($chave,$val);
                }
            }


/*            function mod_text_lista($id_pagina)
            {
                $retorno_dados = $this->slq_comando_select("SELECT * FROM textos WHERE id_pagina='$id_pagina'", 0 );

                return $retorno_dados; 
            }
*/

            function mod_text_lista($id_pagina)
            {


                $array = array();

                $sql = mysql_query("SELECT * FROM textos WHERE id_pagina='$id_pagina'");

                while($row = mysql_fetch_array($sql))
                {
                    $obj = new Tipo_textos();

                    $obj->ID = $row["ID"];
                    $obj->texto = $row["texto"];

                    $array[] = $obj;
                }

                return $array;
    
	       }

}

$bol = new Textos();

$dados = array(
    '1'=>'wqewqewq2',
    '2'=>'rrrrr',
    '3'=>'yyuyuyu'
    );

//$bol->mod_texto_editar($dados);






 





// 0 0 0 0 0 0 0 FRONT 0 0 0 0 0 0 0 0 
//esta eh a parte onde eh posicionado no site 
$a = $bol->mod_texto('23','missao','1','Missao');
$b = $bol->mod_texto('23','missao','0','');
$c = $bol->mod_texto('23','valores','1','Valores');
$d = $bol->mod_texto('23','valores','0','');


echo"<pre>";
//print_r($a);
echo"</pre>";

echo"<pre>";
//print_r($b);
echo"</pre>";

echo"<pre>";
//print_r($d);
echo"</pre>";

echo"<pre>";
//print_r($c);
echo"</pre>";


	
?>