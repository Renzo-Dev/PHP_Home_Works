<?php

require_once ('User.php');

$users = [];

for($i = 0;$i < 5;$i++){
    $users[] = new User("Test","Test2024@gmail.com");
}

foreach ($users as $user) {
    echo "<a href='session.php?user=" . urlencode($user->getUser()) . "'>" . $user->getUser() . "</a><br>";
}