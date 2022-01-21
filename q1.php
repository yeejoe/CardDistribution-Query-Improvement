<?php
/*
Tutorial:
To execute this file, just run 'php q1.php'
Total time spent 4:10pm - 4:58pm = 48 minutes
*/

//generate Card deck and return
function generateCards(){
    $cards = [];
    for($i = 1 ; $i <= 13 ; $i++){
        $cardNumToUse = $i;
        if ($i == 10){
            $cardNumToUse = "X";
        }else if ($i == 11){
            $cardNumToUse = "J";
        }else if ($i == 12){
            $cardNumToUse = "Q";
        }else if ($i == 13){
            $cardNumToUse = "K";
        }
        $cards[] = "S-$cardNumToUse";
        $cards[] = "H-$cardNumToUse";
        $cards[] = "D-$cardNumToUse";
        $cards[] = "C-$cardNumToUse";
    }

    return $cards;
}

function distributeCard($numPlayers, $cardDeck){
    if ($numPlayers == null && $cardDeck == null){
        return false;
    }

    $displayStringArray = array_pad([], $numPlayers, []);
    $cardCounter = 0;
    while (count($cardDeck) > 0){
        $card = array_pop($cardDeck);
        $displayStringArray[$cardCounter % $numPlayers][] = $card;
        $cardCounter++;
    }

    return $displayStringArray;
}


function main(){
    //get user input from console, if it is not number or number is less than 0 then will keep ask user to input
    $numPlayers = readline('Enter a number (0 to exit): ');
    if ($numPlayers == 0){
        echo "See you next time!".PHP_EOL;
        exit();
    }

    if (!is_numeric($numPlayers)){
        echo "Input value does not exist or value is invalid".PHP_EOL;
        exit();
    }
    $numPlayers = (int) $numPlayers;
    if (!is_int($numPlayers)){
        echo "Input value does not exist or value is invalid".PHP_EOL;
        exit();
    }

    if ($numPlayers < 0){
        echo "Input value does not exist or value is invalid".PHP_EOL;
        exit();
    }
    
    //generate all the cards of a deck which is 52 cards
    $cardDeck = generateCards();
    //Shuffle it before distribute card
    shuffle($cardDeck);
    //Distribute cards according to player number
    $playersCards = distributeCard($numPlayers, $cardDeck);

    //Arrange players cards to string and separate by comma
    foreach($playersCards as $index => $cards){
        $playersCards[$index] = implode(",", $cards);
    }
    
    //Convert array to printable string with PHP_EOL, which will auto detect what endline symbol to use according to running environment
    $finalDisplayString = implode(PHP_EOL, $playersCards);
    echo $finalDisplayString;
}

main();

?>