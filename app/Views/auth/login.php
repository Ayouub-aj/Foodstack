<?php
require_once __DIR__ . '/../../controllers/authcontroller.php';
$auth = new authController();

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    $auth->logout();
}

$auth->login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/main.css">
    <title>Connexion - FoodStack</title>
</head>
<body>

    <div class="glass-panel">
        <div class="form-header">
            <h2>Bienvenue</h2>
            <p style="opacity: 0.8; font-size: 14px; margin-top: 5px;">Connectez-vous à FoodStack</p>
        </div>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert error">
                <?php 
                    if($_GET['error'] === 'invalid_credentials') echo "Email ou mot de passe incorrect.";
                    else echo htmlspecialchars($_GET['error']);
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['success'])): ?>
            <div class="alert success">
                <?php 
                    if($_GET['success'] === 'account_created') echo "Compte créé ! Veuillez vous connecter.";
                    else echo htmlspecialchars($_GET['success']);
                ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="input-group">
                <label for="email">Adresse Email</label>
                <input type="email" name="email" id="email" placeholder="votre@email.com" required>
            </div>
            
            <div class="input-group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" placeholder="••••••••" required>
            </div>
            
            <button type="submit" class="btn-submit">Se connecter</button>
        </form>

        <div class="redirect-link">
            Pas encore de compte ? <a href="registre.php">S'inscrire</a>
        </div>
    </div>

</body>
</html>
