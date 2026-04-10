<?php
require_once dirname(__DIR__, 2) . '/config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$u_id = $_SESSION['user_id'];
$error = "";
$title = "";
$category_id = "";
$ingredients = "";
$instructions = "";
$prep_time = "";
$cooking_time = "";
$servings = "";

try {
    $catStmt = $pdo->query("SELECT id_category as id, name FROM categories ORDER BY name ASC");
    $categories = $catStmt->fetchAll();
} catch (PDOException $e) {
    $error = "Failed to load categories.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title        = trim($_POST['title']);
    $category_id  = $_POST['category_id'];
    $ingredients  = trim($_POST['ingredients']);
    $instructions = trim($_POST['instructions']);
    $prep_time    = !empty($_POST['prep_time']) ? (int)$_POST['prep_time'] : null;
    $cooking_time = !empty($_POST['cooking_time']) ? (int)$_POST['cooking_time'] : null;
    $servings     = !empty($_POST['servings']) ? (int)$_POST['servings'] : null;

    if (empty($title) || empty($category_id) || empty($ingredients) || empty($instructions)) {
        $error = "Please fill in all required fields (Title, Category, Ingredients, and Instructions).";
    } else {
        try {
            $sql = "INSERT INTO recipes (user_id, category_id, title, ingredients, instructions, prep_time, cooking_time, servings) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $insert = $pdo->prepare($sql);
            $insert->execute([$u_id, $category_id, $title, $ingredients, $instructions, $prep_time, $cooking_time, $servings]);
            
            $new_id = $pdo->lastInsertId();
            header("Location: view.php?id=$new_id");
            exit;
        } catch (PDOException $e) {
            $error = "Creation failed: " . $e->getMessage();
        }
    }
}

require_once dirname(__DIR__, 2) . '/includes/header.php';
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard.php" class="text-success text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">New Recipe</li>
                </ol>
            </nav>

            <div class="card shadow rounded-4 border-0 p-4">
                <div class="card-body">
                    <h2 class="fw-bold mb-1">Create New Recipe</h2>
                    <p class="text-muted mb-4">Share your culinary creation with the community.</p>

                    <?php if ($error): ?>
                        <div class="alert alert-danger shadow-sm border-0"><?php echo htmlspecialchars($error); ?></div>
                    <?php endif; ?>

                    <form action="create.php" method="POST">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label for="title" class="form-label fw-bold small text-uppercase letter-spacing-1">Recipe Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="<?php echo htmlspecialchars($title); ?>" placeholder="e.g. Traditional Marrakech Tajine" required>
                            </div>
                            <div class="col-md-4">
                                <label for="category_id" class="form-label fw-bold small text-uppercase letter-spacing-1">Category</label>
                                <select name="category_id" id="category_id" class="form-select" required>
                                    <option value="" disabled selected>Select category...</option>
                                    <?php foreach ($categories as $cat): ?>
                                        <option value="<?php echo $cat['id']; ?>" <?php echo ($cat['id'] == $category_id) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($cat['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="col-md-4">
                                <label for="prep_time" class="form-label fw-bold small text-uppercase letter-spacing-1">Prep Time (min)</label>
                                <input type="number" name="prep_time" id="prep_time" class="form-control" value="<?php echo htmlspecialchars($prep_time); ?>" placeholder="e.g. 20">
                            </div>
                            <div class="col-md-4">
                                <label for="cooking_time" class="form-label fw-bold small text-uppercase letter-spacing-1">Cook Time (min)</label>
                                <input type="number" name="cooking_time" id="cooking_time" class="form-control" value="<?php echo htmlspecialchars($cooking_time); ?>" placeholder="e.g. 45">
                            </div>
                            <div class="col-md-4">
                                <label for="servings" class="form-label fw-bold small text-uppercase letter-spacing-1">Servings</label>
                                <input type="number" name="servings" id="servings" class="form-control" value="<?php echo htmlspecialchars($servings); ?>" placeholder="e.g. 4">
                            </div>

                            <div class="col-12 mt-4">
                                <label for="ingredients" class="form-label fw-bold small text-uppercase letter-spacing-1">Ingredients</label>
                                <textarea name="ingredients" id="ingredients" rows="5" class="form-control" placeholder="List your ingredients here..." required><?php echo htmlspecialchars($ingredients); ?></textarea>
                            </div>

                            <div class="col-12 mt-4">
                                <label for="instructions" class="form-label fw-bold small text-uppercase letter-spacing-1">Instructions</label>
                                <textarea name="instructions" id="instructions" rows="8" class="form-control" placeholder="Step by step preparation guide..." required><?php echo htmlspecialchars($instructions); ?></textarea>
                            </div>
                        </div>

                        <div class="mt-5 border-top pt-4 text-end">
                            <a href="../dashboard.php" class="btn btn-light px-4 me-2 rounded-pill fw-bold">Discard</a>
                            <button type="submit" class="btn btn-dark px-5 py-2 fw-bold rounded-pill shadow-sm">Publish Recipe &rarr;</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
require_once dirname(__DIR__, 2) . '/includes/footer.php'; 
?>
