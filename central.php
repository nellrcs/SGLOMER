

<script type="text/javascript" src="http://cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js"></script>

<style type="text/css">
#mix-galeria .mix{
  display: none;
  background: #red;
}
</style>
<script type="text/javascript">
  $(function(){
    // Instantiate MixItUp:

    $('#mix-galeria').mixItUp({
      layout: {
        /*display: 'block'*/
        containerClass: 'list'
      }
    });

  });

</script>

<ul class="nav nav-pills">
  <li class="active"><a href="#">Home</a></li>
  <li><a class="filter" data-filter="all">Todos</a></li>
  <li><a class="filter" data-filter=".plugins">Plugins</a></li>
  <li><a class="filter" data-filter=".textos">Textos</a></li>
  <li><a class="sort" data-sort="default">Default</a></li>
  <li><a class="sort" data-sort="myorder:asc">Crescente</a></li>
  <li><a class="sort" data-sort="myorder:desc">Decrescente</a></li>
  <li><a class="sort" data-sort="random">Radomico</a></li>
</ul>
<br>





<?php
      function item_lista_html($nome,$id,$modulo,$chave)
      {


          $html = "<div class='mix $chave' data-myorder='$id'>";
            $html .= "<div class='panel panel-default'>";
              $html .= "<div class='panel-heading'><strong class='text-info'>$nome</strong>";
              $html .= "</div>";

              $html .= "<div class='panel-body'>";

                $html .= "<div class='col-sm-6 col-md-4'>";
                  $html .= "<a href='editar/$modulo/$id.html' class='thumbnail'>";
                    $html .= "<img src='http://placehold.it/120x120' alt='...'>";
                   $html .= "</a>";
                $html .= "</div>";

                $html .= "<div class='col-sm-6 col-md-4'>";
                  $html .= "<a type='button' href='editar/$modulo/$id.html' class='btn btn-default navbar-btn'>Editar</a>";
                $html .= "</div>";

              $html .= "</div>";
            $html .= "</div> ";
          $html .= "</div> ";


        return $html;
      };

      $base::$id_pagina = $url[1];

      $dados_pagina = $base::back_end_lista();
      echo "<div id='mix-galeria'>";
      foreach($dados_pagina as $dados)
      {
        foreach ($dados as $chave => $dado)
        {

          if($dado)
          {
            //echo "<h2>".ucfirst($chave)."</h2>";

            foreach ($dado as $d)
            {
              

              echo item_lista_html($d['posicao'],$d['ID'],$d['editar'],$chave);

              

            }
          }
        }
      }
      echo "</div>";

?>
