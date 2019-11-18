<?php 

require_once 'assets/php/database.php';

class Phones{

	private $id;
	private $number;
	private $client_id;

	public function __construct(){
		$database = new Database();
		$this->conn =$database->dbSet();
	}

	public function setNumber($number){
		$this->number = $number;
	}

	public function setClient($client_id){
		$this->client_id = $client_id;
	}

	public function insert(){
		  $stmt = $this->conn->prepare("INSERT INTO phones(number, client_id) VALUES (:number, :client_id);");
    	$stmt->bindParam(":number", $this->number);
    	$stmt->bindParam(":client_id", $this->client_id);

    	try {
    		return $stmt->execute();
    		
    	} catch (PDOException $e) {
    		echo $e->getMessage();
    		
    	}
	}
	public function view($client_id){
		$stmt = $this->conn->prepare("SELECT number FROM phones WHERE client_id = :client_id;");
		$stmt->bindParam(":client_id", $client_id);
		try {
			$stmt->execute();
			return $stmt;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return null;
		}
	}
}
?>