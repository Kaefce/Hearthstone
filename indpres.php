<?php
include "aiplay.php";
include "turn.php";

function	choose_ennemy() {

    $a = 0;

    echo "\nClass of your opponent : ";
    echo "1: Manuel   2: Random\n\n";
    while ($a != 1) {
        $prompt = readline("> ");
        $prompt = strtolower($prompt);
        if ($prompt == "manuel" || $prompt == 1) {
            choose_manual();
            break;
        } else if ($prompt == "random" || $prompt == 2) {
            choose_random();
            break;
        } else
            echo "Type manuel or random\n";
    }
}

function	print_tab($tab){

    $i = 0;
    $j = 0;
    echo "\n";
    while (isset($tab[$i])) {
        echo $tab[$i]. "  ";
        $i++;
    }
}

function	choose_manual() {
    $tab = ["Mage", "Hunter", "Druid", "Paladin", "Priest", "Rogue", "Shaman", "Warlock", "War"];
    $i = 0;
    $j = 0;
    print_tab($tab);
    echo "\n\nWho's gonna be your opponent ?  ";
    while ($j != 1) {
        $prompt = readline("> ");
        while (isset($tab[$i]) && $prompt != $tab[$i])
        $i++;
        if (isset($tab[$i]) && $prompt == $tab[$i]) {
            echo "Your opponent will be ". $prompt . "\n";
            deck_ennemy($prompt);
            break;
        } else {
            $i = 0;
            echo "\nThis class doesn't exist choose another one ! \n ";
        }
    }
}

function        checkCard2($cards_available, $n, &$count_deck, &$tab) {
    $i = 0;
    while (isset($cards_available[$i]))
        $i++;
    $rand_n = rand(0,$i - 1);
    $tab[$count_deck] = $cards_available[$rand_n];
    $count_deck++;
}

function        choose2($cards_available)
{
    $count_deck = 0;
    $n = 0;
    $coins = 0;
    $tab = NULL;
    $tab_ref = $tab;
    $count_deck_ref = &$count_deck;
    $cmd = fopen("php://stdin", "r");
    while ($count_deck != 10) {
        checkCard2($cards_available, $n, $count_deck_ref, $tab_ref);
        $n++;
    }
    echo "Your opponent chose his cards\n";
    $coins = choose_coins();
    if ($coins == 1)
    first_play($tab_ref);
    else {
        ia_play($tab_ref);
        first_play($tab_ref);
    }
return ($tab_ref);
}

function	deck_ennemy($classe) {
    $n = 2;
    $j = 0;
    $tab_cards = open_to_tab();
    while (isset($tab_cards[$n][1][1])) {
        if ($tab_cards[$n][1][12] == $classe) {
            $cards_available[$j] = $tab_cards[$n][1][1];
            $j++;
        }
        $n++;
    }
    choose2($cards_available);
}

function	choose_random() {
    $i = 0;
    $tab = ["Mage", "Hunter", "Druid", "Paladin", "Priest", "Rogue", "Shaman", "Warlock", "War"];
    while (isset($tab[$i]))
    $i++;
    $rand_n = rand(0,$i - 1);
    echo "\nYour opponent is gonna be: " . $tab[$rand_n]. "\n";
    deck_ennemy($tab[$rand_n]);
}