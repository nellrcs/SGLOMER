<?php

class Itens extends Principal 
{
	public static $nome_tabela;

	public static $campos;

	function Itens() 
	{

	}

	private static function criar_item()
	{
		$principal = new Principal();

		$campos_item = array($principal->campo_para_tabela('nome','input'),$principal->campo_para_tabela('estrutura','textarea'));

		$principal->sql_criar_tabela('itens',$campos_item);
	}

	private static function montar()
	{
		
		self::criar_item();
		$principal = new Principal();

		$tabela = self::$nome_tabela;

		if(!empty($tabela))
		{

			$campos = array('ID');

			$where = array('nome' => $tabela);

		    $xox = $principal->sql_select_otimizado('itens',$campos,$where);

		    if( count($xox) <= 0  )
		    {
		    	$templte_form = json_encode(self::$campos);

		    	$campos_itens =  array('nome' => $tabela,'estrutura'=>$templte_form);
				
				$principal->sql_insert_otimizado('itens',$campos_itens);
		    }

			$campos_tabela = array();

			foreach (self::$campos as $key => $value) 
			{
				$campos_tabela[] =  $principal->campo_para_tabela($key,$value['tipo']);
			}

			$principal->sql_criar_tabela($tabela,$campos_tabela);
		}	

	}	
	
	public static function formulario_item()
	{
		
		$formularios = new Formularios();

		$principal = new Principal();

		$tabela = self::$nome_tabela;

		$campos = array('estrutura');

		$where = array('nome' => $tabela);

		$xox = $principal->sql_select_otimizado('itens',$campos,$where);

		$elm2 = json_decode($xox[0]['estrutura'],true);

		$formularios->formulario_template($elm2);

	}

	public static function inserir_item($obj)
	{
		self::criar_item();

		$principal = new Principal();

		$tabela = self::$nome_tabela;

		$campos_valores = array();

		self::formulario_item();

		if($obj)
		{	
			foreach($obj as $key => $value) 
			{
				$campos_valores[$key] =  $value;
			}

			$principal->sql_insert_otimizado($tabela,$campos_valores);
		}
	}

	public static function lista_itens()
	{	
		self::criar_item();

		$principal = new Principal();

		$campos = array('ID','nome');

		$xox = $principal->sql_select_otimizado('itens',$campos);

		$array = array();

		$array[] = array('ID'=>$xox[0]['ID'],'posicao'=>$xox[0]['nome'],'editar'=>'itens'); 

		return false;

	}

	//mostra um lista de itens ! elaborar melhor par apaginacao
	public static function listagem_tebela($campos,$where = null)
	{
		$principal = new Principal();

	    $xox = $principal->sql_select_otimizado(self::$nome_tabela,$campos,$where);

	    return $xox;
	}


	public static function editar_item()
	{
		// ...
	}

	public static function paginacao_item()
	{
		// ...
	}

	public static function categorias()
	{
		// ...
	}

	public static function front($obj = null)
	{
		self::montar();

		if($obj)
		{
			return self::listagem_tebela($obj->campos,$obj->where);
		}
		else
		{
			return false;
		}	
	}

	public static function backend($pagina,$dados)
	{
		self::$nome_tabela = $pagina;

		self::inserir_item($dados);
	}


}
?>