CREATE DATABASE IF NOT EXISTS digital_library;
USE digital_library;

DROP TABLE IF EXISTS books;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS admins;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    category VARCHAR(100) NOT NULL,
    pdf VARCHAR(255) NOT NULL,
    cover VARCHAR(255) NOT NULL,
    rating VARCHAR(10) NOT NULL
);

INSERT INTO admins (email, password) VALUES
('admin@gmail.com', MD5('admin123'));

INSERT INTO users (name, email, password) VALUES
('Roshan', 'roshan@gmail.com', MD5('123456'));

INSERT INTO books (title, author, category, pdf, cover, rating) VALUES
('Rich Dad Poor Dad', 'Robert T. Kiyosaki', 'Finance', '62f7dc68b8a1a-rich-dad-poor-dad-rich-dad-s-prophecy.pdf', 'Rich Dad Poor Dad.jpg', '4.5');
