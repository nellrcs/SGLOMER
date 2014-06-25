<H1>PAGINA HOME<H1>
<br>
<h2>* Modulo texto</h2>
<hr>






	<?php
	$id_pagina = $base::$id_pagina;

	class ex_obj_b
	{
		public $nome_posicao_plugin;
		public $imgs;
	}

	$obj = new ex_obj_b();
	$obj->nome_posicao_plugin = 'bannerhome';
	$obj->imgs = 3;
	?>
	<div id="up">
		<?php echo $base::front_end('banner',$obj); ?>	
	</div>
	
	<script type="text/javascript">
		$('#up').cycle({ 
		fx:    'curtainX', 
		sync:  false, 
		delay: -2000 
		});
	</script>
	<?php
		$texto = new Textos();
		echo $texto->mod_texto($id_pagina,'texto_exemplo','0','É um fato conhecido de todos que um leitor se distrairá com o conteúdo de texto','');
	 ?>
</p>
<ul>
	<li><?php echo $texto->mod_texto($id_pagina,'texto_1','0','texto 1 pagina home',''); ?></li>
	<li><?php echo $texto->mod_texto($id_pagina,'texto_2','0','texto 2 pagina home',''); ?></li>
	<li><?php echo $texto->mod_texto($id_pagina,'texto_3','0','texto 3 pagina home',''); ?></li>
	<li><?php echo $texto->mod_texto($id_pagina,'texto_4','0','texto 4 pagina home',''); ?></li>
	<li><?php echo $texto->mod_texto($id_pagina,'texto_5','0','texto 5 pagina home',''); ?></li>
</ul>


<h2>* Modulo Imagem</h2>
<hr>
<?php

$imagem = new Imagem();

echo $imagem->define_insere_imagem($id_pagina,'imagens','http://www.guanambi.ba.gov.br/fotos/noimage.gif',true);

?>

<h2>_Plugin Busa intena</h2><hr>
<?php

?>

<h2>_Plugin social</h2><hr>;
<?php

?>

<script type="text/javascript">
	$('#up').cycle({ 
	fx:    'curtainX', 
	sync:  false, 
	delay: -2000 
	});
	</script>