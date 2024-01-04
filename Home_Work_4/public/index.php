<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        a:visited, a:link {
            color: #3f44ff;
        }
    </style>
</head>
<body>
<?php
spl_autoload_register();

$users = [];

for ($i = 0; $i < 5; $i++) {
    $users[] = new User("Test$i", "$i" . "Test2024@gmail.com");
}


foreach ($users as $user) {
    echo "<a href='session.php?user=" . $user->GetName() . "&email=" . $user->GetEmail() . "'>" . $user->getUser() . "</a><br>";
}
?>
</body>
</html>