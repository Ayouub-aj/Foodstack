<?php
session_start();

// root URL for the project
define('BASE_URL', '/projectPHP/RecipeVault/');

$host = 'localhost';
$db = 'foodstack';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>