<?php
require_once dirname(__DIR__) . '/config/config.php';

class Category {
    private $pdo;

    public function __construct() {
        $db = new DataB();
        $this->pdo = $db->getDataB();
    }

    public function getAllCategories() {
        $query = "SELECT * FROM categories ORDER BY name ASC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
