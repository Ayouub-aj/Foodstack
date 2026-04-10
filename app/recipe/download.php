<?php
require_once dirname(__DIR__, 2) . '/config/db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid request targeting the repository logs.");
}

$r_id = $_GET['id'];

try {
    $stmt = $pdo->prepare("SELECT title, ingredients, instructions FROM recipes WHERE id_recipe = ?");
    $stmt->execute([$r_id]);
    $recipe = $stmt->fetch();

    if (!$recipe) {
        die("Asset not identified in current vault.");
    }

    $filename = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $recipe['title']) . ".txt";

    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');

    echo "RECIPE TITLE: " . strtoupper($recipe['title']) . "\n";
    echo str_repeat("=", strlen($recipe['title']) + 14) . "\n\n";
    echo "INGREDIENTS:\n";
    echo $recipe['ingredients'] . "\n\n";
    echo "INSTRUCTIONS:\n";
    echo $recipe['instructions'];
    exit;

} catch (PDOException $e) {
    die("Data extraction failure: " . $e->getMessage());
}
?>
