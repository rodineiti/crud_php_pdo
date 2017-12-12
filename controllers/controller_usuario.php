<?php

include_once("./models/model_usuario.php");

class BaoUsuario extends ClsUsuario{
	
	function cadastrar(ClsUsuario $objClass){
		$objItf = new DaoUsuario();
		return $objItf->cadastrar($objClass);		
	}

	function atualizar(ClsUsuario $objClass){
		$objItf = new DaoUsuario();
		return $objItf->atualizar($objClass);
	}

	function deletar(ClsUsuario $objClass){
		$objItf = new DaoUsuario();
		return $objItf->deletar($objClass);
	}

	function buscar_id(ClsUsuario $objClass){
		$objItf = new DaoUsuario();
		return $objItf->buscar_id($objClass);
	}

	function ifExist(ClsUsuario $objClass){
		$objItf = new DaoUsuario();
		return $objItf->ifExist($objClass);
	}

	function ifExistId(ClsUsuario $objClass){
		$objItf = new DaoUsuario();
		return $objItf->ifExistId($objClass);
	}

	function listar(ClsUsuario $objClass){
		$objItf = new DaoUsuario();
		return $objItf->listar($objClass);
	}

	function listar_combo(ClsUsuario $objClass){
		$objItf = new DaoUsuario();
		return $objItf->listar_combo($objClass);
	}

	function count(ClsUsuario $objClass){
		$objItf = new DaoUsuario();
		return intval($objItf->count($objClass));
	}

	function geraSenha($tamanho = 8, $maiusculas = false, $numeros = true, $simbolos = false)
	{
		$lmin = 'abcdefghijklmnopqrstuvwxyz';
		$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$num = '1234567890';
		$simb = '!@#$%*-';
		$retorno = '';
		$caracteres = '';

		$caracteres .= $lmin;
		if ($maiusculas) $caracteres .= $lmai;
		if ($numeros) $caracteres .= $num;
		if ($simbolos) $caracteres .= $simb;

		$len = strlen($caracteres);
		
		for ($n = 1; $n <= $tamanho; $n++) {
			$rand = mt_rand(1, $len);
			$retorno .= $caracteres[$rand-1];
		}
		
		return $retorno;
	}
}

?>