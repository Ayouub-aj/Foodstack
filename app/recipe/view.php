<?php
require_once dirname(__DIR__, 2) . '/config/db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: ../index.php");
    exit;
}

$r_id = $_GET['id'];

try {
    $stmt = $pdo->prepare("
        SELECT 
            p.*, 
            u.username AS author, 
            c.name AS category 
        FROM recipes p
        INNER JOIN users u ON p.user_id = u.id_user
        INNER JOIN categories c ON p.category_id = c.id_category
        WHERE p.id_recipe = ?
    ");
    $stmt->execute([$r_id]);
    $recipe = $stmt->fetch();

    if (!$recipe) {
        throw new Exception("Recipe not found.");
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}

require_once dirname(__DIR__, 2) . '/includes/header.php';
?>

<div class="recipe-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="../index.php" class="text-primary text-decoration-none">Recipes</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($recipe['title']); ?></li>
                    </ol>
                </nav>
                <span class="badge bg-primary bg-opacity-10 text-primary fw-bold text-uppercase px-3 py-2 rounded-pill mb-3">
                    <?php echo htmlspecialchars($recipe['category']); ?>
                </span>
                <h1 class="display-3 fw-900 mb-4"><?php echo htmlspecialchars($recipe['title']); ?></h1>
                <div class="d-flex align-items-center gap-4 text-secondary">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-person-circle fs-5"></i>
                        <span class="fw-bold text-dark">@<?php echo htmlspecialchars($recipe['author']); ?></span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-calendar3 fs-5"></i>
                        <span><?php echo date('M d, Y', strtotime($recipe['created_at'])); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5 mt-4">
    <div class="row g-5">
        <div class="col-lg-4">
            <div class="sticky-top" style="top: 100px;">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-light">
                    <h4 class="section-title small text-uppercase">Technical Details</h4>
                    <div class="row g-3">
                        <?php if ($recipe['prep_time']): ?>
                        <div class="col-6">
                            <div class="p-3 bg-white rounded-3 border text-center">
                                <span class="text-muted d-block small fw-bold text-uppercase">Prep Time</span>
                                <span class="h4 fw-900 mb-0"><?php echo $recipe['prep_time']; ?> min</span>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if ($recipe['cooking_time']): ?>
                        <div class="col-6">
                            <div class="p-3 bg-white rounded-3 border text-center">
                                <span class="text-muted d-block small fw-bold text-uppercase">Cook Time</span>
                                <span class="h4 fw-900 mb-0"><?php echo $recipe['cooking_time']; ?> min</span>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if ($recipe['servings']): ?>
                        <div class="col-12">
                            <div class="p-3 bg-white rounded-3 border text-center">
                                <span class="text-muted d-block small fw-bold text-uppercase">Servings</span>
                                <span class="h4 fw-900 mb-0"><?php echo $recipe['servings']; ?> Pers.</span>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <a href="download.php?id=<?php echo $r_id; ?>" class="btn btn-dark py-3">
                        <i class="bi bi-file-earmark-arrow-down me-2"></i> Download Recipe
                    </a>
                    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $recipe['user_id']): ?>
                        <a href="edit.php?id=<?php echo $r_id; ?>" class="btn btn-outline-dark py-3">Edit Details</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="mb-5">
                <h3 class="section-title">Common Ingredients</h3>
                <div class="p-4 bg-light rounded-4 border-start border-4 border-primary">
                    <p style="white-space: pre-wrap; font-size: 1.1rem; line-height: 1.8;" class="text-dark">
                        <?php echo htmlspecialchars($recipe['ingredients']); ?>
                    </p>
                </div>
            </div>

            <div class="mb-5">
                <h3 class="section-title">Preparation Method</h3>
                <div style="white-space: pre-wrap; font-size: 1.2rem; line-height: 2;" class="text-secondary ps-2">
                    <?php echo htmlspecialchars($recipe['instructions']); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
require_once dirname(__DIR__, 2) . '/includes/footer.php'; 
?>
