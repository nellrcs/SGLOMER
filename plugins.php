<?php
		$principal = new Principal();

		$principal->montar_plugins();
		
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
					   <li><a href="?pg=plugins&status=0&nome=<?php echo $nome_plugin; ?>">Destivar</a></li>
					  <li class="navbar-right"><?php echo $nome_plugin; ?></li>
					</ol>
				<?php
				}
				else
				{?>
					<ol class="breadcrumb">
					  <li><a href="?pg=plugins&status=1&nome=<?php echo $nome_plugin; ?>">Ativar</a></li>
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
			  <li><a href="?pg=plugins&instalar=<?php echo $nome_plugin; ?>">Instalar</a></li>
			  <li class="navbar-right"><?php echo $nome_plugin; ?></li>
			</ol>
			<?php
			}	

		}
		

?>

<h3>PLUGINS</h3>

<?php 
foreach ($principal->lista_plugins() as $v) 
{
	seleciona_plugin($v);
}

?>

