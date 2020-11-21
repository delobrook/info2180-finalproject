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