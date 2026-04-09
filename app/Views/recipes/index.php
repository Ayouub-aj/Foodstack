<?php
require_once dirname(dirname(__DIR__)) . '/controllers/recipecontroller.php';
$controller = new RecipeController();
$userId = $_SESSION['user_id'];

require_once dirname(dirname(__DIR__)) . '/models/Recipe.php';
require_once dirname(dirname(__DIR__)) . '/models/Category.php';
$recipeModel = new Recipe();
$categoryModel = new Category();

// Handle Filter
$categoryId = $_GET['category'] ?? null;

// Handle Form Submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'store') {
        $controller->store();
    } elseif ($_POST['action'] === 'update' && isset($_POST['id'])) {
        $controller->update($_POST['id']);
    }
}

// Handle Delete Action
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $controller->delete($_GET['id']);
}

// Fetch Data
$categories = $categoryModel->getAllCategories();

// If filtering
if ($categoryId) {
    // We need a filtered method in model or just filter the array
    $allRecipes = $recipeModel->getRecipesByUser($userId);
    $recipes = array_filter($allRecipes, function($r) use ($categoryId) {
        return $r['categories_id'] == $categoryId;
    });
} else {
    $recipes = $recipeModel->getRecipesByUser($userId);
}

// Handle Edit Mode (fetch recipe for form)
$editRecipe = null;
if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
    $editRecipe = $recipeModel->getRecipeById($_GET['id'], $userId);
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Recettes - FoodStack</title>
    <link rel="stylesheet" href="../../public/main.css">
    <style>
        .dashboard-container { max-width: 1200px; margin: 40px auto; padding: 20px; }
        
        .header-actions { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 40px; 
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            padding: 20px 30px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .header-actions h1 { font-size: 32px; font-weight: 600; letter-spacing: 0.5px; }
        
        .add-btn { 
            background: #ff5e62; 
            color: white; 
            padding: 12px 24px; 
            border-radius: 12px; 
            text-decoration: none; 
            font-weight: 600; 
            box-shadow: 0 10px 20px rgba(255, 94, 98, 0.3); 
            transition: all 0.3s ease; 
        }
        .add-btn:hover { background: #ff4a4e; transform: translateY(-3px); box-shadow: 0 15px 25px rgba(255, 94, 98, 0.4); }
        
        .logout-btn { 
            background: rgba(255, 255, 255, 0.2); 
            color: #fff; 
            padding: 12px 20px; 
            border-radius: 12px; 
            text-decoration: none; 
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .logout-btn:hover { background: rgba(255, 255, 255, 0.3); transform: translateY(-2px); }

        .recipes-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); 
            gap: 30px; 
        }
        
        .recipe-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            padding: 25px;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }
        .recipe-card:hover { transform: translateY(-5px); box-shadow: 0 15px 35px rgba(0,0,0,0.15); }
        
        .recipe-title { font-size: 22px; font-weight: 600; margin-bottom: 15px; color: #fff; }
        
        .recipe-meta { 
            font-size: 14px; 
            opacity: 0.9; 
            margin-bottom: 15px; 
            display: flex; 
            justify-content: space-between; 
            background: rgba(0,0,0,0.1); 
            padding: 8px 12px; 
            border-radius: 8px;
        }
        
        .recipe-desc { 
            font-size: 14px; 
            line-height: 1.6; 
            opacity: 0.9; 
            margin-bottom: 25px; 
            flex-grow: 1;
        }
        
        .card-actions { display: flex; gap: 10px; margin-top: auto; }
        
        .btn-edit, .btn-delete { 
            padding: 10px 16px; 
            border-radius: 10px; 
            font-size: 14px; 
            font-weight: 600; 
            text-decoration: none; 
            text-align: center; 
            flex: 1; 
            transition: all 0.3s ease;
        }
        .btn-edit { background: rgba(255, 255, 255, 0.2); color: white; }
        .btn-edit:hover { background: rgba(255, 255, 255, 0.3); }
        .btn-delete { background: rgba(255, 59, 48, 0.6); color: white; }
        .btn-delete:hover { background: rgba(255, 59, 48, 0.9); }
        
        .empty-state { 
            text-align: center; 
            grid-column: 1 / -1; 
            padding: 80px 20px; 
            background: rgba(255, 255, 255, 0.1); 
            backdrop-filter: blur(15px);
            border-radius: 20px; 
            border: 1px dashed rgba(255,255,255,0.4);
        }
        .empty-state h2 { font-size: 28px; margin-bottom: 10px; }
        
        .badge {
            background: rgba(255, 255, 255, 0.15);
            padding: 12px;
            border-radius: 12px;
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
        }

        .add-recipe-form {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 40px;
            display: none; /* Hidden by default */
        }
        .add-recipe-form.active { display: block; animation: slideDown 0.4s ease-out; }
        
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px; }
        .input-group { display: flex; flex-direction: column; gap: 8px; }
        .input-group label { font-size: 14px; font-weight: 600; opacity: 0.8; }
        .input-group input, .input-group select, .input-group textarea {
            background: rgba(0,0,0,0.2);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            padding: 12px;
            color: white;
        }
        .btn-save { background: #ff5e62; color: white; border: none; padding: 15px; border-radius: 10px; font-weight: 700; cursor: pointer; }
    </style>
    <script>
        function toggleAddForm() {
            const form = document.getElementById('addForm');
            form.classList.toggle('active');
        }
    </script>
</head>
<body>

    <div class="dashboard-container">
        <div class="header-actions">
            <h1>Mes Recettes 🍽️</h1>
            <div style="display: flex; gap: 15px; align-items: center;">
                <form action="index.php" method="GET" style="display: flex; gap: 10px; align-items: center;">
                    <select name="category" onchange="this.form.submit()" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: white; padding: 8px 15px; border-radius: 10px;">
                        <option value="">Toutes les catégories</option>
                        <?php foreach($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>" <?= $categoryId == $cat['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cat['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </form>
                <a href="javascript:void(0)" onclick="toggleAddForm()" class="add-btn">+ Nouvelle Recette</a>
                <a href="../auth/login.php?action=logout" class="logout-btn" style="margin-left: 10px;">Déconnexion</a>
            </div>
        </div>

        <?php if ($editRecipe): ?>
        <div id="editForm" class="add-recipe-form active" style="border-color: #ff5e62;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2>✏️ Modifier: <?= htmlspecialchars($editRecipe['title']) ?></h2>
                <a href="index.php" style="color: white; text-decoration: none; opacity: 0.6;">Annuler</a>
            </div>
            <form action="index.php" method="POST">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="id" value="<?= $editRecipe['id'] ?>">
                <div class="form-grid">
                    <div class="input-group">
                        <label>Titre</label>
                        <input type="text" name="title" value="<?= htmlspecialchars($editRecipe['title']) ?>" required>
                    </div>
                    <div class="input-group">
                        <label>Catégorie</label>
                        <select name="category_id" required>
                            <?php foreach($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>" <?= $editRecipe['categories_id'] == $cat['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($cat['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input-group">
                        <label>Temps (min)</label>
                        <input type="text" name="temp_de_production" value="<?= htmlspecialchars($editRecipe['temp_de_production']) ?>" required>
                    </div>
                    <div class="input-group">
                        <label>Portions</label>
                        <input type="number" name="portions" value="<?= htmlspecialchars($editRecipe['portions']) ?>" required>
                    </div>
                </div>
                <div class="input-group" style="margin-bottom: 20px;">
                    <label>Ingrédients</label>
                    <textarea name="ingredient" rows="4" required><?= htmlspecialchars($editRecipe['ingredient']) ?></textarea>
                </div>
                <div class="input-group" style="margin-bottom: 20px;">
                    <label>Instructions</label>
                    <textarea name="instructions" rows="4" required><?= htmlspecialchars($editRecipe['instructions']) ?></textarea>
                </div>
                <button type="submit" class="btn-save">Mettre à jour la recette</button>
            </form>
        </div>
        <?php endif; ?>

        <div id="addForm" class="add-recipe-form">
            <h2 style="margin-bottom: 20px;">🍳 Nouvelle Recette</h2>
            <form action="index.php" method="POST">
                <input type="hidden" name="action" value="store">
                <div class="form-grid">
                    <div class="input-group">
                        <label>Titre</label>
                        <input type="text" name="title" required placeholder="Ex: Lasagnes">
                    </div>
                    <div class="input-group">
                        <label>Catégorie</label>
                        <select name="category_id" required>
                            <?php foreach($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input-group">
                        <label>Temps (min)</label>
                        <input type="text" name="temp_de_production" required placeholder="Ex: 45 min">
                    </div>
                    <div class="input-group">
                        <label>Portions</label>
                        <input type="number" name="portions" required placeholder="Ex: 4">
                    </div>
                </div>
                <div class="input-group" style="margin-bottom: 20px;">
                    <label>Ingrédients</label>
                    <textarea name="ingredient" rows="4" required></textarea>
                </div>
                <div class="input-group" style="margin-bottom: 20px;">
                    <label>Instructions</label>
                    <textarea name="instructions" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn-save">Enregistrer la recette</button>
            </form>
        </div>

        <?php if(isset($_GET['success'])): ?>
            <div class="badge">
                <?php 
                    if($_GET['success'] === 'added') echo "✅ Recette ajoutée avec succès !";
                    elseif($_GET['success'] === 'updated') echo "✅ Recette modifiée avec succès !";
                    elseif($_GET['success'] === 'deleted') echo "✅ Recette supprimée avec succès !";
                ?>
            </div>
        <?php endif; ?>

        <div class="recipe-grid">
            <?php if (!empty($recipes)): ?>
                <?php foreach ($recipes as $recipe): ?>
                    <div class="recipe-card">
                        <h3 class="recipe-title"><?= htmlspecialchars($recipe['title']) ?></h3>
                        <div style="font-size: 12px; margin-bottom: 10px; opacity: 0.7; color: #ff5e62; font-weight: 600;">
                            📂 <?= htmlspecialchars($recipe['category_name'] ?? 'Non classé') ?>
                        </div>
                        <div class="recipe-meta">
                            <span>⏱️ <?= htmlspecialchars($recipe['temp_de_production']) ?></span>
                            <span>📅 <?= date('d/m/Y', strtotime($recipe['create_time'])) ?></span>
                        </div>
                        <div class="recipe-desc" style="font-size: 12px; margin-top: 10px;">
                             👤 Portions: <?= htmlspecialchars($recipe['portions']) ?>
                        </div>
                        <div class="recipe-desc">
                            <strong>Ingrédients:</strong><br>
                            <?= nl2br(htmlspecialchars(substr($recipe['ingredient'], 0, 100))) ?><?= strlen($recipe['ingredient']) > 100 ? '...' : '' ?>
                        </div>
                        <div class="card-actions">
                             <a href="index.php?action=edit&id=<?= $recipe['id'] ?>" class="btn-edit">Modifier</a>
                             <a href="index.php?action=delete&id=<?= $recipe['id'] ?>" class="btn-delete" onclick="return confirm('Supprimer définitivement cette recette ?');">Supprimer</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-state">
                    <h2>Vous n'avez pas encore de recettes ! 🍳</h2>
                    <p style="opacity:0.8; margin-top:10px; font-size: 16px;">Appuyez sur le bouton "+ Nouvelle Recette" pour commencer votre aventure culinaire.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>
