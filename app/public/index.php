<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue sur FoodStack</title>
    <link rel="stylesheet" href="main.css">
    <style>
        .hero-container {
            text-align: center;
            max-width: 800px;
            padding: 60px 40px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 24px;
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.15);
            animation: fadeIn 0.8s ease-out forwards;
        }

        .hero-logo {
            font-size: 64px;
            margin-bottom: 10px;
            display: inline-block;
        }

        .hero-title {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 20px;
            letter-spacing: -1px;
            text-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .hero-subtitle {
            font-size: 20px;
            opacity: 0.9;
            margin-bottom: 40px;
            line-height: 1.6;
            font-weight: 300;
        }

        .hero-actions {
            display: flex;
            gap: 20px;
            justify-content: center;
        }

        .btn {
            padding: 16px 40px;
            border-radius: 14px;
            font-size: 18px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn-primary {
            background: #ff5e62;
            color: #fff;
            box-shadow: 0 10px 20px rgba(255, 94, 98, 0.3);
        }
        
        .btn-primary:hover {
            background: #ff4a4e;
            transform: translateY(-3px);
            box-shadow: 0 15px 25px rgba(255, 94, 98, 0.4);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-3px);
            border-color: rgba(255,255,255,0.5);
        }

        .credits {
            margin-top: 50px;
            font-size: 14px;
            opacity: 0.6;
        }
    </style>
</head>
<body>

    <div class="hero-container">
        <div class="hero-logo">🍽️</div>
        <h1 class="hero-title">FoodStack</h1>
        <p class="hero-subtitle">Le meilleur endroit pour créer, organiser et partager toutes vos recettes culinaires avec simplicité et élégance.</p>
        
        <div class="hero-actions">
            <a href="../Views/auth/login.php" class="btn btn-primary">Se connecter</a>
            <a href="../Views/auth/registre.php" class="btn btn-secondary">Créer un compte</a>
        </div>
        
        <div class="credits">
            © <?= date('Y') ?> FoodStack - Créez vos chefs-d'œuvre.
        </div>
    </div>

</body>
</html>
