<?php
	require_once './class/Principal.class.php';

	//INCLUI MODULO FIXO TEXTOS
	include ('./modulos/textos/textos.php');

	include ('./modulos/imagem/imagem.php');

	//INCLUIR BASE
	include './class/Base.class.php';


  $principal = new Principal();

  $base = new Base();

?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>#SAGLOMER</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="./bootstrap-3.1.1/css/bootstrap.css">

    <!-- Custom styles for this template -->
    <link href="./bootstrap-3.1.1/css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">#SGLOMER</a>
        </div>
      </div>
    </div>

    <div class="container-fluid">

      <div class="row">
        
        <div class="col-sm-3 col-md-2 sidebar">

          <ul class="nav nav-sidebar">
            <li class="active"><a href="#"><i class="glyphicon glyphicon-star"></i> Configurações</a></li>
          </ul>

          <ul class="nav nav-sidebar">
            <li><a><i class="glyphicon glyphicon-edit"></i> <strong>PAGINAS</strong></a></li>
            <li class="divider"></li>

            <?php  
              $paginas = $base::lista_paginas_ativas(); 
              foreach ($paginas as $pagina) 
              {
                echo "<li><a href='#".$pagina['ID']."'>".$pagina['nome']."</a></li>";
              }
            ?>
            
          </ul>


        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

          <?php include 'configuracoes.php' ?>

        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="./bootstrap-3.1.1/js/bootstrap.min.js"></script>
    <script src="./bootstrap-3.1.1/js/docs.min.js"></script>
  </body>
</html>
