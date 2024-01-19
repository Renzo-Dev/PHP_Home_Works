-- create table Category
-- (
--     id   serial primary key,
--     Name varchar(105)
-- );
--
-- create table "user"
-- (
--     id   serial primary key,
--     Name varchar(105)
-- );
--
-- create table Product
-- (
--     id         serial primary key,
--     Name       varchar(105),
--     Price      integer,
--     idCategory integer,
--
--     constraint FK_Product_Category foreign key (idCategory) references Category (id)
-- );
--
-- create table Cart
-- (
--     id        serial primary key,
--     userID    integer,
--     productID integer,
--
--     constraint FK_Cart_Product foreign key (productID) references Product (id),
--     constraint FK_Cart_User foreign key (userID) references "user" (id)
-- );

-- insert into users(name) values ('Dan');

-- insert into categories(name) values ('Food');

-- insert into products(name, price, idcategory) values ('Apple', 15,1);

-- insert into carts(userid, productid) values ('1','1');

-- // Всех записей в корзине (выводить всю информацию о пользователе, всю информацию о продукте, всю информацию о категории);
select users.id , users.name as UserName,p.name as ProductName,p.price as ProductPrice, c2.name as category from users
join public.carts c on users.id = c.userid
join public.products p on p.id = c.productid
join public.categories c2 on c2.id = p.idcategory