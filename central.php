

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

<div class="btn-toolbar" role="toolbar">
      <div class="btn-group">
        <a class="btn btn-primary btn-lg filter" href="#"><span class="glyphicon glyphicon-home"></span></a>
        <a class="btn btn-primary btn-lg filter" data-filter="all"><span class="glyphicon glyphicon-asterisk"></span></a>
        <a class="btn btn-primary btn-lg filter" data-filter=".plugins"><span class="glyphicon glyphicon-gift"></span></a>
        <a class="btn btn-primary btn-lg filter" data-filter=".textos"><span class="glyphicon glyphicon-font"></span></a>
        <a class="btn btn-primary btn-lg filter" data-filter=".imagens"><span class="glyphicon glyphicon-picture"></span></a>
        <a class="btn btn-primary btn-lg sort" data-sort="default"><span class="glyphicon glyphicon-refresh"></span></a>
        <a class="btn btn-primary btn-lg sort" data-sort="myorder:asc"><span class="glyphicon glyphicon-hand-up"></span></a>
        <a class="btn btn-primary btn-lg sort" data-sort="myorder:desc"><span class="glyphicon glyphicon-hand-down"></span></a>
        <a class="btn btn-primary btn-lg sort" data-sort="random"><span class="glyphicon glyphicon-question-sign"></span></a>
      </div>
    </div>
<br>



<?php
      function item_lista_html($nome,$id,$modulo,$chave,$icone='http://placehold.it/120x120',$prev='')
      {


          $html = "<div class='mix $chave' data-myorder='$id'>";
            $html .= "<div class='panel panel-default'>";
              $html .= "<div class='panel-heading'><span class='badge'>42</span><strong class='text-info'>$prev</strong>";
              $html .= "</div>";

              $html .= "<div class='panel-body'>";

                $html .= "<div class='col-sm-6 col-md-4'>";
                  $html .= "<a href='editar/$modulo/$id.html' class='thumbnail'>";
                    $html .= "<img src='$icone' alt='...' width='120' height='120'>";
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
              

              echo item_lista_html($d->posicao,$d->id,$d->editar,$chave,$d->icone,$d->prev);


            }
          }
        }
      }
      echo "</div>";

?>
