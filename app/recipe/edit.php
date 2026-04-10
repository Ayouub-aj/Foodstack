<?php
require_once dirname(__DIR__, 2) . '/config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: ../dashboard.php");
    exit;
}

$r_id = $_GET['id'];
$u_id = $_SESSION['user_id'];
$error = "";
$success = "";

try {
    $catStmt = $pdo->query("SELECT id_category as id, name FROM categories ORDER BY name ASC");
    $categories = $catStmt->fetchAll();
} catch (PDOException $e) {
    $error = "Failed to load categories.";
}

try {
    // Ownership check: session user must own the recipe
    $stmt = $pdo->prepare("SELECT * FROM recipes WHERE id_recipe = ? AND user_id = ?");
    $stmt->execute([$r_id, $u_id]);
    $recipe = $stmt->fetch();

    if (!$recipe) {
        header("Location: ../dashboard.php");
        exit;
    }
} catch (PDOException $e) {
    die("Database failure: " . $e->getMessage());
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
        $error = "Please fill in all required fields.";
    } else {
        try {
            $sql = "UPDATE recipes SET 
                        title = ?, 
                        category_id = ?, 
                        ingredients = ?, 
                        instructions = ?, 
                        prep_time = ?, 
                        cooking_time = ?, 
                        servings = ? 
                    WHERE id_recipe = ? AND user_id = ?";
            $update = $pdo->prepare($sql);
            $update->execute([$title, $category_id, $ingredients, $instructions, $prep_time, $cooking_time, $servings, $r_id, $u_id]);
            
            $success = "Recipe updated successfully! <a href='view.php?id=$r_id' class='fw-bold text-success'>View Changes</a>";
            
            // Update local recipe object for form re-fill
            $recipe['title'] = $title;
            $recipe['category_id'] = $category_id;
            $recipe['ingredients'] = $ingredients;
            $recipe['instructions'] = $instructions;
            $recipe['prep_time'] = $prep_time;
            $recipe['cooking_time'] = $cooking_time;
            $recipe['servings'] = $servings;
        } catch (PDOException $e) {
            $error = "Update failed: " . $e->getMessage();
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
                    <li class="breadcrumb-item active" aria-current="page">Edit Recipe</li>
                </ol>
            </nav>

            <div class="card shadow rounded-4 border-0 p-4">
                <div class="card-body">
                    <h2 class="fw-bold mb-1">Modify Recipe</h2>
                    <p class="text-muted mb-4">Editing: <span class="fw-bold text-dark"><?php echo htmlspecialchars($recipe['title']); ?></span></p>

                    <?php if ($error): ?>
                        <div class="alert alert-danger shadow-sm border-0"><?php echo htmlspecialchars($error); ?></div>
                    <?php endif; ?>

                    <?php if ($success): ?>
                        <div class="alert alert-success shadow-sm border-0"><?php echo $success; ?></div>
                    <?php endif; ?>

                    <form action="edit.php?id=<?php echo $r_id; ?>" method="POST">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label for="title" class="form-label fw-bold small text-uppercase letter-spacing-1">Recipe Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="<?php echo htmlspecialchars($recipe['title']); ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="category_id" class="form-label fw-bold small text-uppercase letter-spacing-1">Category</label>
                                <select name="category_id" id="category_id" class="form-select" required>
                                    <?php foreach ($categories as $cat): ?>
                                        <option value="<?php echo $cat['id']; ?>" <?php echo ($cat['id'] == $recipe['category_id']) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($cat['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="col-md-4">
                                <label for="prep_time" class="form-label fw-bold small text-uppercase letter-spacing-1">Prep Time (min)</label>
                                <input type="number" name="prep_time" id="prep_time" class="form-control" value="<?php echo htmlspecialchars($recipe['prep_time']); ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="cooking_time" class="form-label fw-bold small text-uppercase letter-spacing-1">Cook Time (min)</label>
                                <input type="number" name="cooking_time" id="cooking_time" class="form-control" value="<?php echo htmlspecialchars($recipe['cooking_time']); ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="servings" class="form-label fw-bold small text-uppercase letter-spacing-1">Servings</label>
                                <input type="number" name="servings" id="servings" class="form-control" value="<?php echo htmlspecialchars($recipe['servings']); ?>">
                            </div>

                            <div class="col-12 mt-4">
                                <label for="ingredients" class="form-label fw-bold small text-uppercase letter-spacing-1">Ingredients</label>
                                <textarea name="ingredients" id="ingredients" rows="5" class="form-control" required><?php echo htmlspecialchars($recipe['ingredients']); ?></textarea>
                            </div>

                            <div class="col-12 mt-4">
                                <label for="instructions" class="form-label fw-bold small text-uppercase letter-spacing-1">Instructions</label>
                                <textarea name="instructions" id="instructions" rows="8" class="form-control" required><?php echo htmlspecialchars($recipe['instructions']); ?></textarea>
                            </div>
                        </div>

                        <div class="mt-5 border-top pt-4 text-end">
                            <a href="../dashboard.php" class="btn btn-light px-4 me-2 rounded-pill fw-bold">Cancel</a>
                            <button type="submit" class="btn btn-dark px-5 py-2 fw-bold rounded-pill shadow-sm">Save Changes</button>
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
