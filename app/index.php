<?php
require_once dirname(__DIR__) . '/config/db.php';

$search   = isset($_GET['search']) ? trim($_GET['search']) : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';
$sort     = isset($_GET['sort']) ? $_GET['sort'] : 'newest';
$page     = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$limit    = 9;
$offset   = ($page - 1) * $limit;

// Initialize variables to prevent undefined variable warnings
$totalCount = 0;
$prompts    = [];
$categories = [];
$totalPages = 0;
$error      = null;

try {
    $baseQuery = "
        FROM recipes p
        INNER JOIN users u ON p.user_id = u.id_user
        INNER JOIN categories c ON p.category_id = c.id_category
        WHERE 1=1
    ";
    
    $params = [];

    if (!empty($search)) {
        $baseQuery .= " AND (p.title LIKE ? OR p.ingredients LIKE ? OR p.instructions LIKE ?)";
        $params[] = "%$search%";
        $params[] = "%$search%";
        $params[] = "%$search%";
    }

    if (!empty($category) && is_numeric($category)) {
        $baseQuery .= " AND p.category_id = ?";
        $params[] = (int)$category;
    }

    $countStmt = $pdo->prepare("SELECT COUNT(*) $baseQuery");
    $countStmt->execute($params);
    $totalCount = $countStmt->fetchColumn();
    $totalPages = ceil($totalCount / $limit);

    $orderBy = ($sort === 'oldest') ? 'p.created_at ASC' : 'p.created_at DESC';
    $mainStmt = $pdo->prepare("SELECT p.*, u.username as author, c.name as category $baseQuery ORDER BY $orderBy LIMIT $limit OFFSET $offset");
    $mainStmt->execute($params);
    $prompts = $mainStmt->fetchAll();

    $catStmt = $pdo->query("SELECT id_category as id, name FROM categories ORDER BY name ASC");
    $categories = $catStmt->fetchAll();

} catch (PDOException $e) {
    echo $e->getMessage();
}

require_once dirname(__DIR__) . '/includes/header.php';
?>

<div class="container-wide py-5">
    <div class="row g-5 mt-4">
        <!-- Sidebar Filters -->
        <div class="col-lg-3">
            <div class="filter-sidebar">
                <h3 class="sidebar-title">Filters:</h3>
                
                <form action="index.php" method="GET">
                    <div class="mb-4">
                        <label class="form-label">Search...</label>
                        <input type="text" name="search" class="form-control search-input" value="<?php echo htmlspecialchars($search); ?>" placeholder="Keywords...">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Category :</label>
                        <select name="category" class="form-select select-input">
                            <option value="">-- All Categories --</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?php echo $cat['id']; ?>" <?php echo ($cat['id'] == $category) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($cat['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Sort By :</label>
                        <select name="sort" class="form-select select-input">
                            <option value="newest" <?php echo ($sort === 'newest') ? 'selected' : ''; ?>>Newest First</option>
                            <option value="oldest" <?php echo ($sort === 'oldest') ? 'selected' : ''; ?>>Oldest First</option>
                        </select>
                    </div>

                    <div class="d-grid mt-5">
                        <button type="submit" class="btn btn-primary btn-lg">Apply Filters</button>
                        <?php if (!empty($search) || !empty($category)): ?>
                            <a href="index.php" class="btn btn-link text-muted mt-2 small">Reset All</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>

        <!-- Recipe Gallery -->
        <div class="col-lg-9">
            <div class="mb-5 d-flex justify-content-between align-items-center">
                <h2 class="display-6 fw-900 mb-0">Our Recipes</h2>
                <div class="text-muted small fw-bold">Showing <span class="text-primary"><?php echo count($prompts); ?></span> of <?php echo $totalCount; ?> recipes</div>
            </div>

            <?php if (empty($prompts)): ?>
                <div class="text-center py-5 bg-white rounded-5 border shadow-sm">
                    <h3 class="text-muted fw-bold h1 opacity-25 mb-3">No Recipes Found</h3>
                    <p class="text-secondary">Try adjusting your filters or search terms.</p>
                </div>
            <?php else: ?>
                <div class="row g-4">
                    <?php foreach ($prompts as $prompt): ?>
                        <div class="col-md-6 col-xl-4">
                            <a href="recipe/view.php?id=<?php echo $prompt['id_recipe']; ?>" class="text-decoration-none">
                                <article class="recipe-card">
                                    <div class="card-overlay-content">
                                        <h4><?php echo htmlspecialchars($prompt['title']); ?></h4>
                                        <p>by <?php echo htmlspecialchars($prompt['author']); ?></p>
                                    </div>
                                    <div class="card-img-wrapper">
                                        <img src="<?php echo BASE_URL; ?>style/images/hero.png" class="card-img-placeholder" alt="Recipe Image">
                                    </div>
                                </article>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php if ($totalPages > 1): ?>
                    <nav class="mt-5 pt-5 border-top">
                        <ul class="pagination justify-content-center">
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?php echo ($i === $page) ? 'active' : ''; ?>">
                                    <a class="page-link shadow-sm" href="index.php?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>&category=<?php echo $category; ?>&sort=<?php echo $sort; ?>">
                                        <?php echo $i; ?>
                                    </a>
                                </li>
                            <?php endfor; ?>
                        </ul>
                    </nav>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>
