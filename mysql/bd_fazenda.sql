CREATE DATABASE fazenda;

USE fazenda;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    access_level VARCHAR(10) NOT NULL
);

CREATE TABLE animals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    animal_name VARCHAR(50) NOT NULL,
    animal_type VARCHAR(50) NOT NULL
);