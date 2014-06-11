<h1>EM DESENVOLVIMENTO TEXTOS - GEROU TABELA "textos"</h1>
<?php
	class form_m
	{		
  
                public $type;
                public $value; 	
                public $alt; 	
                public $name; 	
                public $id; 
                
            
                function item($campo = null, $val = null)
                {
                    if($val == null)
                    {
                        $ed = "{$campo}='{$val}'";
                        return $ed;
                    }    
                    else
                    {
                        return false;
                    }
                }
           
                
                function input($obj)
                {
                    return $html = "<input ".item($obj->name)." >";
                }

                
               
	}


	class Textos extends Principal
	{

            private $sql = "CREATE TABLE IF NOT EXISTS `textos` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `tipo` varchar(200) NOT NULL DEFAULT '0',
                      `texto` text NOT NULL,
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Table with abuse reports' AUTO_INCREMENT=1;";	

           function __construct(){ }

            function montar()
            {
                    $ll = new Textos();
                    $ll->criar_table($ll->sql);
            }

            /* INSERIR */
            function inserir()
            {       	
                    //formulario->input
            }

            /* LER */
            function ler()
            {
                    //<htm>texto</html>
            }

            /* LISTA */
            function listar()
            {

            }

            /* EDITAR */
            function editar()
            {

            }
             
            function andre_biba()
            {
                
                
            }
        
	}

	$form = new form_m();
        
        $obj = $form->name = "campopop";

        echo $form->input($obj);

	
?>