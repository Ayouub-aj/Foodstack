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

try {
    // Only verify ownership - admin checks disabled as per current schema
    $stmt = $pdo->prepare("SELECT title FROM recipes WHERE id_recipe = ? AND user_id = ?");
    $stmt->execute([$r_id, $u_id]);
    $recipe = $stmt->fetch();

    if (!$recipe) {
        header("Location: ../dashboard.php");
        exit;
    }
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $delete = $pdo->prepare("DELETE FROM recipes WHERE id_recipe = ? AND user_id = ?");
        $delete->execute([$r_id, $u_id]);
        
        header("Location: ../dashboard.php");
        exit;
    } catch (PDOException $e) {
        $error = "Deletion failed: " . $e->getMessage();
    }
}

require_once dirname(__DIR__, 2) . '/includes/header.php';
?>

<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5 text-center">
            <div class="card shadow rounded-5 border-0 p-5">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="alert alert-danger d-inline-block rounded-circle p-4 border-0 shadow-sm" style="background: rgba(220, 53, 69, 0.1); color: #dc3545;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                            </svg>
                        </div>
                    </div>
                    
                    <h2 class="fw-900 mb-3 text-dark">Delete Recipe?</h2>
                    <p class="text-muted mb-4 px-3">
                        Are you sure you want to permanently delete <br>
                        <strong class="text-danger">"<?php echo htmlspecialchars($recipe['title']); ?>"</strong>? 
                        <br>This action cannot be undone.
                    </p>

                    <?php if ($error): ?>
                        <div class="alert alert-danger mb-4 rounded-4 border-0 shadow-sm"><?php echo htmlspecialchars($error); ?></div>
                    <?php endif; ?>

                    <form action="delete.php?id=<?php echo $r_id; ?>" method="POST" class="d-grid gap-2">
                        <button type="submit" class="btn btn-danger btn-lg fw-bold rounded-pill shadow-sm py-3 mb-2">
                            Yes, Delete Permanently
                        </button>
                        <a href="../dashboard.php" class="btn btn-light btn-lg fw-bold rounded-pill border-0 py-3">No, Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
require_once dirname(__DIR__, 2) . '/includes/footer.php'; 
?>
