<?php
class Calculator {
    public function calc($operator, $num1 = null, $num2 = null) {
        // Check if all three arguments are provided
        if (func_num_args() < 3) {
            return "<p>Cannot perform operation. You must have three arguments. A string for the operator (+,-,*,/) and two integers or floats for the numbers.</p>";
        }

        // Check if the operator is valid
        if (!in_array($operator, ['+', '-', '*', '/'])) {
            return "<p>Invalid operator. Use one of the following: +, -, *, /.</p>";
        }

        // Check if the numbers are valid
        if (!is_numeric($num1) || !is_numeric($num2)) {
            return "<p>Both arguments must be numbers (integer or float).</p>";
        }

        // Handle division by zero
        if ($operator == '/' && $num2 == 0) {
            return "<p>The calculation is $num1 / $num2. The answer is cannot divide a number by zero.</p>";
        }

        // Perform the calculation
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

        // Return the result wrapped in a paragraph element
        return "<p>The calculation is $num1 $operator $num2. The answer is $result.</p>";
    }
}
?>
