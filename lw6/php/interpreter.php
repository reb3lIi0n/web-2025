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