<?php
if (isset($_GET['user']) && isset($_GET['email'])) {

    // получаем список истории покупок пользователя
    // делаем запрос в бд, с данными пользователя, и получаем список истории покупок
    // псевдо список
    $shopHistory = [];

    for ($i = 0; $i < random_int(2, 10); $i++) {
        $shopHistory[] = new ShopHistory();
    }

    foreach ($shopHistory as $item) {
        echo "<div>" . $item->date . " - " . "<a href='cart.php?sessionID=$item->sessionID&date=$item->date'>$item->sessionID</a>" . "</div>";
    }

} else {
    echo "No user data found!";
}


class ShopHistory
{
    public $date;
    public $sessionID;

    public function __construct()
    {
        $this->sessionID = random_int(10000, 99999); // генерация sessionID

        $randomYear = rand(1970, 2030); // Генерация случайного года
        $randomMonth = rand(1, 12); // Генерация случайного месяца (от 1 до 12)
        $randomDay = rand(1, 31); // Генерация случайного дня (от 1 до 31, без учёта високосных годов)

        $randomHour = rand(0, 23); // Генерация случайного часа (от 0 до 23)
        $randomMinute = rand(0, 59); // Генерация случайных минут (от 0 до 59)
        $randomSecond = rand(0, 59); // Генерация случайных секунд (от 0 до 59)

        $randomDateTime = sprintf("%02d/%02d/%04d %02d:%02d:%02d", $randomDay, $randomMonth, $randomYear, $randomHour, $randomMinute, $randomSecond);
        $this->date = $randomDateTime;
    }
}

?>