<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodStack - Vos Recettes</title>
    <link rel="stylesheet" href="../../public/main.css">
    <style>
        nav {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            max-width: 1200px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .nav-logo {
            font-size: 24px;
            font-weight: 800;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-links {
            display: flex;
            gap: 25px;
            align-items: center;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            opacity: 0.8;
            transition: all 0.3s ease;
            font-size: 15px;
        }

        .nav-links a:hover {
            opacity: 1;
            transform: translateY(-2px);
        }

        .nav-auth {
            display: flex;
            gap: 15px;
        }

        .btn-nav {
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .btn-login {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-register {
            background: #ff5e62;
            color: white;
            box-shadow: 0 5px 15px rgba(255, 94, 98, 0.3);
        }

        .btn-register:hover {
            background: #ff4a4e;
            box-shadow: 0 8px 20px rgba(255, 94, 98, 0.4);
            transform: translateY(-2px);
        }

        body {
            padding-top: 100px; /* Space for fixed nav */
        }
    </style>
</head>
<body>
    <nav>
        <a href="index.php" class="nav-logo">
            <span>🍽️</span> FoodStack
        </a>
        
        <div class="nav-links">
            <a href="index.php">Explorer</a>
            <a href="recipes.php">Mes Recettes</a>
            <a href="#">Populaires</a>
        </div>

        <div class="nav-auth">
            <?php if(isset($_SESSION['user_id'])): ?>
                <span style="color: white; font-weight: 500; margin-right: 10px; opacity: 0.8;">
                    Salut, <?= htmlspecialchars($_SESSION['username'] ?? 'Chef') ?>!
                </span>
                <a href="logout.php" class="btn-nav btn-login">Déconnexion</a>
            <?php else: ?>
                <a href="login.php" class="btn-nav btn-login">Connexion</a>
                <a href="registre.php" class="btn-nav btn-register">S'inscrire</a>
            <?php endif; ?>
        </div>
    </nav>
