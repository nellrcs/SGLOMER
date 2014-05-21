<?php

class lorem extends Principal
{		
        public $titulo;
        
        public $texto; 
            
    
 
        function cria_banco()
        {

        }

        public static function le_banco()
        {
            $obj = new lorem();
            
            $obj->titulo = "PPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPP";
            
            $obj->texto = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi, aspernatur, est, et, ratione pariatur quo deserunt veritatis tenetur mollitia iste repellat alias. Consequuntur, illo laborum architecto delectus sint nihil id!";
            
            return $obj;
        }


 
        
        
}


$a = new lorem();
$b = $a->le_banco();

$tpl->NOME = $b->titulo;
$tpl->TEXTO = $b->texto;


  ?>