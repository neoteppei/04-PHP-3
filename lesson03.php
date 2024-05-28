<?php

$num1 = 1;  // 分子
$deno1 = 10; // 分母
$num2 = 5;  // 分子
$deno2 = 6; // 分母

function calcFraction($num1, $deno1, $num2, $deno2) {
    // この関数内に処理を記述
    $common_deno = lcm($deno1, $deno2);
    
    // 分母を揃えたときの各分子の値
    $num1_common = ($common_deno / $deno1) * $num1;
    $num2_common = ($common_deno / $deno2) * $num2;
    
    // 分子を足す
    $result_num = $num1_common + $num2_common;
    
    // 結果の分数を簡約化するために最大公約数を求める
    $common_gcd = gcd($result_num, $common_deno);
    
    // 分子と分母を簡約化
    $simplified_num = $result_num / $common_gcd;
    $simplified_deno = $common_deno / $common_gcd;
    
    // 結果を表示
    echo "{$simplified_num} / {$simplified_deno}\n";
}

// 最大公約数
function gcd($m, $n){
  if($n > $m) list($m, $n) = array($n, $m);

  while($n !== 0) {
    $tmp_n = $n;
    $n = $m % $n;
    $m = $tmp_n;
  }
  return $m;
}

// 最小公倍数
function lcm($m, $n){
  return $m * $n / gcd($m, $n);
}
calcFraction($num1, $deno1, $num2, $deno2);
?>
