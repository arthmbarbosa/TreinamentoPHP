<?php 
    
class Database
{
    private $host = "localhost"; //IP do servidor (localhost para servidor local)
    private $db_name = "store"; //Nome do banco de dados a ser utilizado
    private $username = "root"; //Seu usuário do BD
    private $password = ""; //Sua senha do BD
    public $conn;

    public function dbSet()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}

?>