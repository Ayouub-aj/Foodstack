    <style>
        footer {
            margin-top: 60px;
            padding: 40px 20px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px 24px 0 0;
            color: white;
            text-align: center;
        }

        .footer-content {
            max-width: 1000px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .footer-logo {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin: 10px 0;
        }

        .footer-links a {
            color: white;
            text-decoration: none;
            opacity: 0.7;
            transition: all 0.3s ease;
            font-size: 14px;
            font-weight: 500;
        }

        .footer-links a:hover {
            opacity: 1;
            transform: translateY(-2px);
        }

        .copyright {
            font-size: 13px;
            opacity: 0.5;
            margin-top: 20px;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 20px;
            font-size: 20px;
        }
    </style>

    <footer>
        <div class="footer-content">
            <div class="footer-logo">🍽️ FoodStack</div>
            
            <div class="footer-links">
                <a href="#">Accueil</a>
                <a href="#">Recettes</a>
                <a href="#">Catégories</a>
                <a href="#">À Propos</a>
                <a href="#">Contact</a>
            </div>

            <div class="social-icons">
                <span>📸</span>
                <span>🐦</span>
                <span>📘</span>
            </div>

            <div class="copyright">
                © <?= date('Y') ?> FoodStack. Tous droits réservés. <br>
                Conçu avec passion pour les amoureux de la cuisine.
            </div>
        </div>
    </footer>
</body>
</html>
