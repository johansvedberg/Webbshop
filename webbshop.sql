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
Values ('Adam', 'Oldin', 'Svanegatan 7B', 'adam.oldin@gmail.com', 'a85b77e934bdcefa29142cf087867b56971196a89fd102ba1c6b5e9d17466deb', '12345678', 0);
INSERT INTO Users
Values ('Johan', 'Svedberg', 'Nilsvägen 7B', 'johan.Svedberg@gmail.com', 'test321', '87654321', 3);
INSERT INTO Users
Values ('Tjorben', 'Dolsson', 'Victoriastadion', 'Dorben.91@hotmail.com', 'qwerty', '54632178', 13);
INSERT INTO Users
Values ('Gust', 'Alfredsson', 'Dammhagen 12', 'Gust.rage93@gmail.com', '1234sda', '12348765', 1);
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


INSERT INTO LoginAttempts
Values (' ', 'adam.oldin@gmail.com', ' ','255.255.255.0', true);
INSERT INTO LoginAttempts
Values (' ', 'adam.oldin@gmail.com', ' ','255.255.255.0', true);
INSERT INTO LoginAttempts
Values (' ', 'Gust.rage93@gmail.com', ' ','255.255.255.0', true);
INSERT INTO LoginAttempts
Values (' ', 'Dorben.91@hotmail.com', ' ','255.255.255.0', true);
INSERT INTO LoginAttempts
Values (' ', 'Dorben.91@hotmail.com', ' ','255.255.255.0', true);
INSERT INTO LoginAttempts
Values (' ', 'adam.oldin@gmail.com', ' ','255.255.255.0', true);
/*
Genomför lite tester.
**/
Select * from Users;
Select * from Products;
Select * from LoginAttempts;
Select * from Users natural join LoginAttempts;
Select firstName lastName from Users where email = 'Dorben.91@hotmail.com';
