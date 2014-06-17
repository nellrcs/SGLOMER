<?php

if(Principal::se_plugin('buscainterna'))
{
	echo "<h3>Plugin Busa intena</h3>";
	busca_interna();
}

?>

<h3>Modulo texto</h3>
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

<?php


if(Principal::se_plugin('social'))
{
	echo "<h3>Plugin social</h3>";

	$social = new Social($id_desta_pagina);

	$social->define_insere_social('novo_social');
}

?>