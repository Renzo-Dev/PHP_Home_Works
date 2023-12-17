<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task 1</title>
</head>
<body>
<h1><a href="index.php">MAIN PAGE</a></h1>
<h3>Task 1
    <div>Есть 2 переменные. Проверить и вывести на экран,</div>
    <div>является ли значение первой переменной кратным</div>
    <div>значению второй (первое число кратно второму, если</div>
    <div>делится на него без остатка).</div>
</h3>
<form action="task1.php" method="get">
    <label>Первое значение
        <input name="firstValue">
    </label>
    <label>Второе значение
        <input name="secondValue">
    </label>
    <button type="submit">Сравнить</button>
</form>
<?php
if (isset($_GET['firstValue']) && isset($_GET['secondValue'])) {
    $first_variable = floatval($_GET['firstValue']);
    $second_variable = floatval($_GET['secondValue']);

    if ($second_variable != 0) {
        if ($first_variable % $second_variable === 0) {
            echo "$first_variable кратно $second_variable";
        } else {
            echo "$first_variable не кратно $second_variable";
        }
    } else {
        echo "Деление на ноль невозможно";
    }
} else {
    echo "Первое значение или второе значение, не были переданы";
}

?>
</body>
</html>