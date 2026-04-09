<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
class RecipeController {
    private $recipeModel;

    public function __construct() {
       
      
        if (!isset($_SESSION['user_id'])) {
            header('Location: login.php');
            exit();
        }

        require_once dirname(__DIR__) . '/models/Recipe.php';
        $this->recipeModel = new Recipe();
    }

 
    public function index() {
        $userId = $_SESSION['user_id'];
        $recipes = $this->recipeModel->getRecipesByUser($userId);
        
      
        require_once dirname(__DIR__) . '/Views/recipes/index.php';
    }

  
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'user_id' => $_SESSION['user_id'],
                'category_id' => $_POST['category_id'],
                'title' => htmlspecialchars($_POST['title']),
                'temp_de_production' => htmlspecialchars($_POST['temp_de_production']),
                'ingredient' => htmlspecialchars($_POST['ingredient']),
                'instructions' => htmlspecialchars($_POST['instructions']),
                'portions' => htmlspecialchars($_POST['portions'])
            ];

            if ($this->recipeModel->addRecipe($data)) {
                header('Location: index.php?success=added');
                exit();
            }
        }
    }

  
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id' => $id,
                'category_id' => $_POST['category_id'],
                'title' => htmlspecialchars($_POST['title']),
                'temp_de_production' => htmlspecialchars($_POST['temp_de_production']),
                'ingredient' => htmlspecialchars($_POST['ingredient']),
                'instructions' => htmlspecialchars($_POST['instructions']),
                'portions' => htmlspecialchars($_POST['portions'])
            ];

            if ($this->recipeModel->updateRecipe($data)) {
                header('Location: index.php?success=updated');
                exit();
            }
        }
    }


    public function delete($id) {
        if ($this->recipeModel->deleteRecipe($id, $_SESSION['user_id'])) {
            header('Location: index.php?success=deleted');
            exit();
        }
    }
}