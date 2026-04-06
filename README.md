# 🍽️ Marrakech Food Lovers — Recipe Sharing Platform

> A full-stack web platform for cooking enthusiasts to share, organize, and discover their favorite recipes — so no delicious creation ever gets lost in paper notebooks or phone photos again.

---

## 🛠️ Tech Stack

| Layer       | Technology                        |
|-------------|-----------------------------------|
| Backend     | PHP 8+ (MVC Architecture)         |
| Database    | MySQL                             |
| DB Access   | PDO + Prepared Statements         |
| Auth        | PHP Sessions + `password_hash()`  |
| Frontend    | HTML5 / CSS3                      |
| Methodology | Kanban + Merise (MCD/MLD)         |

---

## ✨ Features

- 🔐 **Secure Authentication** — Register/Login with hashed passwords (US1 & US2)
- 📋 **My Recipes Dashboard** — View all your recipes with title, prep time, and creation date (US3)
- ✍️ **Recipe Management** — Create, edit, delete your recipes with full details (US4, US5, US6)
- 🏷️ **Categories** — Organize recipes by Starters, Main Courses, Desserts, Drinks (US7)
- 🔍 **Smart Filtering** — Browse recipes by category (US8)
- 🛡️ **Zero SQL Injection** — All queries use Prepared Statements
- 🔒 **Ownership Protection** — Users can only modify/delete their own recipes

---

## 🗄️ Database Schema
users
├── id (PK)
├── username
├── email
├── password
└── created_at

categories
├── id (PK)
└── name

recipes
├── id (PK)
├── user_id (FK → users.id)
├── category_id (FK → categories.id)
├── title
├── ingredients
├── instructions
├── prep_time
├── cook_time
├── servings
└── created_at

text


---

## 📊 Entity-Relationship Diagram (MCD/MLD)

### Conceptual Data Model (MCD)

![MCD Diagram](/database/diagrams/mcd.png)

### Logical Data Model (MLD)

![MLD Diagram](/database/diagrams/mld.png)

> *Diagrams created using draw.io / hand-drawn and photographed*

### Tables & Relationships

- **users** — stores user accounts with hashed passwords

- **categories** — lookup table for recipe types (Starters, Main Courses, Desserts, Drinks)

- **recipes** — core table with `user_id` and `category_id` as Foreign Keys

#### Relationships (Crow's Foot Notation)

- `users → recipes` : One user can create zero or many recipes (||--o{)

- `categories → recipes` : One category can contain zero or many recipes (||--o{)

> 💡 These FK relationships power our JOIN queries to display human-readable usernames and category names instead of raw IDs!

---

## 📊 Jira Board

![Jira Board](/includes/img/jira-board.png)

> *Kanban board with columns: Backlog | In Progress | In Review | Done*

---

## 🚀 Installation

### Prerequisites

- PHP 8+ with PDO extension enabled
- MySQL 5.7+ or MariaDB
- A local server (XAMPP, Laragon, WAMP, or similar)

### Steps

1. **Clone the repository**

```bash
git clone https://github.com/your-username/marrakech-food-lovers.git
cd marrakech-food-lovers
Import the database
```


Open phpMyAdmin (or your MySQL client)
Create a new database: marrakech_food_lovers
Import the files:
database/schema.sql (table structure)
database/seed.sql (sample data: 3 users, 10 recipes, 4 categories)
Configure the connection

Open config/config.php
Update with your local credentials:
PHP

define('DB_HOST', 'localhost');
define('DB_NAME', 'marrakech_food_lovers');
define('DB_USER', 'root');
define('DB_PASS', '');
Run the project
Place the folder in your server's htdocs or www directory

Visit: http://localhost/marrakech-food-lovers/public

# 📁 Project Structure (MVC)


marrakech-food-lovers/
├── app/
│   ├── Controllers/           # Request handling & business logic orchestration
│   │   ├── AuthController.php     # Login, Register, Logout actions
│   │   └── RecipeController.php   # CRUD operations for recipes
│   ├── Models/                # Data access & business rules (OOP encapsulation)
│   │   ├── User.php               # User entity — private props & getters/setters
│   │   ├── Recipe.php             # Recipe entity — CRUD methods
│   │   └── Category.php           # Category entity — getAll()
│   ├── Views/                 # Presentation layer (HTML + PHP templating)
│   │   ├── auth/
│   │   │   ├── login.php
│   │   │   └── register.php
│   │   ├── recipes/
│   │   │   ├── index.php          # Recipe list with filtering
│   │   │   ├── create.php         # New recipe form
│   │   │   └── edit.php           # Edit recipe form
│   │   ├── header.php             # Global navigation
│   │   └── footer.php
│   └── Database.php           # PDO connection class
├── public/                    # Web root (single entry point)
│   ├── css/
│   │   └── style.css
│   └── index.php              # Front controller
├── config/
│   └── config.php             # DB credentials & constants
├── database/
│   ├── schema.sql             # Table creation script
│   ├── seed.sql               # Sample data (3 users, 10 recipes, 4 categories)
│   └── diagrams/              # MCD & MLD images
├── includes/
│   └── img/                   # Screenshots & assets
└── README.md

# 🔒 Security Highlights
Feature	Implementation
Password Storage	password_hash() with PASSWORD_BCRYPT
Password Verification	password_verify() on login
SQL Injection Prevention	PDO Prepared Statements on ALL queries
Form Validation	Server-side validation on all inputs
Access Control	Session-based route protection
Ownership Verification	Users can only edit/delete their own recipes
XSS Prevention	htmlspecialchars() on output

# 🏆 Bonus Feature
Choose ONE per pair:

 Recipe Search — Search bar filtering by title or ingredients
 Favorite Recipes — Mark recipes as favorites with dedicated view
 Automatic Total Time — Calculate prep + cook time, show "Quick Recipe" badge (<30 min)
 Ratings — Rate recipes 1-5 stars with average display
🖼️ Screenshots
Screen	Preview
Login	Login
Register	Register
My Recipes	Dashboard
Create Recipe	Create
Edit Recipe	Edit
Filter by Category	Filter
📋 User Stories
ID	Story	Status
US1	As a visitor, I want to create an account to manage my recipes	⏳
US2	As a registered user, I want to log in to access my personal space	⏳
US3	As a logged-in user, I want to see all my recipes with title, prep time, date	⏳
US4	As a logged-in user, I want to add a new recipe with all details	⏳
US5	As a logged-in user, I want to modify my existing recipes	⏳
US6	As a logged-in user, I want to delete a recipe I created	⏳
US7	As a user, I want to organize recipes by categories	⏳
US8	As a user, I want to filter recipes by category	⏳
👥 Team
Member	Role	GitHub
[Name 1]	Backend Developer	@username1
[Name 2]	Backend Developer	@username2
📚 Project Context
Info	Details
Agency	DigitalBite Agency
Client	Marrakech Food Lovers
Duration	5 days (04/06/2026 – 04/10/2026)
Mode	Pair Programming
Methodology	Kanban + MVC + Merise
📜 License
This project was built as part of a Full-Stack PHP/MySQL training program at DigitalBite Agency.

Built with ❤️ and 🍲 by the Marrakech Food Lovers team