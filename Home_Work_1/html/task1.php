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
    Конкатенация: вывод на страницу («Hello! My name
    is 'Name'»), где «Name» — это переменная, в которую
    вводится имя (выводится на странице в кавычках).
    </p>
    Task 2
    Добавить к заданию 1 фразу «I’m Age», где Age — это
    переменная с возрастом студента (выводится с новой
    строки).
</h3>
<?php
$name = "Dan";
$age = 22;
echo 'Hello! My name is \'' . $name . '\'<br>';
echo 'I’m ' . $age;
?>
</body>
</html>