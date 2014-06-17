<?php
  require_once './class/Principal.class.php';

  $diretorio_total = Principal::caminho_diretorio();

  Principal::cria_diretorios_upload();

  include ('modulos/textos/textos.php');


  //include ('modulos/formularios/formularios.php');

  Principal::montar_plugins();

  $sql_pk = mysql_query("SELECT * FROM plugins");
  

  while ($plugin = mysql_fetch_array($sql_pk )) 
  {
      define( "_" . strtoupper($plugin['nome']) . "_" , $plugin['status']);
  }

  if(Principal::se_plugin('social'))
  {
    include('plugins/social/social.php');
  }

  if(Principal::se_plugin('buscainterna'))
  {
    include('plugins/buscainterna/buscainterna.php');
  }

  if(Principal::se_plugin('googlemaps'))
  {
    include('plugins/googlemaps/googlemaps.php');
  }

  //ID DA INDEX
  $id_desta_pagina = 15;
?>

<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
	<title>FRONT</title>
</head>
<body>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<link href="http://balakumar.in/lab/git-theme/stylesheets/style.css" rel="stylesheet" media="all">
<link href="http://balakumar.in/lab/git-theme/stylesheets/fonts.css" rel="stylesheet" media="all">
<link href="http://balakumar.in/lab/git-theme/stylesheets/animate.css" rel="stylesheet" media="all">
<link rel="stylesheet" type="text/css" href="paginas_01/css/style.css">
  
<header> <a href="#" class="fork">fork me</a>
  <div class="row">
    <div class="head">
      <h1><a href="#">SGLOMER</a></h1>
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
  <div class="row">
    <h1>HOME</h1>
    <?php 
    $id_desta_pagina = 20;
    include "home.php"; 
    ?>
  </div>

  <div class="row">
    <h1>EMPRESA</h1>
    <?php 
    $id_desta_pagina = 30;
    include "empresa.php"; 
    ?>
 </div>

  <div class="row">
    <h1>CONTATO</h1>
    <?php 
    $id_desta_pagina = 40;
    include "contato.php"; 
    ?>
  </div>

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
