<?php
require_once __DIR__ . '/../../controllers/authcontroller.php';
$auth = new authController();
$auth->register();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/main.css">
    <title>Inscription - FoodStack</title>
</head>
<body>
    
    <div class="glass-panel">
        <div class="form-header">
            <h2>Rejoignez-nous</h2>
            <p style="opacity: 0.8; font-size: 14px; margin-top: 5px;">Créez votre compte FoodStack</p>
        </div>

        <form action="registre.php" method="POST">
            <div class="input-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" name="username" id="username" placeholder="Votre Pseudo" required>
            </div>

            <div class="input-group">
                <label for="email">Adresse Email</label>
                <input type="email" name="email" id="email" placeholder="votre@email.com" required>
            </div>
            
            <div class="input-group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" placeholder="••••••••" required>
            </div>
            
            <button type="submit" class="btn-submit">Créer le compte</button>
        </form>

        <div class="redirect-link">
            Vous avez déjà un compte ? <a href="login.php">Se connecter</a>
        </div>
    </div>

</body>
</html>
