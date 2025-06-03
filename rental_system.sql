CREATE DATABASE IF NOT EXISTS rental_system;
USE rental_system;

-- users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255)
);

-- bookings table
CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    vehicle VARCHAR(100),
    pickup VARCHAR(100),
    drop_location VARCHAR(100),
    ride_date DATE,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
