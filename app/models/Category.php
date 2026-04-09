<?php
require_once dirname(__DIR__) . '/config/config.php';

class Category {
    private $pdo;
    public function __construct() { $this->pdo = (new DataB())->getDataB(); }
    public function getAllCategories() {
        return $this->pdo->query("SELECT * FROM categories ORDER BY name ASC")->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
