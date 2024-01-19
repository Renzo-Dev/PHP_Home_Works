<?php
function createCategoryTable(): string
{
    return "CREATE TABLE Categories (
    id   serial PRIMARY KEY,
    Name varchar(105)
);";
}

function createUserTable(): string
{
    return "CREATE TABLE Users (
    id   serial PRIMARY KEY,
    Name varchar(105)
);";
}

function createCartTable(): string
{
    return "CREATE TABLE Carts (
    id        serial PRIMARY KEY,
    userID    integer,
    productID integer,
    CONSTRAINT FK_Cart_Product FOREIGN KEY (productID) REFERENCES Products (id),
    CONSTRAINT FK_Cart_User FOREIGN KEY (userID) REFERENCES Users (id)
);";
}

function createProductTable(): string
{
    return "CREATE TABLE Products (
    id         serial PRIMARY KEY,
    Name       varchar(105),
    Price      integer,
    idCategory integer,
    CONSTRAINT FK_Product_Category FOREIGN KEY (idCategory) REFERENCES Categories (id)
);";
}