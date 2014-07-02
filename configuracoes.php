<?php

	//Parâmetros
	// 0 - Nome da página "configuracoes";
	// 1 - Tipo da ativação "pagina" e "plugin";
	// 2 - O que vai fazer "ativar, instalar, desativar"

	//SE FOR PÁGINA
	// 3 - Id da página

	//SE FOR PLUGIN
	// 3 - Nome do plugin
	
	// $url_master_array = array(

	// 	array("configuracoes"),
	// 	array("pagina", "plugin"),
	// 	array("ativar", "desativar", "instalar"),

	// );


	// function trata_parametro($url_total, $url_master,$numero_de_oks){


	// 	$numro_da_base = count($url_master);

	// 	$i = 0;

	// 	foreach ($url_total as $key => $url_separada) 
	// 	{
			
			
	// 		if($key < $numro_da_base)
	// 		{	
	// 			foreach ($url_master[$key] as $valor) 
	// 			{
					
	// 				if($url_separada == $valor)
	// 				{
	// 					$i++;
	// 				}

	// 			}
	// 		}

	// 	}

	// 	return $i;
	// 	// $verifica_existencia_array = false;

	// 	// foreach ($possibilidades_parametro as $possibilidade) {
	// 	// 	if($possibilidade == $parametro){

	// 	// 		$verifica_existencia_array = true;

	// 	// 	}
	// 	// }

	// 	// return $verifica_existencia_array;
	// }


	// if(isset($url[1]))
	// {

	// 	echo trata_parametro($url, $url_master_array,3);

	// }






	// if(isset($url[1])){
	// 	if($url[1] == "pagina"){

	// 		if($url[2] == "ativar"){

	// 			$id_pagina = $url[3];

	// 			$string ="UPDATE paginas SET status='1' WHERE ID ='$id_pagina'";

 //        		$principal->slq_comando($string);

	// 		}elseif($url[2] == "desativar"){

	// 			$id_pagina = $url[3];

	// 			$string ="UPDATE paginas SET status='0' WHERE ID ='$id_pagina'";

 //        		$principal->slq_comando($string);

	// 		}

	// 	}elseif($url[1] == "plugin"){



	// 	}
	// }


	// if(!empty($_GET['instalar'])){
	// 	$nome_plugin = $_GET['instalar'];

	// 	$string ="INSERT INTO `plugins` (`ID`, `nome`, `status`) VALUES (NULL, '$nome_plugin', '0' )";

 //        $principal->slq_comando_insert($string);
	// }	


	// if(isset($_GET['status']) && !empty($_GET['nome']) ){
	// 	$status = $_GET['status'];

	// 	$nome = $_GET['nome'];

	// 	$string ="UPDATE plugins SET status='$status' WHERE nome ='$nome'";

 //        $principal->slq_comando($string);

	// }else if(isset($_GET['status']) && !empty($_GET['id'])){

	// 	$status = $_GET['status'];

	// 	$id = $_GET['id'];

	// 	$string ="UPDATE paginas SET status='$status' WHERE ID ='$id'";

 //        $principal->slq_comando($string);
	// }
?>


<?php 
function seleciona_pagina($nome_pagina){
	
	$principal = new Principal();

	$n_plugin = $principal->slq_comando_select("SELECT * FROM paginas WHERE nome='$nome_pagina'");

	if($n_plugin){	
	
	$status_p = $n_plugin['status'];

	$id = $n_plugin['ID'];
?>
		
		<?php if($status_p == "1"){ ?>
			<ol class="breadcrumb">
			  <li class="active">Ativar</li>
			   <li><a href="configuracoes/pagina/desativar/<?php echo $id; ?>">Destivar</a></li>
			  <li class="navbar-right"><strong><?php echo $nome_pagina; ?></strong></li>
			</ol>

		<?php }else{ ?>

			<ol class="breadcrumb">
			  <li><a href="configuracoes/pagina/ativar/<?php echo $id; ?>.html">Ativar</a></li>
			  <li class="active">Desativar</li>
			  <li class="navbar-right"><strong><?php echo $nome_pagina; ?></strong></li>
			</ol>
		<?php }	?>

	<?php
	
	}else{

	$string ="INSERT INTO `paginas` (`ID`, `nome`, `status`) VALUES (NULL, '$nome_pagina', '0' )";

    $ultimo_id = $principal->slq_comando_insert($string);

	?>

	<ol class="breadcrumb">
	  	<li class="active">Ativar</li>
	   		<li><a href="configuracoes/pagina/desativar/0/<?php echo $ultimo_id; ?>.html">Destivar</a></li>
	  	<li class="navbar-right"><?php echo $nome_pagina; ?></li>
	</ol>

	<?php }//fecha if da verificação da select das paginas ?>

<?php }//fecha função ?>




<?php 
function seleciona_plugin($nome_plugin){
			
	$principal = new Principal();

	$n_plugin = $principal->slq_comando_select("SELECT * FROM plugins WHERE nome='$nome_plugin'");

	if($n_plugin){

		$status_p = $n_plugin['status'];

	?>
		<?php if($status_p == "1"){?>

			<ol class="breadcrumb">
			  <li class="active">Ativar</li>
			   <li><a href="configuracoes/plugin/desativar/0/<?php echo $nome_plugin; ?>.html">Destivar</a></li>
			  <li class="navbar-right"><?php echo $nome_plugin; ?></li>
			</ol>

		<?php }else{ ?>

			<ol class="breadcrumb">
			  <li><a href="configuracoes/plugin/ativar/1/<?php echo $nome_plugin; ?>.html">Ativar</a></li>
			  <li class="active">Desativar</li>
			  <li class="navbar-right"><?php echo $nome_plugin; ?></li>
			</ol>

		<?php } ?>
	
	<?php }else{ ?>

	<ol class="breadcrumb">
		<li><a href="configuracoes/plugin/instalar/0/<?php echo $nome_plugin; ?>.html">Instalar</a></li>
		<!-- <li><a href="configuracoes&instalar=<?php //echo $nome_plugin; ?>">Instalar</a></li> -->
		<li class="navbar-right"><?php echo $nome_plugin; ?></li>
	</ol>

	<?php }//fecha if da verificação da select dos plugins ?>

<?php }//fecha função ?>




<h3>PAGINAS</h3>
<?php
foreach ($principal->arquivos('paginas_01') as $p){
	seleciona_pagina($p);
}
?>



<h3>PLUGINS</h3>
<?php 
foreach ($principal->lista_plugins() as $v) {
	seleciona_plugin($v);
}

?>

