<?php
function	ia_play($tab) {
    $n = 0;
    $i = 0;
    echo "\n Your opponent plays first\n";
    while (isset($tab[$n - 1]))
        $n++;
    while ($i < 3)
    {
        $rand= rand(1, $n);
        $ia_cards[$i] = $tab[$n];
        $i++;
    }
    return ($ia_cards);
}