<?php
session_start();

// Проверка, установлена ли переменная session_id
if (!isset($_SESSION['session_id'])) {
    $_SESSION['session_id'] = 0; // Если не установлена, устанавливаем значение по умолчанию (0)
}

// Проверка значения переменной session_id
if ($_SESSION['session_id'] == 1) {
    // Если значение 0, показываем форму регистрации
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Форма регистрации</title>
    </head>
    <body>
    <h1>Форма регистрации</h1>
    <!-- Форма для ввода логина и пароля -->
    <form action="task6.php" method="POST">
        <label for="login">Логин:</label><br>
        <input type="text" id="login" name="login"><br>
        <label for="password">Пароль:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Войти">
    </form>
    </body>
    </html>

    <?php
} else {
    // Если значение 1, выводим сообщение
    echo "Вы зарегистрированы, войдите";
}
?>
