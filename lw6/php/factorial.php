<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function getFactorial($number){
        if ($number <= 0) return 1;
        return $number * getFactorial($number - 1);
    }
    echo getFactorial((int) $_POST["number"]);
}
//только натуральные числа
?>
