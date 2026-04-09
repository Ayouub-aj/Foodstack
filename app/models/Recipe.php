<?php
require_once dirname(__DIR__) . '/config/config.php';

class Recipe {
    private $pdo;

    public function __construct() {
        $db = new DataB();
        $this->pdo = $db->getDataB();
    }

    public function getRecipesByUser($userId) {
        $query = "SELECT recipes.*, categories.name as category_name 
                  FROM recipes 
                  LEFT JOIN categories ON recipes.categories_id = categories.id
                  WHERE users_id = :user_id 
                  ORDER BY create_time DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRecipeById($id, $userId) {
        $query = "SELECT * FROM recipes WHERE id = :id AND users_id = :user_id LIMIT 1";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addRecipe($data) {
        $query = "INSERT INTO recipes (users_id, categories_id, title, temp_de_production, ingredient, instructions, portions) 
                  VALUES (:user_id, :category_id, :title, :temp_de_production, :ingredient, :instructions, :portions)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':user_id', $data['user_id']);
        $stmt->bindParam(':category_id', $data['category_id']);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':temp_de_production', $data['temp_de_production']);
        $stmt->bindParam(':ingredient', $data['ingredient']);
        $stmt->bindParam(':instructions', $data['instructions']);
        $stmt->bindParam(':portions', $data['portions']);
        return $stmt->execute();
    }

    public function updateRecipe($data) {
        $query = "UPDATE recipes 
                  SET categories_id = :category_id, title = :title, temp_de_production = :temp_de_production, 
                      ingredient = :ingredient, instructions = :instructions, portions = :portions 
                  WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $data['id']);
        $stmt->bindParam(':category_id', $data['category_id']);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':temp_de_production', $data['temp_de_production']);
        $stmt->bindParam(':ingredient', $data['ingredient']);
        $stmt->bindParam(':instructions', $data['instructions']);
        $stmt->bindParam(':portions', $data['portions']);
        return $stmt->execute();
        
    }

    public function deleteRecipe($id, $userId) {
        $query = "DELETE FROM recipes WHERE id = :id AND users_id = :user_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':user_id', $userId);
        return $stmt->execute();
    }
}
?>
