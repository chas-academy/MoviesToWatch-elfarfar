CREATE DATABASE todo_list;

USE moviestodo;

CREATE TABLE movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    type ENUM('Movie', 'Series') NOT NULL,
    genre ENUM('Action', 'Comedy', 'Adventure', 'Horror', 'Documentary', 'War') NOT NULL,
    seen BOOLEAN DEFAULT FALSE
);

