<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task 6</title>
</head>
<body>
<h1><a href="index.php">MAIN PAGE</a></h1>
<h2>
    <div>Разработать страницу с переменными:</div>
    <div>tag, background_color, color, width, height;</div>
    <div>Значение в этих переменных — это значение соответствующего property тега, который описан в переменной tag;</div>
    <div>Вывести тег, записанный в переменной tag со стилями, которые записаны в переменных.</div>
</h2>
<?php
$background_color = "blue";
$tag = "div";
$color = "RED";
$width = "300px";
$height = "300px";
$font_size = "35px";

echo "<$tag style='background-color: $background_color; font-size: $font_size; color: $color; width: $width; height: $height;'>Hello</$tag>";
?>
</body>
</html>