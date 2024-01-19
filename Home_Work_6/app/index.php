<?php
require_once ('database/Queries_PHP/QueryConstructor.php');
require_once('database/Queries_PHP/Create/createTables.php');

$query = new QueryConstructor("postgres","5432","Renzo","Dan098dan","homeWork");
$query->Create([createCategoryTable(),createUserTable(),createProductTable(),createCartTable()]);

?>

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

</body>
</html>