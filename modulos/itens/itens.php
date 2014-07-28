<?php

class Itens extends Principal
{
	public static $nome_tabela;

	public static $campos;

	public static $categoria;

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

			$campos = array('ID','estrutura');

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

	public static function formulario_item($valores = null)
	{

		$formularios = new Formularios();

		$principal = new Principal();

		$tabela = self::$nome_tabela;

		if($valores)
		{
			$elemento = $valores;
		}
		else
		{

			///

			$formularios = new Formularios();

			$o = self::listagem_categoria();

			$select = array();

			foreach ($o as $d)
			{
				$select[$d['ID']] = $d['nome'];
			}

			$options = $formularios->estrutura_option($select);


			///

			$campos = array('estrutura');

			$where = array('nome' => $tabela);

			$xox = $principal->sql_select_otimizado('itens',$campos,$where);

			$elm2 = json_decode($xox[0]['estrutura'],true);

			$novo = $elm2;

			foreach ($elm2 as $chave => $item)
			{
				if($novo[$chave]['name'] == 'categoria')
				{
					if($options)
					{
						$novo[$chave]['opcoes_json'] = "0|nehuma..,".$options;
					}
				}
			}
			$elemento = $novo;
		}

		$campos = $formularios->formulario_template($elemento);

	 return $campos;

	}

	public static function inserir_item($obj)
	{
		self::criar_item();

		$principal = new Principal();

		$tabela = self::$nome_tabela;

		$campos_valores = array();

		$form = self::formulario_item();

		if($obj)
		{
			foreach($obj as $key => $value)
			{
				$campos_valores[$key] =  $value;
			}

			$principal->sql_insert_otimizado($tabela,$campos_valores);
		}

		return $form;
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

	//mostra um lista de itens ! elaborar melhor para paginacao
	public static function listagem_tebela($campos,$where = null)
	{
			$principal = new Principal();

	    $xox = $principal->sql_select_otimizado(self::$nome_tabela,$campos,$where);

	    return $xox;
	}

	//mostra um lista de itens ! elaborar melhor para paginacao
	public static function listagem_categoria()
	{
			$principal = new Principal();

			$campos = array('ID','nome');

			$xox = $principal->sql_select_otimizado(self::$categoria,$campos);

			return $xox;
	}


	public static function editar_item($item_id,$obj)
	{
		$principal = new Principal();

		$tabela = self::$nome_tabela;

		if($obj)
		{
			foreach($obj as $key => $value)
			{
				$campos_valores[$key] =  $value;
			}
			$where = array('ID'=>$item_id);

			$principal->sql_update_otimizado($tabela,$campos_valores,$where);
		}

		$campos = array('estrutura');

		$where = array('nome' => $tabela);

		$xox = $principal->sql_select_otimizado('itens',$campos,$where);

		$elm2 = json_decode($xox[0]['estrutura'],true);

		$camposX = array();

		foreach ($elm2 as $chave => $valor)
		{
				$camposX[] = $chave;
		}

		$novo = $elm2;

		$where = array('ID'=>$item_id);

		$itens = $principal->sql_select_otimizado($tabela,$camposX,$where);

		///

		$formularios = new Formularios();

		$o = self::listagem_categoria();

		$select = array();

		foreach ($o as $d)
		{
			$select[$d['ID']] = $d['nome'];
		}

		$options = $formularios->estrutura_option($select);

		///

		foreach ($itens[0] as $chave => $item)
		{
			$novo[$chave]['value'] = $item;
			if($novo[$chave]['name'] == 'categoria')
			{
				if($options)
				{
					$novo[$chave]['opcoes_json'] = "0|nemhuma..,".$options;
				}
			}
		}

		$form = self::formulario_item($novo);

		return $form;
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

	public static function backend($pagina,$dados,$acao)
	{
		self::montar();

		switch($acao)
		{
			case 'listar':
				$lista = self::listagem_tebela($dados->campos,$dados->where);
				return $lista;
			break;

			case 'editar':
				$form_editar = self::editar_item($dados->id,$dados->post);
				return $form_editar;
			break;

			case 'novo':
				self::$nome_tabela = $pagina;
				$form_novo = self::inserir_item($dados);
				return $form_novo;
			break;

			default:
				$lista = self::listagem_tebela($dados->campos,$dados->where);
				return $lista;

		}



	}


}
?>
