<h1>home</h1>
<?php



				$obj = new stdClass();

				$Formularios =  new Formularios();



				$array = array('Andre','Antonio','Maria','Jose');

				$arrayJson = $Formularios->estrutura_option($array,true);



				//$arrayJson = '1|Masculino,2|Feminino,3|Andre';



				$obj->nome = array('name'=>'nome','label'=>'Nome','tipo'=>'input','mask'=>'ttt','maxlenth'=>'30','opcoes_json','options','ordem'=>7,'value'=>1);

				$obj->preco = array('name'=>'preco','label'=>'Preco','tipo'=>'input','mask'=>'ttt','maxlenth'=>'30','opcoes_json','options','ordem'=>5,'value'=>1);

				$obj->categoria = array('name'=>'categoria','label'=>'Categoria','tipo'=>'input','mask'=>'ttt','maxlenth'=>'10','opcoes_json','options','ordem'=>4,'value'=>1);

				$obj->descricao = array('name'=>'descricao','label'=>'Descricao','tipo'=>'textarea','mask'=>'ttt','maxlenth'=>'10','opcoes_json','options','ordem'=>3,'value'=>1);

				$obj->imagem = array('name'=>'imagem','label'=>'Imagem','tipo'=>'input','mask'=>'ttt','maxlenth'=>'10','opcoes_json','options','ordem'=>2,'value'=>1);

				$obj->combo = array('name'=>'Sexo1','label'=>'sexo1','tipo'=>'select','mask'=>'','maxlenth'=>'','opcoes_json'=>$arrayJson,'options','ordem'=>6,'value'=>1);

				$obj->combo2 = array('name'=>'Sexo2','label'=>'sexo2','tipo'=>'select','mask'=>'','maxlenth'=>'','opcoes_json'=>$arrayJson,'options','ordem'=>1,'value'=>4);

				//print_r($obj);

				$Formularios->formulario_template($obj);



?>
