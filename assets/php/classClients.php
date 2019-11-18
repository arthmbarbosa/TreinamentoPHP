<?php 

require_once 'assets/php/database.php';

class Clients{

	private $id;
	private $cpf;
	private $name;
	private $gender;

	public function __construct(){
		$database = new Database();
		$this->conn = $database->dbSet();
	}

	public function setID($id){
		$this->id = $id;
	}

	public function setCPF($cpf){
		$this->cpf = $cpf;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function setGender($gender){
		$this->gender = $gender;
	}

	 public function index(){
        $query = "SELECT * FROM `clients` WHERE 1";
        $stmt = $this->conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function delete(){
    	$stmt = $this->conn->prepare("DELETE FROM clients WHERE id = :id;");
    	$stmt->bindParam(":id", $this->id);
    	try {
    		return $stmt->execute();
    	} catch (PDOException $e) {
    		echo $e->getMessage();
    		return null;
    	}
    }

    public function insert(){
    	$stmt = $this->conn->prepare("INSERT INTO clients(cpf, name, gender) VALUES (:cpf, :name, :gender);");
    	$stmt->bindParam(":cpf", $this->cpf);
    	$stmt->bindParam(":name", $this->name);
    	$stmt->bindParam(":gender", $this->gender);

    	try {
    		$stmt->execute();
    		return $this->conn->lastInsertId();
    		
    	} catch (PDOException $e) {
    		echo $e->getMessage();
    	}
    }

    public function update(){
    	$stmt = $this->conn->prepare("UPDATE clients SET cpf=:cpf, name=:name, gender=:gender WHERE id= :id;");
    	$stmt->bindParam(":id", $this->id);
    	$stmt->bindParam(":cpf", $this->cpf);
    	$stmt->bindParam(":name", $this->name);
    	$stmt->bindParam(":gender", $this->gender);

    	try {
    		return $stmt->execute();
    		
    	} catch (PDOException $e) {
    		echo $e->getMessage();
    		return null;
    		
    	}
    }

    	public function view(){
		$stmt = $this->conn->prepare("SELECT * FROM clients WHERE id = :id;");
		$stmt->bindParam(":id", $this->id);
		try {
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_OBJ);
		} catch (PDOException $e) {
			echo $e->getMessage();
			return null;
		}
	}

}


?>