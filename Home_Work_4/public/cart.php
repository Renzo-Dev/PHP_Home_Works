<?php
if (isset($_GET['sessionId'])) {
    $sessionId = $_GET['sessionId'];
    // Получение данных о продуктах для сессии по sessionId и вывод на страницу
    echo "<h1>Products for Session ID: {$sessionId}</h1>";
    // Вывод информации о продуктах для сессии
} else {
    echo "No session ID found!";
}
?>
