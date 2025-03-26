<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Переводчик</title>
</head>
<body>
    <form action="" method="post">
        <label for="digit">Введите цифру:</label>
        <input type="number" id="digit" name="digit" required>
        <button type="submit">Перевести</button>
    </form>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $words = [
        0 => "Нуль",
        1 => "Один",
        2 => "Два",
        3 => "Три",
        4 => "Четыре",
        5 => "Пять",
        6 => "Шесть",
        7 => "Семь",
        8 => "Восемь",
        9 => "Девять"
    ];
    $digit = (int) $_POST["digit"];
    if ($digit >= 0 && $digit <= 9) {
        echo $words[$digit];
    }
    else {
        echo "Not digit";
    }
}
?>