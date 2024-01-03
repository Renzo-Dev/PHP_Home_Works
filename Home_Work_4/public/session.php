<?php
if (isset($_GET['user'])) {
    $userData = urldecode($_GET['user']);

    // почта / логин - привязана история покупок в формате: дата и sessionID

    // при нажатии на сессию , получаем продукты которые были приобретены в сессии ( отправляем запрос на cart.php с номером сессии, а там уже делается запрос и получение проудктовв )


    // Вывод информации о покупках для пользователя
    echo "<h1>Purchase History for User:</h1>";
    echo "<p>{$userData}</p>";
    // Пример ссылки на cart.php для конкретной сессии пользователя
    echo "<a href='cart.php?sessionId=123'>View Session</a>";
} else {
    echo "No user data found!";
}
?>
