<?php

function insertUser($name): string
{
    return "insert into users(name) values ('$name');";
}

function insertCart($userId,$productId):string
{
    return "insert into carts(userid, productid) values ('$userId','$productId');";
}

function insertProduct($productName,$price,$idCategory):string
{
    return "insert into products(name, price, idcategory) values ('$productName', $price,$idCategory);";
}

function insertCategory($categoryName):string
{
    return "insert into categories(name) values ('$categoryName');";
}