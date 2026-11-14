CREATE DATABASE IF NOT EXISTS db_student_data
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_student_data;

CREATE TABLE IF NOT EXISTS students (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nim VARCHAR(15) NOT NULL UNIQUE,
  name VARCHAR(100) NOT NULL,
  major VARCHAR(100) NOT NULL,
  semester INT NOT NULL DEFAULT 1,
  gpa DECIMAL(3,2) NOT NULL DEFAULT 0.00
);
INSERT IGNORE INTO students (nim, name, major, semester, gpa) VALUES
('2026001', 'Dina', 'Informatika', 3, 3.75),
('2026002', 'Budi', 'Sistem Informasi', 5, 3.20);