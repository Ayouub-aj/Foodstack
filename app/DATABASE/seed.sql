-- SEED DATA FOR FOODSTACK
-- Ensure you have run shema.sql first!

-- Users (password is 'password' hashed)
INSERT INTO users (username, email, password) VALUES 
('ChefAyoub', 'ayoub@foodstack.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('ChefMaria', 'maria@foodstack.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Categories (Using names from US7 requirement)
-- Note: 'shema.sql' already inserts these, but let's be sure or add more
INSERT IGNORE INTO categories (name) VALUES 
('Entrées'), 
('Plats'), 
('Desserts'), 
('Boissons'),
('Goûter');

-- Sample Recipes
INSERT INTO recipes (users_id, categories_id, title, temp_de_production, ingredient, instructions, portions) VALUES 
(1, 2, 'Tajine de Poulet aux Olives', '1h 30min', '1 Poulet\n500g d olives\nOignons\nCitrons confits\nÉpices (Gingembre, Curcuma)', '1. Faire revenir le poulet avec les oignons.\n2. Ajouter les épices.\n3. Couvrir d eau et laisser mijoter.', 4),
(1, 3, 'Mousse au Chocolat', '20min', '200g Chocolat noir\n6 œufs\n1 pincée de sel', '1. Faire fondre le chocolat.\n2. Séparer les blancs des jaunes.\n3. Monter les blancs en neige.', 6),
(2, 4, 'Bous-Bous (Thé Marocain)', '10min', 'Thé vert\nMenthe fraîche\nSucre', '1. Rincer le thé.\n2. Ajouter la menthe et le sucre.\n3. Laisser infuser.', 4);
