<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task 3</title>
</head>
<body>
<h3>
    Есть переменная, в ней сохранен номер месяца (в коде
    скрипта). Скрипт возвращает количество дней в этом
    месяце.
</h3>
<h1><a href="index.php">MAIN PAGE</a></h1>
<?php
$month = 3;
$year = date('Y'); // Год можно также задать нужным образом
//$daysInMonth = date('t', mktime(0, 0, 0, $month, 1, $year));
echo "<p>Month = $month </p>";
echo "<p>Days in the month: ".date('t', mktime(0, 0, 0, $month, 1, $year))."</p>"
?>
</body>
</html>