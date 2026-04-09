<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($recipe['title'] ?? 'Détails de la recette') ?> - FoodStack</title>
    <link rel="stylesheet" href="../../public/main.css">
    <style>
        .recipe-detail-container {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
        }

        .recipe-header {
            text-align: center;
            margin-bottom: 40px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            padding: 50px 30px;
            border-radius: 30px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 20px 50px rgba(0,0,0,0.1);
        }

        .recipe-header h1 {
            font-size: 48px;
            margin-bottom: 15px;
            letter-spacing: -1px;
        }

        .meta-badges {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .badge {
            background: rgba(255, 94, 98, 0.2);
            color: #ff5e62;
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
            border: 1px solid rgba(255, 94, 98, 0.3);
        }

        .recipe-content {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 30px;
            margin-top: 30px;
        }

        .glass-panel {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 24px;
            padding: 30px;
        }

        .glass-panel h3 {
            margin-bottom: 20px;
            font-size: 22px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .ingredients-list {
            list-style: none;
            padding: 0;
        }

        .ingredients-list li {
            padding: 10px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .ingredients-list li::before {
            content: "•";
            color: #ff5e62;
            font-weight: bold;
        }

        .instructions-text {
            line-height: 1.8;
            font-size: 16px;
            white-space: pre-line; /* Preserves newlines */
        }

        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: white;
            text-decoration: none;
            opacity: 0.7;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            opacity: 1;
            transform: translateX(-5px);
        }
    </style>
</head>
<body>

    <div class="recipe-detail-container">
        <a href="recipes.php" class="back-link">← Retour aux recettes</a>

        <div class="recipe-header">
            <h1><?= htmlspecialchars($recipe['title'] ?? 'Ma Délicieuse Recette') ?></h1>
            <div class="meta-badges">
                <span class="badge">⏱️ <?= htmlspecialchars($recipe['temp_de_production'] ?? '30 min') ?></span>
                <span class="badge">🍽️ <?= htmlspecialchars($recipe['portions'] ?? '4') ?> portions</span>
                <span class="badge">📁 <?= htmlspecialchars($recipe['category_name'] ?? 'Plat Principal') ?></span>
            </div>
        </div>

        <div class="recipe-content">
            <div class="glass-panel">
                <h3>📝 Ingrédients</h3>
                <ul class="ingredients-list">
                    <?php 
                        $ingredients = explode("\n", $recipe['ingredient'] ?? "Aucun ingrédient listé.");
                        foreach($ingredients as $ing): 
                            if(trim($ing)):
                    ?>
                        <li><?= htmlspecialchars(trim($ing)) ?></li>
                    <?php 
                            endif;
                        endforeach; 
                    ?>
                </ul>
            </div>

            <div class="glass-panel">
                <h3>👨‍🍳 Instructions</h3>
                <div class="instructions-text">
                    <?= htmlspecialchars($recipe['instructions'] ?? "Aucune instruction fournie.") ?>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
