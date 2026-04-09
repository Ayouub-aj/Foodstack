<?php
if (session_status() === PHP_SESSION_NONE) session_start();

class RecipeController {
    private $md;
    public function __construct() {
        if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit(); }
        require_once dirname(__DIR__) . '/models/Recipe.php';
        $this->md = new Recipe();
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $d = $_POST; $d['user_id'] = $_SESSION['user_id'];
            foreach($d as &$v) $v = htmlspecialchars($v);
            if ($this->md->addRecipe($d)) { header('Location: index.php?success=added'); exit(); }
        }
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $d = $_POST; $d['id'] = $id; $d['user_id'] = $_SESSION['user_id'];
            foreach($d as &$v) $v = htmlspecialchars($v);
            if ($this->md->updateRecipe($d)) { header('Location: index.php?success=updated'); exit(); }
        }
    }

    public function delete($id) {
        if ($this->md->deleteRecipe($id, $_SESSION['user_id'])) { header('Location: index.php?success=deleted'); exit(); }
    }
}
?>