<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task 7</title>
</head>
<body>
<h3>Разработать программу, которая будет рисовать div</h3>
<h3>по указанным в переменных координатам с указанным цветом, если координаты не выходят за пределы экрана.</h3>
<?php
// координаты
$x = 800;
$y = 50;
// цвет background
$color = "green";

$max_width = 800;
$max_height = 600;

if ($x >= 0 && $x <= $max_width && $y >= 0 && $y <= $max_height) {
    // Если координаты находятся в пределах экрана, генерируем div
    echo "<div style='position: relative; left: {$x}px; top: {$y}px; width: 100px; height: 100px; background-color: {$color};'></div>";
} else {
    echo "Координаты выходят за пределы экрана!";
}
?>
</body>
</html>