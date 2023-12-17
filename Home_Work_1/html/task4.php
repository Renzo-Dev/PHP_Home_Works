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
<h1><a href="index.php">MAIN PAGE</a></h1>
<?php
$a = 44;
$b = 3;

echo "До обмена: a = $a, b = $b<br>";

$a = $a + $b;
$b = $a - $b;
$a = $a - $b;

echo "После обмена: a = $a, b = $b";

?>
</body>
</html>