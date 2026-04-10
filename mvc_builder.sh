#!/bin/bash

# --- 1. DIRECTORY STRUCTURE (Custom Nested MVC) ---
# Most application folders live inside the 'app' directory.
mkdir -p app/Views/auth app/Views/recipes app/config app/controllers app/database app/includes app/models app/public

# --- 2. THE KITCHEN (Application Logic) ---

# CONTROLLERS: The "Waiters"
touch app/controllers/authcontroller.php    
touch app/controllers/recipecontroller.php   

# MODELS: The "Ingredients"
touch app/models/Category.php
touch app/models/Recipe.php
touch app/models/user.php

# --- 3. VIEWS: The "Plating & Presentation" (Zero SQL) ---
touch app/Views/auth/login.php      
touch app/Views/auth/registre.php 
touch app/Views/recipes/recipes.php    
touch app/Views/recipes/create.php    
touch app/Views/recipes/edit.php           
touch app/Views/database.php           
touch app/Views/footer.php             
touch app/Views/header.php             

# --- 4. CONFIG & STORAGE (Nested) ---
touch app/config/config.php           
touch app/database/schema.sql   
touch app/database/seed.sql       

# --- 5. THE DINING ROOM (Public Face) ---
touch app/public/index.php        
touch app/public/main.css   

# --- 6. ASSETS & DOCUMENTATION ---
touch app/includes/MCD.svg 
touch app/includes/jira.png 
touch app/includes/mcd_merise.png
touch README.md
touch taskboard.md
touch LICENSE

echo "--------------------------------------------------------"
echo "✅ Custom Nested MVC Structure for Foodstack created!"
echo "💡 Remember: Controllers = Waiters, Models = Ingredients, Views = Plating."
echo "--------------------------------------------------------"