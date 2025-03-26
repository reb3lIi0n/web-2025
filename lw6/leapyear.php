<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Проверка високосного года</title>
</head>
<body>
    <form action="" method="post">
        <label for="year">Введите год:</label>
        <input type="number" id="year" name="year" required>
        <button type="submit">Проверить</button>
    </form>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $year = (int) $_POST["year"];
    if ($year > 0 && $year <= 30000) {
        if ($year % 4 == 0 || $year % 100 == 0 && $year % 400 == 0) {
            echo "YES";
        }
        else {
            echo "NO";
        }
    }
}
?>