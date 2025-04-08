<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $year = (int) $_POST["year"];
    if ($year > 0 && $year <= 30000) {
        if ($year % 4 == 0 && $year % 100 != 0 || $year % 400 == 0) {
            echo "YES";
        }
        else {
            echo "NO";
        }
    }
}
//Добавить is_numeric проверку
?>