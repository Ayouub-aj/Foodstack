    </main>
    <footer class="bg-dark text-white pt-5 pb-4 mt-5">
        <div class="container">
            <div class="row g-4 mb-5">
                <div class="col-lg-4">
                    <h2 class="navbar-brand text-white mb-3">FOOD<span class="text-success">STACK</span></h2>
                    <p class="text-secondary small">Discover creative and delicious recipes crafted by enthusiasts around the world. Your professional culinary archive.</p>
                </div>
                <div class="col-lg-2 offset-lg-1">
                    <h6 class="text-uppercase fw-bold mb-3 small letter-spacing-1">Explore</h6>
                    <ul class="list-unstyled text-secondary small">
                        <li class="mb-2"><a href="<?php echo BASE_URL; ?>app/index.php" class="text-decoration-none text-secondary">Recipes</a></li>
                        <li class="mb-2"><a href="<?php echo BASE_URL; ?>app/dashboard.php" class="text-decoration-none text-secondary">Community</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Ingredients</a></li>
                    </ul>
                </div>
                <div class="col-lg-5">
                    <h6 class="text-uppercase fw-bold mb-3 small letter-spacing-1">Don't miss any of our culinary updates</h6>
                    <p class="text-secondary small mb-4">Subscribe to our newsletter to stay informed about new recipes and chefs.</p>
                    <form class="d-flex gap-2 p-1 bg-white rounded-pill">
                        <input type="email" class="form-control border-0 rounded-pill bg-white px-4" placeholder="Your email address">
                        <button type="button" class="btn btn-dark rounded-pill px-4 fw-bold">Subscribe</button>
                    </form>
                </div>
            </div>
            <div class="border-top border-secondary pt-4 d-flex justify-content-between align-items-center">
                <p class="text-secondary small mb-0">&copy; <?php echo date('Y'); ?> FoodStack Platform. Crafted for excellence.</p>
                <div class="d-flex gap-4">
                    <a href="#" class="text-secondary fs-5"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-secondary fs-5"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-secondary fs-5"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
