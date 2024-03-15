CREATE DATABASE library;
USE library;

CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    author VARCHAR(255),
    release_date DATE,
    availability BOOLEAN
);

INSERT INTO books (name, author, release_date, availability) VALUES
('The Great Gatsby', 'F. Scott Fitzgerald', '1925-04-10', true),
('To Kill a Mockingbird', 'Harper Lee', '1960-07-11', true),
('1984', 'George Orwell', '1949-06-08', true),
('The Catcher in the Rye', 'J.D. Salinger', '1951-07-16', true),
('The Hobbit', 'J.R.R. Tolkien', '1937-09-21', true),
('The Lord of the Rings', 'J.R.R. Tolkien', '1954-07-29', true),
('The Grapes of Wrath', 'John Steinbeck', '1939-04-14', true);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    permission_level INT
);

