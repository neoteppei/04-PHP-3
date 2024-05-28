<?php

// 手札
$cards = [
    ['suit'=>'heart', 'number'=>10],
    ['suit'=>'heart', 'number'=>11],
    ['suit'=>'heart', 'number'=>12],
    ['suit'=>'joker', 'number'=>0],
    ['suit'=>'heart', 'number'=>13],
];
function judge($cards) {
    $joker = 0; // JOKERの枚数
    foreach ($cards as $k => $card) {
        if ($card['number'] == 1) {
            $cards[$k]['number'] = 14; // 1は14として扱う
        } else if ($card['number'] == 0) {
            // JOKERの場合、配列から削除
            unset($cards[$k]);
            $joker++;
        }
    }
    if ($joker == 5) return "ロイヤルストレートフラッシュ";

    // スートと数字を分離
    $suit = array_column($cards, 'suit');
    $number = array_column($cards, 'number');
    $max = max($number);
    $min = min($number);

    // フラッシュ判定
    $suit_count = array_count_values($suit); // スートの数
    $isFlush = (count($suit_count) == 1);

    // 数字の数
    $number_count = array_count_values($number);

    // ペア数
    $pair = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
    foreach ($number_count as $v) $pair[$v]++;

    // ストレート判定
    sort($number);
    $isStraight = true;
    for ($i = 1; $i < count($number); $i++) {
        if ($number[$i] - $number[$i - 1] != 1) {
            $isStraight = false;
            break;
        }
    }

    // ロイヤルストレートフラッシュのチェック
    $royalNumbers = [10, 11, 12, 13, 14];
    $isRoyalStraight = $isFlush && count(array_intersect($number, $royalNumbers)) == count($number);

    // 強い順に判定
    if ($isRoyalStraight) {
        return "ロイヤルストレートフラッシュ";
    } else if ($isFlush && $isStraight) {
        return "ストレートフラッシュ";
    } else if ($pair[5] == 1 // イカサマ
            || $pair[4] == 1 && $joker == 1
            || $pair[3] == 1 && $joker == 2
            || $pair[2] == 1 && $joker == 3
            || $joker >= 4) {
        return "ファイブカード";
    } else if ($pair[4] == 1
            || $pair[3] == 1 && $joker == 1
            || $pair[2] == 1 && $joker == 2
            || $joker == 3) {
        return "フォーカード";
    } else if ($pair[2] == 1 && $pair[3] == 1
            || $pair[2] == 2 && $joker == 1
            || $pair[3] == 1 && $joker == 2) {
        return "フルハウス";
    } else if ($isFlush) {
        return "フラッシュ";
    } else if ($isStraight) {
        return "ストレート";
    } else if ($pair[3] == 1 || $pair[2] == 1 && $joker == 1 || $joker == 2) {
        return "スリーカード";
    } else if ($pair[2] == 2) {
        return "ツーペア";
    } else if ($pair[2] == 1 || $joker == 1) {
        return "ワンペア";
    } else {
        return "役なし";
    }
}
// 手札を表示
foreach ($cards as $card) {
    echo $card['suit'] . $card['number'] . ' ';
}
echo "\n";
echo judge($cards);

?>