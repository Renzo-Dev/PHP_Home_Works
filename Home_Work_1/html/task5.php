<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task 5</title>
</head>
<body>
<h3>
    <div>1 — вопрос с 4 вариантами ответа и только 1 из них правильный;</div>
    <div>2 — вопрос с 4 вариантами ответа и может быть несколько правильных;</div>
    <div>3 — вопрос с развернутым ответом</div>
</h3>
<h1><a href="index.php">MAIN PAGE</a></h1>
<form action="task5.php" method="post">

    <h2>a) Вопрос с одним правильным ответом:</h2>
    <p>1. Сколько сантиметров в метре?</p>
    <input type="radio" name="q1" value="a"> a) 90<br>
    <input type="radio" name="q1" value="b"> b) 100<br>
    <input type="radio" name="q1" value="c"> c) 40<br>
    <input type="radio" name="q1" value="d"> d) 50<br>

    <h2>b) Вопрос с несколькими правильными ответами:</h2>
    <p>2. Какие из перечисленных языков являются языками программирования?</p>
    <input type="checkbox" name="q2[]" value="a"> a) HTML<br>
    <input type="checkbox" name="q2[]" value="b"> b) C++<br>
    <input type="checkbox" name="q2[]" value="c"> c) PHP<br>
    <input type="checkbox" name="q2[]" value="d"> d) IMG<br>

    <h2>c) Вопрос с развернутым ответом:</h2>
    <p>3. Почему , PHP не PHH, а PHP это PHP? :</p>
    <textarea name="q3""></textarea>
    <br>
    <input type="submit" value="Отправить ответы">

</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Проверяем, был ли выбран ответ на первый вопрос
    if (isset($_POST['q1'])) {
        $answer1 = $_POST['q1'];
        if ($answer1 === 'b') {
            echo "<p>Ответ на вопрос 1: $answer1 | Правильный</p>";
        } else {
            echo "<p>Ответ на вопрос 1: $answer1 | Не правильный</p>";
        }
    }

    // Проверяем, были ли выбраны ответы на второй вопрос
    if (isset($_POST['q2'])) {
        $answers2 = $_POST['q2'];
        echo 'Ответ на вопрос 2: <p>';
        foreach ($answers2 as $answer) {
            if ($answer === 'b' || $answer === 'c') {
                echo "$answer | Верен <p>";
            } else {
                echo "$answer | Не верен <p>";
            }
        }
    }

    // Проверяем, был ли введен ответ на третий вопрос
    if (isset($_POST['q3'])) {
        $answer3 = $_POST['q3'];
        if (!empty($answer3)) {
            echo "<p>Ответ на вопрос 3: $answer3</p>";
        } else {
            echo "<p>Ответ на вопрос 3: Потому что гладиолус</p>";
        }
    }
}
?>
</body>
</html>