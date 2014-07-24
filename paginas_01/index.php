<?php
  require_once './class/Principal.class.php';

  //INCLUI MODULO FIXO TEXTOS
  include ('./modulos/textos/textos.php');

  include ('./modulos/formularios/formularios.php');

  include ('./modulos/imagem/imagem.php');

  //INCLUI MODULO
  include ('./modulos/itens/itens.php');

  //INCLUIR BASE
  include './class/Base.class.php';


  $principal = new Principal();

  $base = new Base();

?>

<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
	<title>FRONT</title>
</head>
<body>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="http://malsup.github.io/jquery.cycle.all.js"></script>
<link href="http://balakumar.in/lab/git-theme/stylesheets/style.css" rel="stylesheet" media="all">
<link href="http://balakumar.in/lab/git-theme/stylesheets/fonts.css" rel="stylesheet" media="all">
<link href="http://balakumar.in/lab/git-theme/stylesheets/animate.css" rel="stylesheet" media="all">
<link rel="stylesheet" type="text/css" href="paginas_01/css/style.css">
  

<header> <a href="#" class="fork">fork me</a>
  <div class="row">
    <div class="head">
        <h1><a href="#"></a></h1>
      <h4>The best theme you can now use with Github !</h4>

    </div>
  </div>
</header>
<!--header end-->
<div class="sub-nav"> <a href="#" class="latest">Download Ultima versao 1.4</a><span id="logo"></span> </div>
<div id="wrapper"> <nav>
  <ul>
  </ul>
  </nav> 

  <section>
    <?php  
    $paginas = $base::lista_paginas_ativas(); 
    foreach ($paginas as $pagina) 
    {
      $base::$id_pagina = $pagina['ID']; 
      include $pagina['nome'].'.php';
    }
    ?>
  </section>
</div>
<footer class="clearfix">
  <div class="row">
    <p>Gitflat theme, Hosted on <a href="#" class="link">GitHub Pages</a>. Project maintained by <a href="#" class="link">@Balakumar</a></p>
  </div>
</footer>
<script src="http://balakumar.in/lab/git-theme/javascripts/jquery-1.9.1.min.js" type="text/javascript"></script> 
<script src="http://balakumar.in/lab/git-theme/javascripts/jquery.nicescroll.min.js"></script> 
<script src="http://balakumar.in/lab/git-theme/javascripts/main.js" type="text/javascript"></script> 
<!--[if !IE]><script>fixScale(document);</script><!--<![endif]-->
 
</body>
</html>
