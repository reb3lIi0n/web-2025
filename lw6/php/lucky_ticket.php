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
//обработать все кейсы в том числе одинаковый ввод
?>
