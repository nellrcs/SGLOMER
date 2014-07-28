


<?php
      function item_lista_html($nome,$id,$modulo)
      {

        $html =  "<ol class='breadcrumb'>";
        $html .=     "<li class='active'>Editar</li>";
        $html .=      "<li><a href='editar/$modulo/$id.html'>EDITAR</a></li>";
        $html .=     "<li class='navbar-right'><strong>$nome</strong></li>";
        $html .=   "</ol>";
        return $html;
      };

      $base::$id_pagina = $url[1];

      $dados_pagina = $base::back_end_lista();

      foreach($dados_pagina as $dados)
      {
        foreach ($dados as $chave => $dado)
        {

          if($dado)
          {
            echo "<h2>".ucfirst($chave)."</h2>";

            foreach ($dado as $d)
            {
              echo item_lista_html($d['posicao'],$d['ID'],$d['editar']);
            }
          }
        }
      }


?>
