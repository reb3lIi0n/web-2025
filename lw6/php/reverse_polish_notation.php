<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function evaluatePostfix($expression) {
        $stack = [];
        $tokens = explode(" ", $expression);
        foreach ($tokens as $token) {
            if (is_numeric($token)) {
                array_push($stack, (int)$token);
            } else {
                $b = array_pop($stack);
                $a = array_pop($stack);
                switch ($token) {
                    case '+':
                        array_push($stack, $a + $b);
                        break;
                    case '-':
                        array_push($stack, $a - $b);
                        break;
                    case '*':
                        array_push($stack, $a * $b);
                        break;
                }
            }
        }
        return array_pop($stack);
    }
    echo evaluatePostfix((string) $_POST["input"]);
}
// обработать один символ
?>
