<?php
require_once 'task1.php';

session_start();

if (!isset($_SESSION['categories'])){
    $_SESSION['categories'] = [];
}

if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = [];
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Добавление категории
    if (isset($_POST["categoryName"]) && $_POST["categoryName"] != " ") {
        if (count($_SESSION['products']) != 0) {
            $categoryName = $_POST["categoryName"];
            $_SESSION['categories'][] = new Category($categoryName, $_SESSION['products']);
            $_SESSION['products'] = [];
        }
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    }

    // Добавление продукта
    if (isset($_POST["productName"]) && isset($_POST["productPrice"])) {
        if (($_POST["productName"] !== " " && $_POST["productPrice"] !== " ") && (is_string($_POST["productName"]) && is_numeric($_POST["productPrice"]))) {
            $productName = $_POST["productName"];
            $productPrice = $_POST["productPrice"];
            $_SESSION['products'][] = new Product($productName, $productPrice);
            header("Location: {$_SERVER['PHP_SELF']}");
            exit();
        }else {
            header("Location: {$_SERVER['PHP_SELF']}");
            exit();
        }
    }

    // Проверка наличия категории
    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, true);

    if (isset($input["SelectCategory"])) {
        header('Content-Type: application/json');
        foreach ($_SESSION['categories'] as $category){
            if ($input["SelectCategory"] === $category->GetCategoryName()){
                $json = array(['categoryName'=>$category->GetCategoryName()],
                    'products'=>$category->GetProductList());
                $_SESSION['products'] = [];
                echo json_encode($json);
                exit();
            }
        }
        echo json_encode(false);
        exit();
    } else {
        header('Content-Type: application/json');
        echo json_encode(false);
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
            color: black;
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
<div class="product_list">
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
</div>

<script>
    let categories = document.querySelectorAll('.categories');
    categories.forEach(category => {
        category.addEventListener('click', () => {
            const url = 'index.php';
            const data = {
                SelectCategory: category.textContent // Замените на нужное значение
            };
            const requestOptions = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            };

            fetch(url, requestOptions)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data != null) {
                        categories.forEach(elem => {
                            elem.style.color = 'black';
                        });
                        category.style.color = 'Red';

                        if (data.products.length > 0) {
                            let products_list = document.querySelector('.product_list');
                            while (products_list.firstChild) {
                                products_list.removeChild(products_list.firstChild);
                            }
                            // изменяем список продуктов
                            data.products.forEach(product => {
                                let newElemProduct = document.createElement('div');
                                newElemProduct.textContent = `${product.name} ${product.price}$`;
                                products_list.appendChild(newElemProduct);
                            })
                        }
                    }
                    // Делайте что-то с данными, полученными от сервера
                })
                .catch(error => {
                    console.error('Ошибка при выполнении запроса:', error);
                });
        });
    });
</script>
</body>
</html>