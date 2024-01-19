create table Category
(
    id   serial primary key,
    Name varchar(105)
);

create table "user"
(
    id   serial primary key,
    Name varchar(105)
);

create table Product
(
    id         serial primary key,
    Name       varchar(105),
    Price      integer,
    idCategory integer,

    constraint FK_Product_Category foreign key (idCategory) references Category (id)
);

create table Cart
(
    id        serial primary key,
    userID    integer,
    productID integer,

    constraint FK_Cart_Product foreign key (productID) references Product (id),
    constraint FK_Cart_User foreign key (userID) references "user" (id)
);