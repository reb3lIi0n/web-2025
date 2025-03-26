<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Счастливый билет</title>
</head>
<body>
    <form action="" method="post">
        <label for="first-number">Введите первое число:</label>
        <input type="number" id="first-number" name="first-number" required>
        <label for="second-number">Введите второе число:</label>
        <input type="number" id="second-number" name="second-number" required>
        <button type="submit">Продолжить</button>
    </form>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function isLuckyTicket($ticket) {
        $firstHalf = substr($ticket, 0, 3);
        $secondHalf = substr($ticket, 3, 3);
        $sumFirst = array_sum(str_split($firstHalf));
        $sumSecond = array_sum(str_split($secondHalf));
        return $sumFirst === $sumSecond;
    }
    $luckyTickets = [];
    $firstNumber = (int) $_POST["first-number"];
    $secondNumber = (int) $_POST["second-number"];
    for ($i = $firstNumber; $i < $secondNumber; $i++) {
        $ticket = str_pad($i, 6, "0", STR_PAD_LEFT);
        if (isLuckyTicket($i)) {
            $luckyTickets[] = str_pad($i, 6, "0", STR_PAD_LEFT);
        }
    }
    echo implode("\n", $luckyTickets);
}
?>