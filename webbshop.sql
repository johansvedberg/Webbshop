/* 
Skapar tabellen för users, med email som primärnyckel.
**/

CREATE TABLE users (
firstName varchar(50),
lastName varchar(50),
address varchar(100),
password varchar(50) NOT NULL,
email varchar(50) NOT NULL,
salt varchar(8) NOT NULL,
PRIMARY KEY (email),
FOREIGN KEY 
)

/*
Skapar tabellen för produkter.
**/

CREATE TABLE products (
name varchar(50) NOT NULL,
articleID int NOT NULL AUTO_INCREMENT,
price int, 
quantity int,
PRIMARY KEY (articleID)
)


