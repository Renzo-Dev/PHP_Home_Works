<?php
require_once 'task1.php';

session_start();

if (!isset($_SESSION['categories'])){
    $_SESSION['categories'] = [];
}
if (!isset($_SESSION['products'])){
    $_SESSION['products'] = [];
}

//$_SESSION['categories'] = [
//    new Category("Cars",
//        [
//            new Product("BMW5",15000),
//            new Product("Audi",10000)
//            ]),
//    new Category("Food",[new Product("Eggs",1.75)])
//];

//print_r($_SERVER["REQUEST_METHOD"]);

if ($_SERVER["REQUEST_METHOD"]==="POST") {
    if (isset($_POST["categoryName"]) && $_POST["categoryName"] != "") {
        // дабавляем обьект КАТЕГОРИЯ в список ( вместе с продуктами, и очищаем список продуктов )
        $categoryName = $_POST["categoryName"];
        $_SESSION['categories'][] = new Category($categoryName, [new Product("Test", 123), new Product("Test", 123)]);

        header("Location: {$_SERVER['PHP_SELF']}"); // перенаправляем страницу саму на себя
        exit(); // что бы не отправлались повторно данные с формы
    }
    if (isset($_POST["productName"]) && isset($_POST["productPrice"]) && ($_POST["productName"] != "" && $_POST["productPrice"] != "") && (is_string($_POST["productName"]) && is_numeric($_POST["productPrice"]))) {
        $productName = $_POST["productName"];
        $productPrice = $_POST["productPrice"];
        $_SESSION['products'][] = new Product($productName, $productPrice);

        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    }
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
        .categories {
            font-size: 20px;
            transition: 300ms ease;
            width: 100px;
        }
        .categories:hover {
            cursor: pointer;
            background-color: #d3d3d3;
        }
    </style>
</head>
<body>
<h3>Добавить продукты</h3>
<form action="<?=$_SERVER["PHP_SELF"]?>" method="post">
    <input name="productName" type="text" autocomplete="off" placeholder="Name">
    <input name="productPrice" type="text" autocomplete="off" placeholder="Price">
    <input type="submit" value="Add">
</form>

<h3>Добавить категорию</h3>
<form action="<?=$_SERVER["PHP_SELF"]?>" method="post">
    <input  name="categoryName" placeholder="Name" autocomplete="off">
    <input type="submit" value="Add">
</form>

<h3>Список Категорий</h3>
<?php
// проверка , если у нас есть категории, выводит список категорий
//if(isset($_SESSION['categories'])){
    if (count($_SESSION['categories'])!=0) {
        foreach ($_SESSION['categories'] as $category) {
            $name = $category->GetCategoryName();
            echo '<div class="categories">' . $name . '</div>';
        }
    }else {
        echo "<div>Нету категорий</div>";
    }
//}else {
//    // если нету создаем переменную
//    $_SESSION['categories'] = [];
//    echo "У нас нету категорий";
//}
?>
<h3>Список продуктов</h3>
<?php
    if (count($_SESSION['products'])!=0) {
        foreach ($_SESSION['products'] as $product) {
            $name = $product->name;
            $price = $product->price;
            echo '<div>' . $name ." ". $price . "$" . '</div>';
        }
    }else {
        echo "<div>В категории нету продуктов</div>";
    }
?>

<script>
    window.addEventListener('DOMContentLoaded',()=>{
        let categoryList = document.querySelectorAll('.categories');

        categoryList.forEach(category => {
            category.addEventListener('click', () => {
                let categoryName = category.textContent;
                const url = window.location.href.trim();
                console.log(url)
                fetch(url, {
                    method: "POST",
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({categorySearch: categoryName})
                })
                    .then(response => {
                        if (response.ok) {
                            console.log('Работает');
                            // Дополнительные действия после успешного ответа
                        } else {
                            console.log('Не работает');
                            // Дополнительные действия при неуспешном ответе
                        }
                    })
                    .catch(error => {
                        console.error('Произошла ошибка:', error);
                        // Дополнительные действия при возникновении ошибки
                    });
            });
        });
    });
</script>
</body>
</html>