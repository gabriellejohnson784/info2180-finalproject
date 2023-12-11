-- Drop the user if it exists and then create a new user
DROP USER IF EXISTS 'user'@'localhost';
CREATE USER 'user'@'localhost' IDENTIFIED BY 'password123';

-- Grant all privileges on the new database to the new user
GRANT ALL PRIVILEGES ON dolphin_crm.* TO 'user'@'localhost';
FLUSH PRIVILEGES;

-- Drop the database if it exists, and then create a new database
DROP DATABASE IF EXISTS dolphin_crm;
CREATE DATABASE dolphin_crm;

-- Select the database for use
USE dolphin_crm;

-- Create the Users table
CREATE TABLE Users (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(255),
    lastname VARCHAR(255),
    password VARCHAR(255),
    email VARCHAR(255),
    role VARCHAR(255),
    created_at DATETIME
);

-- Create the Contacts table
CREATE TABLE Contacts (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    firstname VARCHAR(255),
    lastname VARCHAR(255),
    email VARCHAR(255),
    telephone VARCHAR(255),
    company VARCHAR(255),
    type VARCHAR(255),
    assigned_to INTEGER,
    created_by INTEGER,
    created_at DATETIME,
    updated_at DATETIME
);

-- Create the Notes table as per your schema
CREATE TABLE Notes (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    contact_id INTEGER,
    comment TEXT,
    created_by INTEGER,
    created_at DATETIME
);

-- Insert a user into the Users table
INSERT INTO Users (firstname, lastname, email, password, role, created_at) 
VALUES ('Admin2', 'User', 'admin@project2.com', SHA2('password123', 256), 'Admin', NOW());

-- Remember to set up Foreign Keys or other constraints as necessary
