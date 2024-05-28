<?php

// 手札
$cards = [
    ['suit'=>'heart', 'number'=>1],
    ['suit'=>'heart', 'number'=>10],
    ['suit'=>'heart', 'number'=>11],
    ['suit'=>'heart', 'number'=>12],
    ['suit'=>'heart', 'number'=>13],
];

function judge($cards) {
    // この関数内に処理を記述
    $valid_suits = ['heart', 'spade', 'diamond', 'club'];
    $valid_numbers = range(1, 13);

    // カードの不正チェック
    $suits = [];
    $numbers = [];
    foreach ($cards as $card) {
        // 絵柄が不正な場合は不正
        if (!in_array($card['suit'], $valid_suits)) {
            foreach ($cards as $card) {
                echo $card['suit'] . $card['number'] . ' ';
            }
            echo "\n";
            echo "手札が不正です\n";
            return;
        }

        // 数字が不正な場合は不正
        if (!in_array($card['number'], $valid_numbers)) {
            foreach ($cards as $card) {
                echo $card['suit'] . $card['number'] . ' ';
            }
            echo "\n";
             echo "手札が不正です\n";
            return;
        }

        // 同じ絵柄と数字のカードが複数ある場合は不正
        $card_key = $card['suit'] . $card['number'];
        if (in_array($card_key, $suits)) {
            foreach ($cards as $card) {
                echo $card['suit'] . $card['number'] . ' ';
            }
            echo "\n";
            echo "手札が不正です\n";
            return;
        }
        $suits[] = $card_key;

        $suits[] = $card['suit'];
        $numbers[] = $card['number'];
    }

    
    echo "\n";
    // カードの番号とスートを抽出
    $numbers = array_column($cards, 'number');
    $suits = array_column($cards, 'suit');

    // 手札を表示
    foreach ($cards as $card) {
        echo $card['suit'] . $card['number'] . ' ';
    }
    echo "\n";

    // スートがすべて同じか確認
    $is_flush = (count(array_unique($suits)) === 1);

    // 番号を昇順に並び替え
    sort($numbers);

    // ロイヤルストレートフラッシュの判定
    if ($is_flush && $numbers === [1, 10, 11, 12, 13]) {
        echo "ロイヤルストレートフラッシュ\n";
        return;
    }

    // ストレートの判定
    $is_straight = true;
    for ($i = 1; $i < count($numbers); $i++) {
        if ($numbers[$i] !== $numbers[$i - 1] + 1) {
            $is_straight = false;
            break;
        }
    }

    // ストレートフラッシュの判定
    if ($is_flush && $is_straight) {
        echo "ストレートフラッシュ\n";
        return;
    }

    // フォーカード、フルハウス、スリーカード、ツーペア、ワンペアの判定
    $counts = array_count_values($numbers);
    $pair_count = 0;
    $three_of_a_kind = false;
    $four_of_a_kind = false;

    foreach ($counts as $count) {
        if ($count === 2) {
            $pair_count++;
        } elseif ($count === 3) {
            $three_of_a_kind = true;
        } elseif ($count === 4) {
            $four_of_a_kind = true;
        }
    }

    if ($four_of_a_kind) {
        echo "フォーカード\n";
        return;
    } elseif ($three_of_a_kind && $pair_count === 1) {
        echo "フルハウス\n";
        return;
    } elseif ($is_flush) {
        echo "フラッシュ\n";
        return;
    } elseif ($is_straight) {
        echo "ストレート\n";
        return;
    } elseif ($three_of_a_kind) {
        echo "スリーカード\n";
        return;
    } elseif ($pair_count === 2) {
        echo "ツーペア\n";
        return;
    } elseif ($pair_count === 1) {
        echo "ワンペア\n";
        return;
    } else {
        echo "役はなしです\n";
    }

} 


// 関数「judge」を呼び出して結果を表示する
echo judge($cards);
?>
