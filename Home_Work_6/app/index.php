<?php
require_once ('database/Queries_PHP/QueryConstructor.php');
require_once('database/Queries_PHP/Create/queries_createTables.php');
require_once('database/Queries_PHP/Insert/queries_InsertTables.php');
require_once('database/Queries_PHP/Select/queries_SelectTables.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["createTables"]) && $_POST["createTables"] != "") {
        $query = new QueryConstructor("postgres", "5432", "Renzo", "Dan098dan", "homeWork");
        $query->Create([createCategoryTable(), createUserTable(), createProductTable(), createCartTable()]);
    } else if (isset($_POST["addUser"]) && $_POST["addUser"] != "") {
        $query = new QueryConstructor("postgres", "5432", "Renzo", "Dan098dan", "homeWork");
        $query->Insert(insertUser($_POST["addUser"]));
    } else if ((isset($_POST["productIdCart"]) && isset($_POST["userIdCart"])) && ($_POST["userIdCart"] != "" && $_POST["productIdCart"] != "")) {
        $query = new QueryConstructor("postgres", "5432", "Renzo", "Dan098dan", "homeWork");
        $query->Insert(insertCart($_POST["userIdCart"], $_POST["productIdCart"]));
    } else if ((isset($_POST["productName"]) && isset($_POST["productPrice"]) && isset($_POST["categoryId"])) && ($_POST["productName"] != "" && $_POST["productPrice"] != "" && $_POST["categoryId"] != "")) {
        $query = new QueryConstructor("postgres", "5432", "Renzo", "Dan098dan", "homeWork");
        $query->Insert(insertProduct($_POST["productName"], $_POST["productPrice"], $_POST["categoryId"]));
    } else if (isset($_POST["categoryName"]) && $_POST["categoryName"] != "") {
        $query = new QueryConstructor("postgres", "5432", "Renzo", "Dan098dan", "homeWork");
        $query->Insert(insertCategory($_POST["categoryName"]));
    }
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        input {
            color: black;
        }
    </style>
</head>
<body>
<form action="<?=$_SERVER["PHP_SELF"]?>" method="post">
    <input name="createTables" value="Создать таблицы в БД" type="submit">
</form>
<h2>Добавить User</h2>
<form action="<?=$_SERVER["PHP_SELF"]?>" method="post">
    <input name="addUser" type="text" placeholder="Name" autocomplete="off">
    <input type="submit" value="Добавить User">
</form>
<h2>Добавить Cart</h2>
<form action="<?=$_SERVER["PHP_SELF"]?>" method="post">
    <input name="userIdCart" type="text" placeholder="UserId">
    <input name="productIdCart" type="text" placeholder="productId">
    <input type="submit" value="Add Cart">
</form>
<h2>Добавить Product</h2>
<form action="<?=$_SERVER["PHP_SELF"]?>" method="post">
    <input name="productName" type="text" placeholder="Name">
    <input name="productPrice" type="text" placeholder="Price">
    <input name="categoryId" type="text" placeholder="categoryID">
    <input type="submit" value="Add Product">
</form>
<h2>Добавить Category</h2>
<form action="<?=$_SERVER["PHP_SELF"]?>" method="post">
    <input name="categoryName" type="text" placeholder="Название Категории">
    <input type="submit" value="Add Category">
</form>
</p>
<form action="<?=$_SERVER["PHP_SELF"]?>" method="get">
    <input name="getUsers" style="display: none">
    <input type="submit" value="Получить всех пользователей">
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        if (isset($_GET["getUsers"])) {
            $query = new QueryConstructor("postgres", "5432", "Renzo", "Dan098dan", "homeWork");
            $allUsers = $query->Select(getUser());
            foreach ($allUsers as $User) {
                echo "<div>ID - " . $User["id"] . " Name: " . $User["name"] . "</div>";
            }
        }
    }
    ?>
</form>
</p>
<form action="<?=$_SERVER["PHP_SELF"]?>" method="get">
    <input type="submit" value="Получить информацию о пользователе">
    <input name="getUserCart" type="text" placeholder="Введите имя пользователя">
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        if (isset($_GET["getUserCart"]) && $_GET["getUserCart"] != "") {
            $query = new QueryConstructor("postgres", "5432", "Renzo", "Dan098dan", "homeWork");
            $userCartInfo = $query->Select(getCartInfo($_GET["getUserCart"]));
            if (count($userCartInfo) === 0) {
                echo "<div>Нету информации о пользователе</div>";
            }
            echo "<div>Имя пользователя:" . $userCartInfo[0]['username'] . "</div>";
            echo "<div>ID пользователя:" . $userCartInfo[0]['id'] . "</div>";
            echo "<div>Продукты в карзине:</div>";
            foreach ($userCartInfo as $item) {
                echo "<div style='display: flex'>";
                echo "<div style='margin-right: 10px'>" . $item['category'] . "</div>";
                echo "<div style='margin-right: 15px'>" . $item['productname'] . "</div>";
                echo "<div>" . $item['productprice'] . "грн</div>";
                echo "</div>";
            }
        }
    }
    ?>
</form>
</body>
</html>