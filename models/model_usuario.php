<?php

require_once('pdo.class.php');

abstract class ClsUsuario{

	private $id;
	private $name;
	private $email;
	private $password;
	private $strCampo;
	private $strValor;

	public $tabela = "users";
	public $keyId = "id";
	
	public function getId(){ return $this->id; }
	public function setId($id){ $this->id = $id; }
	
	public function getNome(){ return $this->name; }	
	public function setNome($name){ $this->name = $name; }

	public function getEmail(){ return $this->email; }	
	public function setEmail($email){ $this->email = $email; }

	public function getSenha(){ return $this->password; }	
	public function setSenha($password){ $this->password = $password; }

	public function getStrCampo(){ return $this->strCampo; }
	public function setStrCampo($strCampo){ $this->strCampo = $strCampo; }

	public function getStrValor(){ return $this->strValor; }
	public function setStrValor($strValor){ $this->strValor = $strValor; }

}

interface itfUsuario{

	function cadastrar(ClsUsuario $objClass);
	function atualizar(ClsUsuario $objClass);
	function deletar(ClsUsuario $objClass);
	function buscar_id(ClsUsuario $objClass);
	function ifExist(ClsUsuario $objClass);
	function ifExistId(ClsUsuario $objClass);
	function listar(ClsUsuario $objClass);
	function listar_combo(ClsUsuario $objClass);
	function count(ClsUsuario $objClass);
}

class DaoUsuario implements itfUsuario{

	public function cadastrar(ClsUsuario $objClass){
		
		// Cria o objeto PDO
		$pdo = Database::conexao();
		
		$sql = "insert into ".$objClass->tabela." (name, email) values (:name,:email);";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":name",$objClass->getNome());
		$stmt->bindvalue(":email",$objClass->getEmail());
		$stmt->execute();

		return $pdo->lastInsertId();
	}

	public function atualizar(ClsUsuario $objClass){
		// Cria o objeto PDO
		$pdo = Database::conexao();
		
		$sql = "update ".$objClass->tabela." set ";
		$sql .= "name = :name, ";		
		$sql .= "email = :email ";
		$sql .= "where ".$objClass->keyId." = :id;";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":name",$objClass->getNome());
		$stmt->bindvalue(":email",$objClass->getEmail());
		$stmt->bindvalue(":id",$objClass->getId());
		$stmt->execute();

		return 1;
	}

	public function deletar(ClsUsuario $objClass){

		// Cria o objeto PDO
		$pdo = Database::conexao();

		if (intval($objClass->getId()) == 1) {
			return 0;	
		} else {
			
			$sql = "delete from ".$objClass->tabela." where ".$objClass->keyId." = :id and ".$objClass->keyId." <> 1";
		
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(":id",$objClass->getId()); //Troca Pseudonomes por valores
			$stmt->execute();//Executa A Query
			
			return 1;			
		}

		// fecha o banco de dados
		$db->close();
	}

	public function buscar_id(ClsUsuario $objClass){
		// Cria o objeto PDO
		$pdo = Database::conexao();
		
		$sql = "select * from ".$objClass->tabela." where ".$objClass->keyId." = :id";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id",$objClass->getId()); //Troca Pseudonomes por valores
		$stmt->execute();//Executa A Query

		$objResultado = $stmt->fetch(PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function ifExist(ClsUsuario $objClass){

		// Cria o objeto PDO
		$pdo = Database::conexao();
		
		$sql = "select * ";
		$sql .= "from ".$objClass->tabela;
		$sql .= " where ".$objClass->getStrCampo()." = '".$objClass->getStrValor()."'";
		if (trim($objClass->getId()) != "") {
			$sql .= " and ".$objClass->keyId." <> ".$objClass->getId().";";
		}
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();//Executa A Query

		$objResultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return count($objResultado);
	}

	public function ifExistId(ClsUsuario $objClass){

		// Cria o objeto PDO
		$pdo = Database::conexao();
		
		$sql = "select * ";
		$sql .= "from ".$objClass->tabela;
		$sql .= " where ".$objClass->getStrCampo()." = '".$objClass->getStrValor()."';";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();//Executa A Query

		$objResultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return count($objResultado);
	}

	public function listar(ClsUsuario $objClass){
		
		// Cria o objeto PDO
		$pdo = Database::conexao();
		
		$sql = "select * from ".$objClass->tabela.";";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();//Executa A Query

		$objResultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function listar_combo(ClsUsuario $objClass){
		// Cria o objeto PDO
		$pdo = Database::conexao();
		
		$sql = "select id, name from ".$objClass->tabela." where id not in (1) order by name asc;";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function count(ClsUsuario $objClass){
		// Cria o objeto PDO
		$pdo = Database::conexao();
		
		$sql = "select count(*) as Qtd from ".$objClass->tabela.";";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();//Executa A Query

		return $stmt->fetchColumn();
	}
}

?>