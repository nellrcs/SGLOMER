<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->

<?php if(isset($_GET['Secao'])){$Sec = $_GET['Secao'];}else{$Sec = "";} ?>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title></title>
	<meta name="description" content="">
	<meta name="author" content="">

	<meta name="viewport" content="width=device-width,initial-scale=1">

	<link rel="stylesheet" href="css/style.css">

	<script src="js/libs/modernizr-2.0.6.min.js"></script>
</head>
<body>

	<div id="header-container">
		<header class="wrapper clearfix">
			<h1 id="title">h1#title</h1>
			<nav>
				<ul>
					<li><a href="Inicial.html">Home</a></li>
					<li><a href="quem_somos.html">Quem somos</a></li>
					<li><a href="contato.html">Contato</a></li>
				</ul>
			</nav>
		</header>
	</div>
	<div id="main-container">
		<div id="main" class="wrapper clearfix">
			
			<?php
      	   		if(($Sec == "") || ($Sec == "Inicial")){
      	   			include ("home.php");
      	   		}else{
                	include ("secao.php");
            	}
            ?>

		</div> <!-- #main -->
	</div> <!-- #main-container -->

	<div id="footer-container">
		<footer class="wrapper">
			<h3>footer</h3>
		</footer>
	</div>

</body>
</html>
index.php