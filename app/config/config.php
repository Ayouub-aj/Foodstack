<?php
class DataB{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "foodstack";
    private $pdo;


    function __construct(){
        $this->pdo = null;
        try{
        $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pass);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
        }
        catch(PDOException $e){
            die("Error: " . $e->getMessage());
        }
  }
  public function getDataB(){
    return $this->pdo;
  }
}
$kaw = new DataB;
$kaw->getDataB();






?>