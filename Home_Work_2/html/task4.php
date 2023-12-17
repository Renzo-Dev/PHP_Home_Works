<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h3>Есть переменная, в ней (в скрипте) сохранен год. Проверить, является ли внесенный год високосным.</h3>
<h1><a href="index.php">MAIN PAGE</a></h1>
<?php
// Проверка на високосный год (например, 2020 - високосный)
$year =  2020; // date('Y');
$is_leap_year = ((($year % 4) == 0) && ((($year % 100) != 0) || (($year % 400) == 0)));

if ($is_leap_year) {
    echo "<p>Year = $year</p>";
    echo "<p>$year is leap-year</p>";
} else {
    echo "<p>Year = $year</p>";
    echo "<p>$year isn't leap-year</p>";
}
?>
</body>
</html>