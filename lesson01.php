<?php

function fizzbuzz($i) {
    // この関数内に処理を記述
    if ($i % 3 == 0 && $i % 5 == 0) {
        return "$i FizzBuzz";
    } elseif ($i % 3 == 0) {
        return "$i Fizz";
    } elseif ($i % 5 == 0) {
        return "$i Buzz";
    } else {
        return $i;
    }
}

for ($i = 1; $i <= 100; $i++) {
    echo fizzbuzz($i) . "\n";
}
?>
