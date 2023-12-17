<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task 5</title>
</head>
<body>
<h3>
    <div>Вывести сумму двух чисел, если они оба кратны 3, или</div>
    <div>вывести результат деления при условии, что второе</div>
    <div>число не равно нулю (если ноль, то выводится сообщение о некорректном вводе).</div>
</h3>
<h1><a href="index.php">MAIN PAGE</a></h1>
<form action="task5.php" method="get">
    <label>Первое значение
        <input name="firstValue">
    </label>
    <label>Второе значение
        <input name="secondValue">
    </label>
    <button type="submit">Сравнить</button>
</form>
<?php
function calculateSumOrDivision($num1, $num2): string {
    if ($num1 % 3 === 0 && $num2 % 3 === 0) {
        // Если оба числа кратны 3, выводим их сумму
        return "Два числа кратны 3, сумма чисел = " . ($num1 + $num2);
    } elseif ($num2 !== 0) {
        // Если второе число не равно нулю, выводим результат деления
        return "Результат деления $num1 / $num2 = " . ($num1 / $num2);
    } else {
        // Если второе число равно нулю, выводим сообщение об ошибке
        return "Некорректный ввод. Второе число равно нулю.";
    }
}

if (isset($_GET['firstValue']) && isset($_GET['secondValue'])) {
    $num1 = intval($_GET['firstValue']);
    $num2 = intval($_GET['secondValue']);
    $result = calculateSumOrDivision($num1, $num2);
    echo "Результат: " . $result;
}
?>
</body>
</html>