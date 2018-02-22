<?php
function	random_coins() {
    $coins = rand(1, 2);
    return ($coins);
}

function	choose_coins() {
    $n = 0;
    $user_c = 0;
    $coins = 0;
    $cmd = fopen("php://stdin", "r");
    echo "Choose : Heads or Tails\n";
    while ($n != 1)
    {
        $read = readline("> ");
        $read = strtolower($read);
        if ($read == "Heads")
            $user_c = 0;
        else if ($read == "Tails")
            $user_c = 1;
        else
            echo "Please type Heads or Tails.\n";
        $coins = random_coins();
        if ($user_c == $coins)
            return(1);
        else
            return(0);
    }
}

function	first_play($tab) {
    $n = 0;
    $rand = 0;
    $i = 0;
    echo "It's your turn\n";
    while (isset($tab[$n]))
        $n++;
    while ($i < 3)
    {
        $rand= rand(1, $n - 1);
        $hand_cards[$i] = $tab[$rand];
        echo $hand_cards[$i] . "      ";
        $i++;
    }
    drop_cards($tab);
    return ($hand_cards);
}

function	drop_cards($tab) {
    $n = 0;
    $cmd = fopen("php://stdin", "r");
    echo "\nDo you want to keep your cards ?\n";
    echo "1.Yes      2.No\n";
    while ($n != 1)
    {
        $read = readline("> ");
        $read = strtolower($read);
        if ($read == "Yes" || $read == "1")
            return (0);
        else if ($read == "No" || $read == "2")
        {
            second_play($tab);
            $n = 1;
        }
        else
            echo "Please type Yes or No.\n";
    }
}

function        second_play($tab) {
    $n = 0;
    $rand = 0;
    $i = 0;
    echo "It's your turn !\n";
    while (isset($tab[$n]))
        $n++;
    while ($i < 3)
    {
        $rand = rand(1, $n - 1);
        $hand_cards[$i] = $tab[$rand];
        echo $hand_cards[$i] . "    ";
        $i++;
    }
    return ($hand_cards);
}