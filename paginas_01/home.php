
<?php 
  	if(Principal::se_plugin('banner'))
	{
		$banner = new Banner($id_desta_pagina);

		echo "<h2>_Plugin Banner</h2><hr>";
		echo "<div id='up'>";

		$banner->define_insere_banner('aaa3',8 );

		echo "</div>";

		?>
		<script type="text/javascript">
		$('#up').cycle({ 
		fx:    'curtainX', 
		sync:  false, 
		delay: -2000 
		});
		</script>
		<?php

	}
  ?>
<br>
<h2>* Modulo texto</h2>
<hr>
<p>
	<?php
		$texto = new Textos();
		echo $texto->mod_texto('20','texto_exemplo','0','É um fato conhecido de todos que um leitor se distrairá com o conteúdo de texto','');
	 ?>
</p>
<ul>
	<li><?php echo $texto->mod_texto('20','texto_1','0','texto 1 pagina home',''); ?></li>
	<li><?php echo $texto->mod_texto('20','texto_2','0','texto 2 pagina home',''); ?></li>
	<li><?php echo $texto->mod_texto('20','texto_3','0','texto 3 pagina home',''); ?></li>
	<li><?php echo $texto->mod_texto('20','texto_4','0','texto 4 pagina home',''); ?></li>
	<li><?php echo $texto->mod_texto('20','texto_5','0','texto 5 pagina home',''); ?></li>
</ul>


<h2>* Modulo Imagem</h2>
<hr>
<?php

$imagem = new Imagem();

echo $imagem->define_insere_imagem('20','imagens','http://www.guanambi.ba.gov.br/fotos/noimage.gif',true);

?>

<h2>_Plugin Busa intena</h2><hr>
<?php
if(Principal::se_plugin('buscainterna'))
{
	busca_interna();
}
?>

<h2>_Plugin social</h2><hr>;
<?php
if(Principal::se_plugin('social'))
{	
	$social = new Social($id_desta_pagina);

	$social->define_insere_social('novo_social');
}
?>