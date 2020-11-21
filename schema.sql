DROP DATABASE IF EXISTS finalproject;
CREATE DATABASE finalproject;
USE finalproject;

DROP TABLE IF EXISTS Users;
CREATE TABLE Users(
    id INT(25) NOT NULL AUTO_INCREMENT,
    firstname VARCHAR(50),
    lastname VARCHAR(50),
    password VARCHAR(50),
    email VARCHAR(50),
    date_joined DATETIME,
    PRIMARY KEY(id)
);
DROP TABLE IF EXISTS Issues;
CREATE TABLE Issues(
    id INT(25) NOT NULL AUTO_INCREMENT ,
    title VARCHAR(50),
    description TEXT,
    type VARCHAR(50),
    priority VARCHAR(50),
    status VARCHAR(50),
    asssigned_to INT(8),
    created_by INT(8),
    created DATETIME,
    updated DATETIME,
    PRIMARY KEY(id),
);
INSERT INTO Users(firstname,email,password,date_joined) VALUES ('admin','admin@project2.com','password123',CURRENT_TIMESTAMP);


/*
QUERIES 

input new user into users table.
INSERT INTO Users(firstname,lastname,password,email,date_joined) VALUES(,CURRENT_TIMESTAMP);

query to get all the issues
SELECT Issues.id,title,type,status,Users.firstname,Users.lastname,created FROM Issues INNER JOIN Users ON Issues.assigned_to=Users.id;

query to input/create a new issue in the Issues table
INSERT INTO Issues(title,description,type,priority,status,assigned_to,created_by,created,updated) VALUES(,CURRENT_TIMESTAMP);

query to get the detals of an issue
SELECT * FROM Issues WHERE id= ;
*/