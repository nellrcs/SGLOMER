<?php
	//FUNCOES BASICAS
	function status_pagina($status,$id)
	{
		
		$principal = new Principal();

		$campo_valor = array('status'=>$status);

		$where = array('ID'=>$id);

	    $principal->sql_updadate_otimizado('paginas',$campo_valor,$where);
	}


	function html_lista($campo,$status,$nome,$id)
	{
		if($status == "1"){ ?>
			<ol class="breadcrumb">
			  <li class="active">Ativar</li>
			   <li><a href="configuracoes/<?php echo $campo; ?>/desativar/<?php echo base64_encode($id); ?>.html">Destivar</a></li>
			  <li class="navbar-right"><strong><?php echo $nome; ?></strong></li>
			</ol>
		<?php }else if($status == "0"){ ?>
			<ol class="breadcrumb">
			  <li><a href="configuracoes/<?php echo $campo; ?>/ativar/<?php echo base64_encode($id); ?>.html">Ativar</a></li>
			  <li class="active">Desativar</li>
			  <li class="navbar-right"><strong><?php echo $nome; ?></strong></li>
			</ol>
		<?php }else{ ?>
		<ol class="breadcrumb">
			<li><a href="configuracoes/<?php echo $campo; ?>/instalar/<?php echo base64_encode($id); ?>.html">Instalar</a></li>
			<!-- <li><a href="configuracoes&instalar=<?php //echo $nome_plugin; ?>">Instalar</a></li> -->
			<li class="navbar-right"><?php echo $nome; ?></li>
		</ol>
		<?php }	
	}


	if(isset($url[1]) and isset($url[2]) and isset($url[3])){

		if($url[1] == "pagina"){
						
			$id_pagina = base64_decode($url[3]);

			if((int)$id_pagina){
				if($url[2] == "ativar"){

					status_pagina(1,$id_pagina);

	        	}elseif($url[2] == "desativar"){

	        		status_pagina(0,$id_pagina);	
	        			
				}else{
					
					$principal->pagina_erro();
				}

			}else{
				$principal->pagina_erro();
			}
		

		}elseif($url[1] == "plugin"){

			
			$nome_plugin = base64_decode($url[3]);

			if((string)$nome_plugin){

				if($url[2] == "instalar"){
	        		
					$string ="INSERT INTO `plugins` (`nome`, `status`) VALUES ('$nome_plugin', '0' )";
        			$principal->sql_comando($string);

	        	}elseif($url[2] == "ativar"){
					
					$string ="UPDATE plugins SET status='1' WHERE nome ='$nome_plugin'";
        			$principal->sql_comando($string);

	        	}elseif($url[2] == "desativar"){

					$string ="UPDATE plugins SET status='0' WHERE nome ='$nome_plugin'";
        			$principal->sql_comando($string);

				}else{
					//cara ta de patifaria
					echo '<script type="text/javascript">location.href="404.php";</script>';
				}

			}else{
				//cara ta de patifaria
				echo '<script type="text/javascript">location.href="404.php";</script>';
			}

		}
	}


?>

<?php 
function seleciona_pagina($nome_pagina){
	
	$principal = new Principal();

	$campos = array('ID','status');

	$where = array('nome'=>$nome_pagina);

	$n_paginas  = $principal->sql_select_otimizado('paginas',$campos,$where);

	if($n_paginas){	
	
	$status_p = $n_paginas[0]['status'];

	$id = $n_paginas[0]['ID'];

	html_lista('pagina',$status_p,$nome_pagina,$id);

	}else{

	$campos = array('nome'=>$nome_pagina,'status'=>'0');

 	$id = $principal->sql_insert_otimizado('paginas',$campos);

 	html_lista('pagina',0,$nome_pagina,$id);

	 }

 }?>




<?php 
function seleciona_plugin($nome_plugin){
			
	$principal = new Principal();

	$campos = array('status');

	$where = array('nome'=>$nome_plugin);

	$n_plugin = $principal->sql_select_otimizado('plugins',$campos,$where);


	if($n_plugin){

		$status_p = $n_plugin[0]['status'];

		html_lista('plugin',$status_p,$nome_plugin,$nome_plugin);
	}else{

		html_lista('plugin','instalar',$nome_plugin,$nome_plugin);

	}

} ?>

<h3>PAGINAS</h3>
<?php
foreach ($principal->arquivos('paginas_01') as $p){
	seleciona_pagina($p);
}
?>

<h3>PLUGINS</h3>
<?php 
foreach ($principal->lista_plugins() as $v) 
{

	seleciona_plugin($v);
}

?>

