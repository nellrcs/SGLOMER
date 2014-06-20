<h2>* Modulo texto</h2><hr>
<p>
	<?php

		$texto_emp = new Textos();

		echo $texto_emp->mod_texto('30','texto_exemplo','0','Texto para pagina empresa','');

		echo "<a href=".$texto_emp->mod_texto('30','texto_exemplo','3','http://google.com.br','').">".$texto_emp->mod_texto('30','texto_exemplo','1','link','')."</a>";
	 ?>
</p>