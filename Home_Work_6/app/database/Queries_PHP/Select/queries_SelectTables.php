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

function CategoryWithoutUserProducts($userName): string
{
    return "
        SELECT distinct c.id AS category_id, c.name AS category_name
             FROM categories c
             JOIN products p ON c.id = p.idcategory
             LEFT JOIN (
                  SELECT DISTINCT c.userid, p.id AS product_id
                     FROM carts c
                 JOIN products p ON c.productid = p.id
        WHERE c.userid = any (SELECT u.id FROM users AS u WHERE u.name = '$userName')
    ) user_cart ON p.id = user_cart.product_id
    WHERE user_cart.product_id is null and EXISTS (SELECT 1 FROM users AS u WHERE u.name = '$userName');
    ";
}