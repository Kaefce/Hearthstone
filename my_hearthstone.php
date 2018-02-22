<?php
include "indpres.php";

echo "\n";
echo "\033[01;31m It is said that wars are only one upon the anvil of honor. \033[0m \n";
echo "\n";
sleep(3);
echo "\e[01;31m Others believe victory requires strategy and the mastery of power.\e[0m\n";
echo "\n";
sleep(3);
echo "\e[01;31m War is deception ...\e[0m\n";
echo "\n";
sleep(1);
echo "\e[01;31m A game played best from the shadows.\e[0m\n";
echo "\n";
sleep(2);
echo "\e[01;31m Only strength and raw power can assure total dominance. \e[0m \n";
echo "\n";
sleep(3);
echo "\e[01;31m But of course u could forget all that and just have fun !\e[0m\n";
echo "\n";
sleep(3);
echo " ----------------------------------------------------------------------\n";
echo "|                                                                      |\n";
echo "| #   # #####  ###  ##### ##### #   #  ##### ##### ##### ##   # #####  |\n";
echo "| #   # #     #   # #   #   #   #   #  #       #   #   # # #  # #      |\n";
echo "| ##### ####  ##### #####   #   #####  #####   #   #   # #  # # ####   |\n";
echo "| #   # #     #   # # #     #   #   #      #   #   #   # #   ## #      |\n";
echo "| #   # ##### #   # #  #    #   #   #  #####   #   ##### #    # #####  |\n";
echo "|                                                                      |\n";
echo "|                                                                      |\n";
echo "|            ---- With my_Hearthstone Heroes of ETNA ----!             |\n";
echo "|                                                                      |\n";
echo "-----------------------------------------------------------------------\n";
sleep(1);

function    start($argc, $argv) {
    $tab = ["Mage", "Hunter", "Druid", "Paladin", "Priest", "Rogue", "Shaman", "Warlock", "War"];
    $n = 0;

    if ($argc == 0)
        echo "Choose a class and username at the same time\n";
    else {
        while (isset($tab[$n])) {
            if ($tab[$n] == $argv[2]) {
                echo "                                     \n";
                echo "  Greetings Wanderer " . $argv[1] . "\n";
                echo "                                     \n";
                echo " Interesting class choice, playing a " . $argv[2] . " won't be easy\n";
                echo "\n";
                return ($argv[2]);
            }
            $n++;
        }
        echo "The class you chose doesn't exist or is probably useless";
    }
    return (NULL);
}

function	checkCard($read, $cards_available, $n, &$count_deck, &$tab) {
    $i = 0;
    $match = 0;
    while (isset($cards_available[$i]))
    {
        if ($read[$n] == $cards_available[$i])
        {
            echo "You added " . $read[$n] . "\n";
            $tab[$count_deck] = $read[$n];
            $count_deck++;
            $match = 1;
        }
        $i++;
    }
    if ($match == 0)
        echo "This card doesn't exist or is for another class\n";
    echo "Deck : " . $count_deck . "\n";
}

function	choose($cards_available) {
    $count_deck = 0;
    $n = 0;
    $tab = NULL;
    $tab_ref = $tab;
    $count_deck_ref = &$count_deck;
    $cmd = fopen("php://stdin", "r");
    while ($count_deck != 10)
    {
        $read[$n] = readline("> ");
        checkCard($read, $cards_available, $n, $count_deck_ref, $tab_ref);
        $n++;
    }
    choose_ennemy();
    return ($tab_ref);
}

function	open_to_tab() {
    $i = 2;
    $cards_files = scandir("cards");
    while (isset($cards_files[$i]))
    {
        $cards[$i] = fopen("cards/" . $cards_files[$i], 'r+');
        $contenu[$i] = fread($cards[$i], 800000);
        preg_match_all("/\"([\w\s._]*)\"/", $contenu[$i], $tab_cards[$i]);
        $i++;
    }
    return($tab_cards);
}

function	open($argv) {
    $n = 2;
    $j = 0;
    $tab_cards = open_to_tab();
    echo "Choose a card between the ones that are displayed :\n";
    while (isset($tab_cards[$n][1][1]))
    {
        if ($tab_cards[$n][1][12] == $argv)
        {
            echo $tab_cards[$n][1][1] . "\n";
            echo "--------------------------\n";
            $cards_available[$j] = $tab_cards[$n][1][1];
            $j++;
        }
        $n++;
    }
    choose($cards_available);
}
$erreur = start($argc, $argv);
if ($erreur != NULL)
    open($argv[2]);
