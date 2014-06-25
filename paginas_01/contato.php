<h1>PAGINA CONTATO</h1>
<?php

	class ex_obj 
	{
		public $nome_posicao_plugin;
	}
	$obj = new ex_obj();

	//plugin mapas
	$obj->nome_posicao_plugin = 'mapa_maringa';

	echo $base::front_end('googlemaps',$obj);

?>