<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Знаки зодиака</title>
</head>
<body>
    <form action="" method="post">
        <label for="date">Введите дату:</label>
        <input type="text" id="date" name="date" required>
        <button type="submit">Продолжить</button>
    </form>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function getZodiacSign($date) {
        list($day, $month, $year) = explode(".", $date);
        $zodiacSigns = [
            ["Козерог", "22", "12", "19", "01"],
            ["Водолей", "20", "01", "18", "02"],
            ["Рыбы", "19", "02", "20", "03"],
            ["Овен", "21", "03", "19", "04"],
            ["Телец", "20", "04", "20", "05"],
            ["Близнецы", "21", "05", "20","06"],
            ["Рак", "21", "06", "22", "07"],
            ["Лев", "23", "07", "22", "08"],
            ["Дева", "23", "08", "22", "09"],
            ["Весы", "23", "09", "22", "10"],
            ["Скорпион", "23","10", "21", "11"],
            ["Стрелец", "22", "11", "21", "12"]
        ];
        foreach ($zodiacSigns as [$sign, $startDay, $startMonth, $endDay, $endMonth]) {
            if (($month == $startMonth && $day >= $startDay) || ($month == $endMonth && $day <= $endDay)) {
                return $sign;
            }
        }
        return "Неверная дата";
    }
    $inputDate = (string) $_POST["date"];
    echo "Знак зодиака: " . getZodiacSign($inputDate);
}
?>