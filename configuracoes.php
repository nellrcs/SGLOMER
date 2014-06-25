<?php

		/// ! AVISO ISSO NÃO ESTA BEM FEITO E NÃO EH SEGURO, FAVOR MUDAR MUDAR...
		if(!empty($_GET['instalar']))
		{
			$nome_plugin = $_GET['instalar'];

			$string ="INSERT INTO `plugins` (`ID`, `nome`, `status`) VALUES (NULL, '$nome_plugin', '0' )";

            $principal->slq_comando_insert($string);
		}	


		if(isset($_GET['status']) && !empty($_GET['nome']) )
		{
			$status = $_GET['status'];

			$nome = $_GET['nome'];

			$string ="UPDATE plugins SET status='$status' WHERE nome ='$nome'";

            $principal->slq_comando($string);
		}
		else if(isset($_GET['status']) && !empty($_GET['id']))
		{
			$status = $_GET['status'];

			$id = $_GET['id'];

			$string ="UPDATE paginas SET status='$status' WHERE ID ='$id'";

            $principal->slq_comando($string);
		}	



		/////////////////////////////////////////////////
		function seleciona_plugin($nome_plugin)
		{
			
			$principal = new Principal();

			$n_plugin = $principal->slq_comando_select("SELECT * FROM plugins WHERE nome='$nome_plugin'");

			if($n_plugin)
			{	
			
			$status_p = $n_plugin['status'];

			if($status_p == "1")
			{
				?>
					<ol class="breadcrumb">
					  <li class="active">Ativar</li>
					   <li><a href="?pg=configuracoes&status=0&nome=<?php echo $nome_plugin; ?>">Destivar</a></li>
					  <li class="navbar-right"><?php echo $nome_plugin; ?></li>
					</ol>
				<?php
				}
				else
				{?>
					<ol class="breadcrumb">
					  <li><a href="?pg=configuracoes&status=1&nome=<?php echo $nome_plugin; ?>">Ativar</a></li>
					  <li class="active">Desativar</li>
					  <li class="navbar-right"><?php echo $nome_plugin; ?></li>
					</ol>
				<?php
				}	

			}
			else
			{
			?>
			<ol class="breadcrumb">
			  <li><a href="?pg=configuracoes&instalar=<?php echo $nome_plugin; ?>">Instalar</a></li>
			  <li class="navbar-right"><?php echo $nome_plugin; ?></li>
			</ol>
			<?php
			}	

		}
	//////////////////////////////////////////////////////////
		function seleciona_pagina($nome_pagina)
		{
			
			$principal = new Principal();

			$n_plugin = $principal->slq_comando_select("SELECT * FROM paginas WHERE nome='$nome_pagina'");

			if($n_plugin)
			{	
			

			$status_p = $n_plugin['status'];

			$id = $n_plugin['ID'];

			if($status_p == "1")
			{
				?>
					<ol class="breadcrumb">
					  <li class="active">Ativar</li>
					   <li><a href="?pg=configuracoes&status=0&id=<?php echo $id; ?>">Destivar</a></li>
					  <li class="navbar-right"><strong><?php echo $nome_pagina; ?></strong></li>
					</ol>
				<?php
				}
				else
				{?>
					<ol class="breadcrumb">
					  <li><a href="?pg=configuracoes&status=1&id=<?php echo $id; ?>">Ativar</a></li>
					  <li class="active">Desativar</li>
					  <li class="navbar-right"><strong><?php echo $nome_pagina; ?></strong></li>
					</ol>
				<?php
				}	

			}
			else
			{

			$string ="INSERT INTO `paginas` (`ID`, `nome`, `status`) VALUES (NULL, '$nome_pagina', '0' )";

            $ultimo_id = $principal->slq_comando_insert($string);

			?>
			<ol class="breadcrumb">
			  <li class="active">Ativar</li>
			   <li><a href="?pg=configuracoes&status=0&id=<?php echo $ultimo_id; ?>">Destivar</a></li>
			  <li class="navbar-right"><?php echo $nome_pagina; ?></li>
			</ol>
			<?php
			}	

		}	




?>
<h3>PAGINAS</h3>
<?php
foreach ($principal->arquivos('paginas_01') as $p) 
{
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

