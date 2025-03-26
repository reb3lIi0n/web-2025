<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Факториал числа</title>
</head>
<body>
    <form action="" method="post">
        <label for="number">Введите число:</label>
        <input type="number" id="number" name="number" required>
        <button type="submit">Продолжить</button>
    </form>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function getFactorial($number){
        if ($number <= 0) return 1;
        return $number * getFactorial($number - 1);
    }
    echo getFactorial((int) $_POST["number"]);
}
?>