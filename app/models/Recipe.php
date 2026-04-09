<?php
require_once dirname(__DIR__) . '/config/config.php';

class Recipe {
    private $pdo;
    public function __construct() { $this->pdo = (new DataB())->getDataB(); }

    public function addRecipe($d) {
        return $this->pdo->prepare("INSERT INTO recipes (users_id, categories_id, title, temp_de_production, ingredient, instructions, portions) VALUES (?,?,?,?,?,?,?)")
                         ->execute([$d['user_id'], $d['category_id'], $d['title'], $d['temp_de_production'], $d['ingredient'], $d['instructions'], $d['portions']]);
    }

    public function getRecipesByUser($id) {
        $st = $this->pdo->prepare("SELECT r.*, c.name as category_name FROM recipes r LEFT JOIN categories c ON r.categories_id = c.id WHERE users_id = ? ORDER BY create_time DESC");
        $st->execute([$id]);
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRecipeById($id, $uid) {
        $st = $this->pdo->prepare("SELECT * FROM recipes WHERE id = ? AND users_id = ? LIMIT 1");
        $st->execute([$id, $uid]);
        return $st->fetch(PDO::FETCH_ASSOC);
    }

    public function updateRecipe($d) {
        return $this->pdo->prepare("UPDATE recipes SET categories_id=?, title=?, temp_de_production=?, ingredient=?, instructions=?, portions=? WHERE id=? AND users_id=?")
                         ->execute([$d['category_id'], $d['title'], $d['temp_de_production'], $d['ingredient'], $d['instructions'], $d['portions'], $d['id'], $d['user_id']]);
    }

    public function deleteRecipe($id, $uid) {
        return $this->pdo->prepare("DELETE FROM recipes WHERE id = ? AND users_id = ?")->execute([$id, $uid]);
    }
}
