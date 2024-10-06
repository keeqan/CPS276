<?php
class Calculator {
    public function calc($operator, $num1 = null, $num2 = null) {
        // Check If Three Arguments
        if (func_num_args() < 3) {
            return "<p>Cannot perform operation. You must have three arguments. A string for the operator (+,-,*,/) and two integers or floats for the numbers.</p>";
        }

        // Check If Valid
        if (!in_array($operator, ['+', '-', '*', '/'])) {
            return "<p>Invalid operator. Use one of the following: +, -, *, /.</p>";
        }

        // Check If Num Valid
        if (!is_numeric($num1) || !is_numeric($num2)) {
            return "<p>Both arguments must be numbers (integer or float).</p>";
        }

        // Divide by 0
        if ($operator == '/' && $num2 == 0) {
            return "<p>The calculation is $num1 / $num2. The answer is cannot divide a number by zero.</p>";
        }

        // Calculator
        switch ($operator) {
            case '+':
                $result = $num1 + $num2;
                break;
            case '-':
                $result = $num1 - $num2;
                break;
            case '*':
                $result = $num1 * $num2;
                break;
            case '/':
                $result = $num1 / $num2;
                break;
        }

        // Return Result
        return "<p>The calculation is $num1 $operator $num2. The answer is $result.</p>";
    }
}
?>
