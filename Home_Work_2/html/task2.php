<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task 2</title>
</head>
<body>
<h1><a href="index.php">MAIN PAGE</a></h1>
<h3>Task 1
    <div>Вывести квадрат большего из двух чисел.</div>
</h3>
<form action="task2.php" method="get">
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

    if ($first_variable > $second_variable) {
        $result = $first_variable * $first_variable;
        echo "Квадрат большего числа ($first_variable) равен $result";
    } elseif ($second_variable > $first_variable) {
        $result = $second_variable * $second_variable;
        echo "Квадрат большего числа ($second_variable) равен $result";
    } else {
        echo "Числа равны, квадраты равны";
    }
} else {
    echo "Первое значение или второе значение, не были переданы";
}
?>
</body>
</html>