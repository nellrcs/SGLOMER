<?php
 

  require_once './class/Principal.class.php';

  //INCLUI MODULO FIXO TEXTOS
  include ('./modulos/textos/textos.php');

  //INCLUIR BASE
  include './class/Base.class.php';

 $principal = new Principal();

  $textos = new Textos(21);

  echo $textos->preciso_texto_aqui('texto_text', 0, 'lorem  lorem ', 'lherm');

?>
