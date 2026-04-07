# 🍽️ Marrakech Food Lovers — Task Board
| Bullet | info |
| :--- | :--- |
|**Project:**| Recipe sharing platform |
|**Agency:** | DigitalBite  |
|**Start:** | Mon 04/06/2026 | 
|**Deadline:** | Fri 04/10/2026 – 5:00 PM  |
|**Team:** | Pair project | 
**Method:** | Kanban + MVC + Merise|

---

## 📅 Day-by-Day Plan

| Day | Focus | Status |
| :--- | :--- | :---: |
| **Day 1 (04/06)** | Project Setup, Git Flow, DB Schema, Merise MCD + MLD | [ ] |
| **Day 2 (04/07)** | OOP Classes, DB Connection, Auth (US1 + US2) on branches | [ ] |
| **Day 3 (04/08)** | Recipe CRUD — (US3 + US4 + US5) on feature branches | [ ] |
| **Day 4 (04/09)** | Categories, Filter, Bonus (US6 + US7 + US8) on feature branches | [ ] |
| **Day 5 (04/10)** | Testing, Merging, README, Final Push | [ ] |

---

## 🏗️ Project Setup & MVC Structure

| Done | Task Description | Priority | Est. |
| :---: | :--- | :--- | :--- |
| [ ] | Create MVC folder structure (`/app`, `/config`, `/public`, `/database`) | 🔴 High | 15 min |
| [ ] | Create `/app` subfolders (`/Controllers`, `/Models`, `/Views`) | 🔴 High | 10 min |
| [ ] | Create `/app/Views` subfolders (`/recipes`, `/auth`) | 🔴 High | 10 min |
| [ ] | Set up single entry point `public/index.php` | 🔴 High | 15 min |
| [ ] | Start XAMPP — enable Apache + MySQL; verify via `localhost` | 🔴 High | 5 min |
| [ ] | Open phpMyAdmin and create database `marrakech_food_lovers` with UTF-8 charset | 🔴 High | 10 min |
| [ ] | Initialize local Git repo with `.gitignore` | 🔴 High | 10 min |
| [ ] | Create GitHub remote repository and link to local | 🔴 High | 10 min |
| [ ] | Set up Jira board (4 columns: Backlog / In Progress / In Review / Done) | 🟡 Medium | 15 min |
| [ ] | Create basic `README.md` with project title and description placeholder | 🟡 Medium | 10 min |
| [ ] | **Commit:** `"init: project structure and environment setup"` | 🔴 High | 5 min |

---

## 🌿 Git Branching Workflow

| Done | Task Description | Priority | Est. |
| :---: | :--- | :--- | :--- |
| [ ] | Define branch naming: `feature/USx-description` (e.g., `feature/US1-auth`) | 🔴 High | 5 min |
| [ ] | Always `git checkout main && git pull` before starting a new story | 🔴 High | 5 min |
| [ ] | Collaborator clones repo: `git clone [url]` | 🔴 High | 10 min |
| [ ] | Set up Jira-GitHub automation (if applicable) | 🟡 Medium | 15 min |


---

## 📐 Database Design & Schema

| Done | Task Description | Priority | Est. |
| :---: | :--- | :--- | :--- |
| [ ] | Draw Merise MCD — Entities: User, Recipe, Category — with cardinalities | 🔴 High | 30 min |
| [ ] | Translate MCD → MLD (Logical Data Model) | 🔴 High | 20 min |
| [ ] | Write SQL to create `users` table (`id`, `username`, `email`, `password`, `created_at`) | 🔴 High | 15 min |
| [ ] | Write SQL to create `categories` table (`id`, `name`) | 🔴 High | 10 min |
| [ ] | Write SQL to create `recipes` table (`id`, `user_id` FK, `category_id` FK, `title`, `ingredients`, `instructions`, `prep_time`, `cook_time`, `servings`, `created_at`) | 🔴 High | 20 min |
| [ ] | Add all Foreign Key constraints with `ON DELETE CASCADE` where appropriate | 🔴 High | 10 min |
| [ ] | Write seed data: 3 users, 4 categories, 10 recipes | 🟡 Medium | 25 min |
| [ ] | Export full SQL schema as `database/schema.sql` and seeds as `database/seed.sql` | 🔴 High | 10 min |
| [ ] | Test all JOINs manually in phpMyAdmin before writing any PHP | 🔴 High | 15 min |
| [ ] | **Commit:** `"feat(db): complete schema with users, recipes, categories tables and seeds"` | 🔴 High | 5 min |

---

## 🧱 OOP Foundation & Models

| Done | Task Description | Priority | Est. |
| :---: | :--- | :--- | :--- |
| [ ] | Create `config/config.php` with Database credentials & URL constants | 🔴 High | 20 min |
| [ ] | Create `app/Database.php` as a Simple PDO connection class | 🔴 High | 20 min |
| [ ] | Implement try/catch error handling in Model base class with meaningful messages | 🔴 High | 10 min |
| [ ] | Create `app/Models/User.php` with private properties (`id`, `username`, `email`, `password`) | 🔴 High | 20 min |
| [ ] | Add public getters/setters in `User.php` with proper encapsulation | 🔴 High | 15 min |
| [ ] | Add `findByEmail()`, `register()`, `getById()` methods to `User.php` | 🔴 High | 25 min |
| [ ] | Create `app/Models/Recipe.php` with private properties (`id`, `userId`, `categoryId`, `title`, `ingredients`, `instructions`, `prepTime`, `cookTime`, `servings`) | 🔴 High | 20 min |
| [ ] | Add public getters/setters and CRUD methods (`create`, `update`, `delete`, `findByUser`, `findByCategory`) to `Recipe.php` | 🔴 High | 30 min |
| [ ] | Create `app/Models/Category.php` with `getAll()` method | 🟡 Medium | 15 min |
| [ ] | Test PDO connection with a simple query before moving forward | 🔴 High | 10 min |
| [ ] | **Commit:** `"feat(models): OOP classes with encapsulation — User, Recipe, Category"` | 🔴 High | 5 min |

---

## 🔐 Authentication System — US1 & US2

| Done | Task Description | Priority | Est. |
| :---: | :--- | :--- | :--- |
| [ ] | Create feature branch: `git checkout -b feature/US1-US2-auth` | 🔴 High | 5 min |
| [ ] | Create `app/Controllers/AuthController.php` with `register()`, `login()`, `logout()` actions | 🔴 High | 25 min |
| [ ] | Create `app/Views/auth/register.php` — form with username, email, password fields | 🔴 High | 20 min |
| [ ] | Create `app/Views/auth/login.php` — form with email and password fields | 🔴 High | 15 min |
| [ ] | Implement `password_hash()` with `PASSWORD_BCRYPT` on registration | 🔴 High | 10 min |
| [ ] | Implement `password_verify()` on login against hashed DB password | 🔴 High | 15 min |
| [ ] | Implement PHP Sessions: start session, store user data (`id`, `username`) on login | 🔴 High | 15 min |
| [ ] | Create redirect to recipe list on successful login | 🔴 High | 10 min |
| [ ] | Create `app/Views/header.php` with navigation (conditional: logged in vs visitor) | 🟡 Medium | 15 min |
| [ ] | Create `app/Views/footer.php` | 🟢 Low | 10 min |
| [ ] | Add form validation: required fields, email format, unique email check | 🔴 High | 20 min |
| [ ] | Protect all recipe/category routes from unauthenticated access (session check) | 🔴 High | 15 min |
| [ ] | Push branch: `git push origin feature/US1-US2-auth` and open PR to `main` | 🔴 High | 10 min |
| [ ] | **Commit:** `"feat(auth): secure registration and login with sessions — US1, US2"` | 🔴 High | 5 min |

---

## 📋 Show My Recipes — US3

| Done | Task Description | Priority | Est. |
| :---: | :--- | :--- | :--- |
| [ ] | Create feature branch: `git checkout -b feature/US3-show-recipes` | 🔴 High | 5 min |
| [ ] | Create `app/Controllers/RecipeController.php` with `index()` action | 🔴 High | 20 min |
| [ ] | Implement `findByUser($userId)` in `Recipe.php` using a JOIN on categories | 🔴 High | 20 min |
| [ ] | Create `app/Views/recipes/index.php` — display list of user's recipes (title, prep time, date) | 🔴 High | 25 min |
| [ ] | Show category name alongside each recipe using JOIN result | 🟡 Medium | 15 min |
| [ ] | Add "No recipes yet" message when list is empty | 🟢 Low | 10 min |
| [ ] | Ensure only the logged-in user's recipes are shown (session-based filter) | 🔴 High | 10 min |
| [ ] | Push branch: `git push origin feature/US3-show-recipes` and merge to `main` | 🔴 High | 10 min |
| [ ] | **Commit:** `"feat(recipes): show authenticated user's recipe list — US3"` | 🔴 High | 5 min |

---

## ➕ Create Recipe — US4

| Done | Task Description | Priority | Est. |
| :---: | :--- | :--- | :--- |
| [ ] | Create feature branch: `git checkout -b feature/US4-create-recipe` | 🔴 High | 5 min |
| [ ] | Add `create()` and `store()` actions to `RecipeController.php` | 🔴 High | 20 min |
| [ ] | Create `app/Views/recipes/create.php` — form with title, ingredients, instructions, prep time, cook time, servings, category dropdown | 🔴 High | 25 min |
| [ ] | Populate category dropdown from `Category::getAll()` (no SQL in view!) | 🔴 High | 15 min |
| [ ] | Implement `create()` method in `Recipe.php` using a Prepared Statement | 🔴 High | 20 min |
| [ ] | Validate all required fields server-side before inserting | 🔴 High | 15 min |
| [ ] | Attach `user_id` from session on recipe creation | 🔴 High | 10 min |
| [ ] | Redirect to recipe list with success message after creation | 🟡 Medium | 10 min |
| [ ] | Push branch: `git push origin feature/US4-create-recipe` and merge to `main` | 🔴 High | 10 min |
| [ ] | **Commit:** `"feat(recipes): add new recipe creation form and logic — US4"` | 🔴 High | 5 min |

---

## ✏️ Edit Recipe — US5

| Done | Task Description | Priority | Est. |
| :---: | :--- | :--- | :--- |
| [ ] | Create feature branch: `git checkout -b feature/US5-edit-recipe` | 🔴 High | 5 min |
| [ ] | Add `edit()` and `update()` actions to `RecipeController.php` | 🔴 High | 20 min |
| [ ] | Create `app/Views/recipes/edit.php` — pre-filled form with existing recipe data | 🔴 High | 20 min |
| [ ] | Implement `update()` method in `Recipe.php` using a Prepared Statement | 🔴 High | 20 min |
| [ ] | Verify ownership before allowing edit — check `user_id == session user_id` | 🔴 High | 15 min |
| [ ] | Redirect to recipe list with success message after update | 🟡 Medium | 10 min |
| [ ] | Push branch: `git push origin feature/US5-edit-recipe` and merge to `main` | 🔴 High | 10 min |
| [ ] | **Commit:** `"feat(recipes): edit recipe with ownership check — US5"` | 🔴 High | 5 min |

---

## 🗑️ Delete Recipe — US6

| Done | Task Description | Priority | Est. |
| :---: | :--- | :--- | :--- |
| [ ] | Create feature branch: `git checkout -b feature/US6-delete-recipe` | 🔴 High | 5 min |
| [ ] | Add `destroy()` action to `RecipeController.php` | 🔴 High | 15 min |
| [ ] | Implement `delete()` method in `Recipe.php` using a Prepared Statement | 🔴 High | 15 min |
| [ ] | Verify ownership before allowing delete — check `user_id == session user_id` | 🔴 High | 15 min |
| [ ] | Add delete confirmation prompt on the recipe list view | 🟡 Medium | 10 min |
| [ ] | Redirect to recipe list with confirmation message after deletion | 🟡 Medium | 10 min |
| [ ] | Push branch: `git push origin feature/US6-delete-recipe` and merge to `main` | 🔴 High | 10 min |
| [ ] | **Commit:** `"feat(recipes): delete recipe with ownership check — US6"` | 🔴 High | 5 min |

---

## 🏷️ Recipe Categories — US7

| Done | Task Description | Priority | Est. |
| :---: | :--- | :--- | :--- |
| [ ] | Create feature branch: `git checkout -b feature/US7-categories` | 🔴 High | 5 min |
| [ ] | Verify `categories` table is seeded with 4 values (Starters, Main Courses, Desserts, Drinks) | 🔴 High | 5 min |
| [ ] | Display category name on recipe list and recipe detail views | 🟡 Medium | 15 min |
| [ ] | Display all categories as navigation/filter links on recipe list | 🟡 Medium | 15 min |
| [ ] | Push branch: `git push origin feature/US7-categories` and merge to `main` | 🔴 High | 10 min |
| [ ] | **Commit:** `"feat(categories): category display on recipe list — US7"` | 🟡 Medium | 5 min |

---

## 🔍 Filter by Category — US8

| Done | Task Description | Priority | Est. |
| :---: | :--- | :--- | :--- |
| [ ] | Create feature branch: `git checkout -b feature/US8-filter-category` | 🔴 High | 5 min |
| [ ] | Add `filter()` action to `RecipeController.php` | 🟡 Medium | 20 min |
| [ ] | Implement `findByCategory($userId, $categoryId)` in `Recipe.php` | 🟡 Medium | 20 min |
| [ ] | Use `app/Views/recipes/index.php` for showing filtered recipes | 🟡 Medium | 15 min |
| [ ] | Highlight the active category filter in the navigation | 🟢 Low | 10 min |
| [ ] | Show "No recipes in this category" message when empty | 🟢 Low | 10 min |
| [ ] | Push branch: `git push origin feature/US8-filter-category` and merge to `main` | 🔴 High | 10 min |
| [ ] | **Commit:** `"feat(categories): filter recipes by category — US8"` | 🟡 Medium | 5 min |

---

## ⭐ Bonus Feature (Choose ONE)

> Pick one and delete the others before starting.

| Done | Task Description | Priority | Est. |
| :---: | :--- | :--- | :--- |
| [ ] | **[Search]** Add search bar filtering recipes by title or ingredients | 🟡 Medium | 3h |
| [ ] | **[Favorites]** Allow user to mark/unmark recipes as favorites + favorites view | 🟡 Medium | 3h |
| [ ] | **[Auto Time]** Calculate total time (prep + cook), show "Quick Recipe" badge if < 30 min | 🟡 Medium | 2h |
| [ ] | **[Ratings]** Allow user to rate their own recipes 1–5 stars with average display | 🟡 Medium | 3h |
| [ ] | **Commit:** `"feat(bonus): [feature name] implemented"` | 🟡 Medium | 5 min |

---

## 🧪 Testing Phase

### User Story Validation

| Done | Test Case | User Story | Expected Result | Actual Result | Status |
| :---: | :--- | :---: | :--- | :--- | :---: |
| [ ] | Visitor registers with valid username, email, password | US1 | Account created, redirect to login | | ⏳ |
| [ ] | Visitor registers with an already-used email | US1 | Error: "Email already exists" | | ⏳ |
| [ ] | Registered user logs in with correct credentials | US2 | Redirect to recipe list | | ⏳ |
| [ ] | User logs in with wrong password | US2 | Error: "Invalid credentials" | | ⏳ |
| [ ] | Logged-in user views their recipe list | US3 | Only their recipes shown with title, prep time, date | | ⏳ |
| [ ] | Logged-in user creates a new recipe with all fields | US4 | Recipe saved, appears in list | | ⏳ |
| [ ] | User edits one of their existing recipes | US5 | Changes saved and reflected in list | | ⏳ |
| [ ] | User tries to edit another user's recipe via URL | US5 | Access denied | | ⏳ |
| [ ] | User deletes one of their recipes | US6 | Recipe removed from list | | ⏳ |
| [ ] | User tries to delete another user's recipe via URL | US6 | Access denied | | ⏳ |
| [ ] | Recipes display their category name | US7 | Category shown on list | | ⏳ |
| [ ] | User filters by "Desserts" category | US8 | Only dessert recipes shown | | ⏳ |

---

### Security & Validation Tests

| Done | Test Case | Category | Expected Result | Actual Result | Status |
| :---: | :--- | :--- | :--- | :--- | :---: |
| [ ] | SQL Injection attempt in login form | Security | Prepared statement blocks it safely | | ⏳ |
| [ ] | SQL Injection attempt in recipe creation form | Security | Prepared statement blocks it safely | | ⏳ |
| [ ] | XSS attempt via recipe title field | Security | Script tags escaped with `htmlspecialchars` | | ⏳ |
| [ ] | Direct URL access to recipe list without login | Security | Redirect to login page | | ⏳ |
| [ ] | Check stored passwords in DB | Security | Hashed, never plain text | | ⏳ |
| [ ] | Empty required fields on registration | Validation | Error message per empty field | | ⏳ |
| [ ] | Invalid email format on registration | Validation | "Invalid email format" error | | ⏳ |
| [ ] | Empty fields on recipe creation | Validation | Error messages shown | | ⏳ |

---

### Architecture & Code Quality Tests

| Done | Test Case | Category | Expected Result | Status |
| :---: | :--- | :--- | :--- | :---: |
| [ ] | Verify NO SQL queries in any file under `app/Views/` | MVC | Zero PDO/SQL in views | ⏳ |
| [ ] | Verify all Model properties are `private` | Encapsulation | All properties declared `private` | ⏳ |
| [ ] | Verify Models have public getters/setters | Encapsulation | Public methods for all data access | ⏳ |
| [ ] | Verify Controllers contain no raw HTML | MVC | Controllers only process logic | ⏳ |
| [ ] | Test PDO connection via a direct query | OOP | Returns valid PDO instance | ⏳ |

---

### Bug Tracking Log

| Bug ID | Description | Severity | Steps to Reproduce | Status | Fix Applied |
| :---: | :--- | :---: | :--- | :---: | :--- |
| BUG-001 | | 🔴 / 🟡 / 🟢 | | ⏳ | |
| BUG-002 | | | | ⏳ | |
| BUG-003 | | | | ⏳ | |
| BUG-004 | | | | ⏳ | |

---

## 📁 Project File Structure Reference

```
marrakech-app/
├── app/
│   ├── Controllers/       
│   │   ├── AuthController.php    
│   │   └── RecipeController.php  
│   ├── Models/            
│   │   ├── User.php             
│   │   ├── Recipe.php           
│   │   └── Category.php         
│   ├── Views/             
│   │   ├── auth/
│   │   │   ├── login.php
│   │   │   └── register.php
│   │   ├── recipes/
│   │   │   ├── recipes.php        
│   │   │   ├── create.php       
│   │   │   └── edit.php         
│   │   ├── header.php       
│   │   └── footer.php       
│   └── Database.php             
├── public/                
│   ├── css/
│   │   └── style.css
│   └── index.php                
├── config/
│   └── config.php               
└── database/
    ├── schema.sql
    └── seed.sql
```

---

## 📦 Deliverables Checklist

| Done | Deliverable | Notes |
| :---: | :--- | :--- |
| [ ] | GitHub repo with **12+ commits** from **both members** | Check with `git log --oneline` |
| [ ] | `database/schema.sql` — all tables + FK constraints | |
| [ ] | `database/seed.sql` — 3 users, 10 recipes, 4 categories | |
| [ ] | `README.md` — description, ER diagram, Jira screenshot, MVC tree, install steps | |
| [ ] | Jira board screenshot taken and added to README | |

---

## 🎤 Code Review Prep

Each member must be able to explain:

| Done | Topic |
| :---: | :--- |
| [ ] | How `RecipeController.php` works end-to-end |
| [ ] | The complete MVC request lifecycle (HTTP → Controller → Model → View) |
| [ ] | How Foreign Keys + JOINs work in the recipe queries |
| [ ] | Why SQL belongs in Models, never in Views |
| [ ] | How OOP encapsulation is applied (`private` props, getters, setters) |
| [ ] | How sessions protect routes from unauthorized access |

---

## 📝 Standup Notes & Blockers

| Date | Blocker | Owner | Status |
| :--- | :--- | :--- | :--- |
| | | | |

---

*Last updated: 04/06/2026*