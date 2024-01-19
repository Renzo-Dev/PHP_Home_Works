<?php

function getUser()
{
    return "SELECT * FROM users";
}

// Всех записей в корзине (выводить всю информацию о пользователе, всю информацию о продукте, всю информацию о категории);

function getCartInfo($userName): string
{
    return "select users.id , users.name as UserName,p.name as ProductName,p.price as ProductPrice, c2.name as category from users
    join public.carts c on users.id = c.userid
    join public.products p on p.id = c.productid
    join public.categories c2 on c2.id = p.idcategory
    where users.name = '$userName'";
}

function getAllCart(): string
{
    return "select users.id , users.name as UserName,p.name as ProductName,p.price as ProductPrice, c2.name as category from users
    join public.carts c on users.id = c.userid
    join public.products p on p.id = c.productid
    join public.categories c2 on c2.id = p.idcategory";
}