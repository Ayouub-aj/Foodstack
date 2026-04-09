<?php
require_once dirname(__DIR__) . '/config/config.php';

class User {
    private $pdo;
    public function __construct() { $this->pdo = (new DataB())->getDataB(); }

    public function createUser($u, $e, $p) {
        return $this->pdo->prepare("INSERT INTO users (username, email, password) VALUES (?,?,?)")->execute([$u, $e, $p]);
    }

    public function getUserByEmail($e) {
        $st = $this->pdo->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
        $st->execute([$e]);
        return $st->fetch(PDO::FETCH_ASSOC);
    }
}
?>
