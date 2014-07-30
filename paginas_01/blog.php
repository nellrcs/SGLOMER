<h1>BLOG</h1>
<?php 
	//TEXTO
	$textos_pag_home = new Textos($base::$id_pagina);
	$iimga = new Imagem($base::$id_pagina);

	$base::$nome_plugin = 'googlemaps';  
	$obj = $base::obj_plugin();
	$obj->nome_posicao_plugin = "novo_gmapas";
   	


	

?>


<h1><?php echo $textos_pag_home->preciso_texto_aqui('TEXTO_BLOG1', 0, 'OLA', 'nt'); ?></h1>
<p><?php echo $textos_pag_home->preciso_texto_aqui('TEXTO_BLOG1', 1, 'lorem', 'nt'); ?></p>



<div><?php echo $textos_pag_home->preciso_texto_aqui('TEXTO_BLOG2', 0, 'kkkkkkkk', 'nt'); ?></div>
<div><?php echo $textos_pag_home->preciso_texto_aqui('TEXTO_BLOG3', 0, 'kkkkkkkkk', 'nt'); ?></div>
<div><?php echo $textos_pag_home->preciso_texto_aqui('TEXTO_BLOG4', 0, 'kkkkk', 'nt'); ?></div>
<div><?php echo $textos_pag_home->preciso_texto_aqui('TEXTO_BLOG5', 0, 'oooo', 'nt'); ?></div>
<div><?php echo $textos_pag_home->preciso_texto_aqui('TEXTO_BLOG6', 0, 'oooon', 'nt'); ?></div>
<div><?php echo $textos_pag_home->preciso_texto_aqui('TEXTO_BLOG7', 0, 'vvvvv', 'nt'); ?></div>


<div><?php echo $base::front_end($obj); ?></div>

<div><?php echo $iimga->define_insere_imagem($base::$id_pagina,'mechendo_blog','http://img2.wikia.nocookie.net/__cb20100528223948/wikinaruto/pt/images/0/03/Mangekyou_Madara_Icone.png',true); ?></div>