
<h1>PAGINA EMPRESA</h1><hr>
<h2>* Modulo texto</h2><hr>
<p>
	<?php
		$id_pagina = $base::$id_pagina;
		$texto_emp = new Textos();

		echo $texto_emp->mod_texto($id_pagina,'texto_exemplo','0','Texto para pagina empresa','');

		echo "<a href=".$texto_emp->mod_texto($id_pagina,'texto_exemplo','3','http://google.com.br','').">".$texto_emp->mod_texto($id_pagina,'texto_exemplo','1','link','')."</a>";
	 ?>
</p>