CREATE DATABASE library;
USE library;

CREATE TABLE authors (
     id INT AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(255)
);

INSERT INTO authors (name) VALUES
('F. Scott Fitzgerald'),
('Harper Lee'),
('George Orwell'),
('J.D. Salinger'),
('J.R.R. Tolkien'),
('John Steinbeck');

CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    author_id INT NOT NULL DEFAULT 1,
    image_url VARCHAR(255),
    release_date DATE,
    availability BOOLEAN,
    FOREIGN KEY (author_id) REFERENCES authors(id)
);

INSERT INTO books (name, author_id, image_url, release_date, availability) VALUES
('The Great Gatsby', 1, "https://upload.wikimedia.org/wikipedia/commons/thumb/7/7a/The_Great_Gatsby_Cover_1925_Retouched.jpg/1024px-The_Great_Gatsby_Cover_1925_Retouched.jpg", '1925-04-10', true),
('To Kill a Mockingbird', 2, "https://upload.wikimedia.org/wikipedia/commons/thumb/4/4f/To_Kill_a_Mockingbird_%28first_edition_cover%29.jpg/1024px-To_Kill_a_Mockingbird_%28first_edition_cover%29.jpg", '1960-07-11', true),
('1984', 3, "https://upload.wikimedia.org/wikipedia/en/5/51/1984_first_edition_cover.jpg", '1949-06-08', true),
('The Catcher in the Rye', 4, "https://upload.wikimedia.org/wikipedia/commons/8/89/The_Catcher_in_the_Rye_%281951%2C_first_edition_cover%29.jpg", '1951-07-16', true),
('The Hobbit', 5, "https://upload.wikimedia.org/wikipedia/en/4/4a/TheHobbit_FirstEdition.jpg", '1937-09-21', true),
('The Lord of the Rings', 5, "https://upload.wikimedia.org/wikipedia/en/e/e9/First_Single_Volume_Edition_of_The_Lord_of_the_Rings.gif", '1954-07-29', true),
('The Grapes of Wrath', 6, "https://upload.wikimedia.org/wikipedia/commons/a/ad/The_Grapes_of_Wrath_%281939_1st_ed_cover%29.jpg", '1939-04-14', true),
('The Pearl', 6, "https://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/The_Pearl_%281947_1st_ed_dust_jacket%29.jpg/800px-The_Pearl_%281947_1st_ed_dust_jacket%29.jpg", '1947-11-08', true);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255),
    password VARCHAR(255),
    email VARCHAR(255),
    permission_level INT
);

INSERT INTO users (username, password, email, permission_level) VALUES
('admin', '$2y$10$LXrs1zxgg.bc1TK7rugWcuJSClBRM54wc45IA5orWsYG.7pFRSm9m', 'admin@books.com', 1);

CREATE TABLE borrowed_books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    book_id INT,
    borrow_date DATE,
    return_date DATE,
    foreign key (user_id) references users(id),
    foreign key (book_id) references books(id)
);

