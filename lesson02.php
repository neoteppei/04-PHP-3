<?php
$yen = 10000;   // 購入金額
$product = 150; // 商品金額

function calc($yen, $product) {
    // この関数内に処理を記述    
    if ($yen < $product) {
        echo ($product - $yen) . '円足りません。';
        return;
    }
    
    $change = $yen - $product;
    $money = [10000, 5000, 1000, 500, 100, 50, 10, 5, 1];
    
    foreach ($money as $j) {
        $maisu = floor($change / $j);
        $change -= ($j * $maisu);
        $t = ($j >= 1000) ? '札' : '玉';
        echo $j . '円' . $t . '×' . $maisu . '枚、';
    }
    echo "\n"; 
}

calc($yen, $product);
?>
