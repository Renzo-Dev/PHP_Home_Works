<?php
function createCategoryTable():string
{
    return "CREATE TABLE Category (
    id   serial PRIMARY KEY,
    Name varchar(105)
);";
}

function createUserTable():string
{
    return "CREATE TABLE \"user\" (
    id   serial PRIMARY KEY,
    Name varchar(105)
);";
}

function createCartTable():string
{
    return "CREATE TABLE Cart (
    id        serial PRIMARY KEY,
    userID    integer,
    productID integer,
    CONSTRAINT FK_Cart_Product FOREIGN KEY (productID) REFERENCES Product (id),
    CONSTRAINT FK_Cart_User FOREIGN KEY (userID) REFERENCES \"user\" (id)
);";
}

function createProductTable():string
{
    return "CREATE TABLE Product (
    id         serial PRIMARY KEY,
    Name       varchar(105),
    Price      integer,
    idCategory integer,
    CONSTRAINT FK_Product_Category FOREIGN KEY (idCategory) REFERENCES Category (id)
);";
}