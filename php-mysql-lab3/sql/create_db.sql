CREATE DATABASE IF NOT EXISTS create_users
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE create_users;

CREATE TABLE IF NOT EXISTS login_users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  first_name VARCHAR(50) NOT NULL,
  middle_name VARCHAR(50),
  last_name VARCHAR(50) NOT NULL,
  suffix VARCHAR(10),
  email VARCHAR(100) UNIQUE NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
