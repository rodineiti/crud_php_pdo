<?php

require_once('pdo.class.php');

/*
 * classe Usuario - Active Record
*/
class Usuario {

	protected $data;
	protected $tabela = "leads";
	protected $id;
	protected $keyId = "id";

	public function __construct($id = null)
	{
		if ($id) {
			$this->id = $id;
		}
	}

	function __get($property)
	{
		return $this->data[$property];
	}

	function __set($property, $value)
	{
		$this->data[$property] = $value;
	}	
	
	public function cadastrar(){
		
		// Cria o objeto PDO
		$pdo = Database::conexao();
		
		$sql = "insert into ".$this->tabela." (
				name,
				emails
			) values (
				:name,
				:emails
			);";

		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":name",$this->nome);
		$stmt->bindvalue(":emails",$this->emails);
		$stmt->execute();

		return $pdo->lastInsertId();
	}

	public function atualizar(){
		// Cria o objeto PDO
		$pdo = Database::conexao();
		
		$sql = "update ".$this->tabela." set ";
		$sql .= "name = :name, ";		
		$sql .= "emails = :emails ";
		$sql .= "where ".$this->keyId." = :id;";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":name",$this->nome);
		$stmt->bindvalue(":emails",$this->emails);
		$stmt->bindvalue(":id",$this->id);
		$stmt->execute();

		return 1;
	}

	public function deletar(){

		// Cria o objeto PDO
		$pdo = Database::conexao();

		if (!$this->id) {
			return 0;	
		} else {
			
			$sql = "delete from ".$this->tabela." where ".$this->keyId." = :id;";
		
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(":id",$this->id);
			$stmt->execute();
			
			return 1;			
		}
	}

	public function buscar_id(){
		// Cria o objeto PDO
		$pdo = Database::conexao();
		
		$sql = "select * from ".$this->tabela." where ".$this->keyId." = :id";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id",$this->id); //Troca Pseudonomes por valores
		$stmt->execute();//Executa A Query

		$objResultado = $stmt->fetch(PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function ifExist(){

		// Cria o objeto PDO
		$pdo = Database::conexao();
		
		$sql = "select * ";
		$sql .= "from ".$this->tabela;
		$sql .= " where ".$this->field." = '".$this->value."' ";
		if ($this->id) {
			$sql .= " and ".$this->keyId." <> ".$this->id.";";
		}
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();//Executa A Query

		$objResultado = $stmt->fetch(PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function listar($start = 0, $end = 10){
		
		// Cria o objeto PDO
		$pdo = Database::conexao();
		
		$sql = "select * from ".$this->tabela." limit {$start},{$end};";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();//Executa A Query

		$objResultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function count(){
		// Cria o objeto PDO
		$pdo = Database::conexao();
		
		$sql = "select count(id) as Qtd from ".$this->tabela.";";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();//Executa A Query

		return $stmt->fetchColumn();
	}
}

?>