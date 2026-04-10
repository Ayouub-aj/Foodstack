-- 🧹 Clean up existing data before seeding (optional but helpful for fresh starts)
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE recipes;
TRUNCATE TABLE categories;
TRUNCATE TABLE users;
SET FOREIGN_KEY_CHECKS = 1;

-- 👤 Seed Users (Password: [PASSWORD])
INSERT INTO users (username, email, password_hash) VALUES 
('admin', 'admin@foodstack.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('chef', 'chef@foodstack.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('foodie', 'foodie@foodstack.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- 🏷️ Seed Categories
INSERT INTO categories (name, description) VALUES 
('Starters', 'Small plates and appetizers to begin the meal.'),
('Main Courses', 'Hearty and traditional main dishes.'),
('Desserts', 'Sweet treats and traditional pastries.'),
('Drinks', 'Refreshing traditional and modern beverages.');

-- 🍲 Seed Recipes (10 recipes)

-- 1. Zaalouk (Starter) - id_user=1, id_category=1
INSERT INTO recipes (user_id, category_id, title, ingredients, instructions, prep_time, cooking_time, servings) VALUES 
(1, 1, 'Authentic Zaalouk', 
'2 large eggplants, 4 tomatoes, 3 cloves garlic, 1 tsp cumin, 1 tsp paprika, Olive oil, Fresh coriander', 
'Roast eggplants then peel. Sauté grated tomatoes with garlic and spices. Mash eggplant into the mixture. Simmer until smooth.', 
15, 25, 4);

-- 2. Harira Soup (Starter) - id_user=2, id_category=1
INSERT INTO recipes (user_id, category_id, title, ingredients, instructions, prep_time, cooking_time, servings) VALUES 
(2, 1, 'Classic Harira', 
'Chickpeas, Lentils, Celery, Tomato paste, Flour, Ginger, Turmeric, Lamb bits', 
'Sauté meat and veggies. Add water and legumes. Simmer for 1 hour. Thicken with flour-water mixture and add tomato paste.', 
20, 60, 6);

-- 3. Lamb Tagine with Prunes (Main) - id_user=1, id_category=2
INSERT INTO recipes (user_id, category_id, title, ingredients, instructions, prep_time, cooking_time, servings) VALUES 
(1, 2, 'Lamb Tagine with Prunes', 
'1kg Lamb shoulder, 200g Dried prunes, Almonds, Saffron, Ginger, Cinnamon', 
'Sauté lamb with spices. Add water and slow cook. Simmer prunes separately with honey and cinnamon. Garnish with toasted almonds.', 
30, 120, 4);

-- 4. Royal Couscous (Main) - id_user=2, id_category=2
INSERT INTO recipes (user_id, category_id, title, ingredients, instructions, prep_time, cooking_time, servings) VALUES 
(2, 2, 'Seven Vegetable Royal Couscous', 
'Couscous semolina, Lamb, Chicken, Zucchini, Carrots, Cabbage, Pumpkin, Chickpeas', 
'Steam couscous thrice. Cook meat and veggies in a large pot with savory spices. Serve meat and veggies atop the fluffy grain.', 
45, 90, 8);

-- 5. Seafood Pastilla (Main) - id_user=3, id_category=2
INSERT INTO recipes (user_id, category_id, title, ingredients, instructions, prep_time, cooking_time, servings) VALUES 
(3, 2, 'Tangier Seafood Pastilla', 
'Warka pastry, Shrimp, Calamari, White fish, Vermicelli, Harissa, Preserved lemon', 
'Sauté seafood with garlic and spices. Mix with cooked vermicelli. Stuff into layers of thin pastry and bake until golden.', 
60, 40, 6);

-- 6. Chicken with Preserved Lemons (Main) - id_user=1, id_category=2
INSERT INTO recipes (user_id, category_id, title, ingredients, instructions, prep_time, cooking_time, servings) VALUES 
(1, 2, 'Poulet aux Citrons Confits', 
'Whole chicken, 2 Preserved lemons, Green olives, Ginger, Onion, Smeg (salty butter)', 
'Marinate chicken. Sauté onions. Slow cook chicken in a heavy pot. Add olives and lemons at the end to thicken the sauce.', 
20, 75, 4);

-- 7. Gazelle Horns (Dessert) - id_user=2, id_category=3
INSERT INTO recipes (user_id, category_id, title, ingredients, instructions, prep_time, cooking_time, servings) VALUES 
(2, 3, 'Cornes de Gazelle', 
'Flour, Almond paste, Orange blossom water, Butter, Icing sugar', 
'Prepare thin dough. Wrap almond paste cylinders into crescent shapes. Bake lightly—do not brown! Dust with sugar.', 
90, 15, 20);

-- 8. Almond Baklava (Dessert) - id_user=3, id_category=3
INSERT INTO recipes (user_id, category_id, title, ingredients, instructions, prep_time, cooking_time, servings) VALUES 
(3, 3, 'Honey Almond Baklava', 
'Phyllo dough, Crushed almonds, Honey, Cinnamon, Melted butter', 
'Layer phyllo sheets with butter and almond mixture. Cut into diamonds. Bake until crisp. Pour warm honey over the hot pastry.', 
40, 45, 12);

-- 9. Moroccan Mint Tea (Drink) - id_user=1, id_category=4
INSERT INTO recipes (user_id, category_id, title, ingredients, instructions, prep_time, cooking_time, servings) VALUES 
(1, 4, 'Traditional Atay', 
'Gunpowder green tea, Fresh mint sprigs, Sugar loaf chunks, Boiling water', 
'Rinse tea leaves. Add mint and sugar. Boil for a few minutes. Pour high to create foam (the turban).', 
5, 10, 6);

-- 10. Avocado Smoothie (Drink) - id_user=3, id_category=4
INSERT INTO recipes (user_id, category_id, title, ingredients, instructions, prep_time, cooking_time, servings) VALUES 
(3, 4, 'Avocado & Almond Shake', 
'1 Ripe avocado, 500ml Milk, 10 Almonds, 2 tsp Honey', 
'Blend all ingredients until creamy and thick. Serve chilled.', 
5, 0, 2);
