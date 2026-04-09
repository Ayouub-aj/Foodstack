CREATE DATABASE IF NOT EXISTS foodstack;
USE foodstack;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS recipes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    users_id INT NOT NULL,
    categories_id INT,
    title VARCHAR(100) NOT NULL,
    temp_de_production VARCHAR(50),
    ingredient TEXT NOT NULL,
    instructions TEXT NOT NULL,
    portions INT,
    create_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (users_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (categories_id) REFERENCES categories(id) ON DELETE SET NULL
);

INSERT IGNORE INTO categories (name) VALUES 
('Entrées'), 
('Plats'), 
('Desserts'), 
('Boissons'),
('Goûter');
