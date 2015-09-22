/*
Tar bort gamla tables
**/
set foreign_key_checks = 0;
Drop table if exists Users;
Drop table if exists Products;
Drop table if exists LoginAttempts;

set foreign_key_checks = 1;
/*
Skapar tabellen för users, med email som primärnyckel.
**/
CREATE TABLE Users (
firstName varchar(50),
lastName varchar(50),
address varchar(100),
email varchar(50) NOT NULL,
password varchar(70) NOT NULL,
salt varchar(70) NOT NULL,
failedLogins int,
session varchar(70),
PRIMARY KEY (email)
);
/*
Skapar tabellen för produkter.
**/
CREATE TABLE Products (
name varchar(50) NOT NULL,
articleID int AUTO_INCREMENT NOT NULL,
price int,
quantity int,
PRIMARY KEY (articleID)
);
/*
Skapar en tabell för inloggningsförsök.
**/
CREATE TABLE LoginAttempts (
AttemptID int AUTO_INCREMENT NOT NULL,
userEmail varchar(50) NOT NULL,
time timestamp,
IP varchar(50),
status boolean,
PRIMARY KEY (AttemptID),
FOREIGN KEY (userEmail) REFERENCES Users(email)
);
/*
Gör insättningar i Users.
**/
INSERT INTO Users
Values ('Adam', 'Oldin', 'Svanegatan 7B', 'adam.oldin@gmail.com', 'a85b77e934bdcefa29142cf087867b56971196a89fd102ba1c6b5e9d17466deb', '12345678', 0, NULL);

/*
Gör insättningar i products.
**/
INSERT INTO Products
Values ('Rubber Ducky', ' ',5.00, 500);
INSERT INTO Products
Values ('Toy Locomotive', ' ', 15.00, 250);
INSERT INTO Products
Values ('BB8 Robot', ' ', 500.00, 100);
INSERT INTO Products
Values ('Ducky Rubber', ' ', 2.50, 750);

/*
Genomför lite tester.
**/

