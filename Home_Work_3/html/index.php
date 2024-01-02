<?php
require_once 'task1.php';

session_start();

$unProduct = false;

// Инициализация переменных сессии
// Упрощенная инициализация сессионных переменных, используя оператор null coalescing
$_SESSION['categories'] ??= [];
$_SESSION['products'] ??= [];

// Обработка GET-запроса
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (!empty($_GET["SearchCategory"])) {
        // Фильтрация и получение значения для поиска категории
        $searchCategoryName = $_GET["SearchCategory"];

        // Поиск категории по имени
        $found = false;
        foreach ($_SESSION["categories"] as $category) {
            if ($category->GetCategoryName() === $searchCategoryName) {
                // Найдена категория, устанавливаем продукты для сессии
                $_SESSION['products'] = $category->GetProductList();
                $found = true;
                $unProduct = true;
                break;
            }
        }
    }
}

// Обработка POST-запроса
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Добавление новой категории
    if (!empty($_POST["categoryName"]) && trim($_POST["categoryName"]) !== "") {
        if (!empty($_SESSION['products'])) {
            // Фильтрация и получение имени новой категории
            $categoryName = htmlspecialchars($_POST["categoryName"]);

            // Создание новой категории и добавление в сессию
            $_SESSION['categories'][] = new Category($categoryName, $_SESSION['products']);
            $_SESSION['products'] = [];
            header("Location: {$_SERVER['PHP_SELF']}");
            exit();
        }
    }

    // Обработка добавления продукта
    if (isset($_POST["productName"]) && isset($_POST["productPrice"])) {
        // Фильтрация и получение данных нового продукта
        $productName = htmlspecialchars($_POST["productName"]);
        $productPrice = htmlspecialchars($_POST["productPrice"]);

        //  если список использовался для поиска и т.д , очищаем
        if ($unProduct) {
            $_SESSION['products'][] = [];
        }
        if (trim($productName) !== "" && is_numeric($productPrice)) {
            // Создание нового продукта и добавление в сессию
            $_SESSION['products'][] = new Product($productName, $productPrice);
            header("Location: {$_SERVER['PHP_SELF']}");
            exit();
        }
    }

    // Обработка выбора категории
    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, true);

    if (isset($input["SelectCategory"])) {
        // Поиск выбранной категории и передача информации в формате JSON
        // (поддерживается только одна выбранная категория)
        header('Content-Type: application/json');
        $selectedCategory = $input["SelectCategory"];
        $foundCategory = null;

        foreach ($_SESSION['categories'] as $category) {
            if ($selectedCategory === $category->GetCategoryName()) {
                $foundCategory = $category;
                break;
            }
        }

        if ($foundCategory !== null) {
            $unProduct = true;
            $json = [
                'categoryName' => $foundCategory->GetCategoryName(),
                'products' => $foundCategory->GetProductList()
            ];
            $_SESSION['products'] = [];
            echo json_encode($json);
            exit();
        } else {
            echo json_encode(false);
            exit();
        }
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
        input[type="submit"] {
            border-radius: 13px;
            color: black;
            background-color: white;
        }

        input {
            color: black;
        }

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
<form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
    <input name="productName" type="text" autocomplete="off" placeholder="Name">
    <input name="productPrice" type="text" autocomplete="off" placeholder="Price">
    <input type="submit" value="Add">
</form>
<h3>Поиск категории</h3>
<form action="<?= $_SERVER["PHP_SELF"] ?>" method="get">
    <input name="SearchCategory" type="text" placeholder="Search">
    <input type="submit" value="Search">
</form>
<h3>Добавить категорию</h3>
<form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
    <input name="categoryName" placeholder="Name" autocomplete="off">
    <input type="submit" value="Add">
</form>

<h3>Список Категорий</h3>
<?php
// проверка , если у нас есть категории, выводит список категорий
if (count($_SESSION['categories']) != 0) {
    foreach ($_SESSION['categories'] as $category) {
        $name = $category->GetCategoryName();
        echo '<div class="categories">' . $name . '</div>';
    }
} else {
    echo "<div>Нету категорий</div>";
}

?>
<h3>Список продуктов</h3>
<div class="product_list">
    <?php
    if (isset($_SESSION['products']) && count($_SESSION['products']) != 0) {
        foreach ($_SESSION['products'] as $product) {
            $name = $product->name;
            $price = $product->price;
            echo '<div>' . $name . " " . $price . "$" . '</div>';
        }
    } else {
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
                })
                .catch(error => {
                    console.error('Ошибка при выполнении запроса:', error);
                });
        });
    });
</script>
</body>
</html>