<?php
	class Objeto_formulario
	{	
    public $nome_posicao;
		public $name;
		public $tipo;
		public $mask;
		public $maxlenth;
		public $opcoes_json;
		public $options;
		public $label;
		public $ordem;
	}

	class Formularios extends Principal
	{
    public $id_pagina;

		function montar_formulario(){

			
		}

    	function __construct()
      {

      }

     	function slq_monta_form()
     	{      		


     	}


     	function criar_formulario(){
     		
 		
     	}

     	function formulario_back_test(){

     		
     	}



      function formulario_back_test_2($dados_array)
      {

      }


      function define_insere_formulario($nome_posicao)
      {

	    }


  ///WARLLEN 
  function formulario_template($campos)
  {
    foreach($campos as $campo)
    {
      switch($campo['tipo'])
      {
         case 'input':
                echo '<div>';
                echo '<span>'.$campo['label'].'</span>';
                echo '<input type="text" name="'.$campo['name'].'" maxlength="'.$campo['maxlenth'].'" required />';
                echo '</div>';
         break;

         case 'select':
              echo '<div>';

                  echo '<span>'.$campo['label'].'</span>';

                  $var = explode(',',$campo['opcoes_json']);

                  echo '<select name="'.$campo['name'].'" required>';
                   
                          foreach($var as $chave => $value){
                                 $ch = explode('|',$value);
                                 echo '<option value="'.$ch[0].'">'.$ch[1].'</option>';
                          }

                  echo '</select>';
              echo '</div>';
         break;

         case 'textarea':
                echo '<div>';
                echo '<span>'.$campo['label'].'</span>';
                echo '<textarea name="'.$campo['name'].'"></textarea>';
                echo '</div>';
         break;

         case 'radio':
              echo '<div>';

                  echo '<span>'.$campo['label'].'</span>';

                  $var = explode(',',$campo['opcoes_json']);                                            
           
                  foreach($var as $chave => $value){
                      $ch = explode('|',$value);
                      echo '<input type="radio" name="'.$campo['name'].'" value="'.$ch[0].'" />'.$ch[1];
                  }
              echo '</div>';
         break;

         case 'checkbox':
              echo '<div>';

                  echo '<span>'.$campo['label'].'</span>';

                  $var = explode(',',$campo['opcoes_json']);                                            
           
                  foreach($var as $chave => $value){
                      $ch = explode('|',$value);
                      echo '<input type="checkbox" name="'.$campo['name'].'" value="'.$ch[0].'" />'.$ch[1];
                  }
              echo '</div>';
         break;
      }
    }
  }
}

?>