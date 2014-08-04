<?php
include './class/configura.php';

include './class/Conexao.class.php';

include './class/Principal.class.php';

include './class/Base.class.php';

include './modulos/textos/textos.php';

include './modulos/formularios/formularios.php';

include './modulos/itens/itens.php';
    
    
$principal = new Principal();

$textos = new Textos();

$base =  new Base();




if(isset($_GET['Secao'])){$Sec = $_GET['Secao'];}else{$Sec = "";}
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>#SGLOMER</title>
    
    <base href="http://<?php echo BASE_SITE; ?>">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="./bootstrap-3.1.1/css/bootstrap.css">

    <!-- Custom styles for this template -->
    <link href="./bootstrap-3.1.1/css/dashboard.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


    <link rel="stylesheet" href="./bootstrap-3.1.1/css/dropzone.css">
    <link rel="stylesheet" href="./bootstrap-3.1.1/css/basic.css">
    <script src="./bootstrap-3.1.1/js/bootstrap.min.js"></script>
    <script src="./bootstrap-3.1.1/js/jquery-ui.min.js"></script>

  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" />
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'> 

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
          <a class="navbar-brand" href="configuracoes.html">#SGLOMER</a>
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
                echo "<li><a href='central/".$pagina['ID'].".html'>".$pagina['nome']."</a></li>";
              }
            ?>
            

            <?php 
            foreach ( $base::lista_plugin_menu() as $pagina ) 
            {
              echo "<li><a href='".$pagina['url']."'><i class='glyphicon glyphicon-tag'></i> <strong>".$pagina['nome']."</strong></a></li>";
            }
          ?>
            <li ><a href="upload_de_imagem.html"><i class="glyphicon glyphicon-picture"></i><strong> UPLOAD DE IMAGENS</strong></a></li>
          </ul>


        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

          <?php
              if(($Sec == "") || ($Sec == "configuracoes")){
                include ("configuracoes.php");
              }else{
                  include ("secao.php");
              }
          ?>

        </div>
          
              <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                      </div>
                      <div class="modal-body">
                       dsfds
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                      </div>
                    </div>
                  </div>
                </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    
    <script src="./bootstrap-3.1.1/js/docs.min.js"></script>
    
    

    
  </body>
</html>
