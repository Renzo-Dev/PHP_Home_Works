<?php
session_start();
$_SESSION['session_id'] = 0;
// Проверяем, есть ли переменная session_id
if (isset($_SESSION['session_id'])) {
    // Если session_id равен 0, показываем форму регистрации
    if ($_SESSION['session_id'] == 0) {
        echo "
        <form action='task6.php' method='post'>
            <h1>Регистрация</h1>
            <p>Session ID: 0</p>
            <input type='text' placeholder='Логин' name='login'>
            <br>
            <input type='password' placeholder='Пароль' name='password'>
            <br>
            <input type='submit' value='Зарегистрироваться'>
        </form>";
        $_SESSION['session_id'] = 1;
    } elseif ($_SESSION['session_id'] == 1) {
        // Если session_id равен 1, выводим сообщение об успешной регистрации
        echo "
        <h1>Вы уже зарегистрированы.</h1>
        <p>Session ID: 1</p>
        <br>
        <a href='#'>Войти</a>
        <p></p>";
    } else {
        // Для других значений session_id делаем что-то еще или выводим ошибку
        echo "Некорректное значение session_id";
    }
} else {
    // Если session_id не установлена, показываем форму регистрации по умолчанию
    echo "
    <form action='task6.php' method='post'>
        <h1>Регистрация</h1>
        <p>Session ID не установлен</p>
        <input type='text' placeholder='Логин' name='login'>
        <br>
        <input type='password' placeholder='Пароль' name='password'>
        <br>
        <input type='submit' value='Зарегистрироваться'>
    </form>";
    $_SESSION['session_id'] = 1;
}
?>