CREATE DATABASE IF NOT EXISTS bsit_21
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE bsit_21;

DROP TABLE IF EXISTS users;

CREATE TABLE users (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

  -- Name parts
  first_name   VARCHAR(60)  NOT NULL,
  middle_name  VARCHAR(60)  NULL,
  last_name    VARCHAR(60)  NOT NULL,
  suffix       VARCHAR(10)  NULL,

  -- Contact/identity
  email        VARCHAR(120) NOT NULL UNIQUE,
  phone        VARCHAR(20)  NULL,

  -- Demographics (optional)
  gender       VARCHAR(30)  NULL,  -- 'Male','Female','Prefer not to say'
  birthdate    DATE         NULL,

  -- Address (optional)
  barangay           VARCHAR(80)  NULL,
  city_municipality  VARCHAR(80)  NULL,
  province           VARCHAR(80)  NULL,
  postal_code        VARCHAR(10)  NULL,

  created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
