<?php
class DataB {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "foodstack";
    private $pdo;

    public function __construct() {
        $this->pdo = null;
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=utf8mb4";
            $this->pdo = new PDO($dsn, $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }
}
?>
