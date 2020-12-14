<?php

namespace Brain\Game\Gcd;

use function Brain\Game\Engine\runGame;
use function Brain\Game\Common\{showMessage, getUserInput, generateNumber};

use const Brain\Game\Gcd\Settings\{SIMPLE_NUMS, INSTRUCTIONS};
use const Brain\Game\Settings\MESSAGE;

function initGame()
{ 
    function generateNumberFromList($numbersList)
    {
        $index = mt_rand(0, count($numbersList) - 1);
        return $numbersList[$index];
    }

    $getResult = function () {
        $result = [];
        $result['correctAnswer'] = generateNumberFromList(SIMPLE_NUMS);

        $correctIndex = array_search($result['correctAnswer'], SIMPLE_NUMS);
        $restOfList = array_slice(SIMPLE_NUMS, $correctIndex);
        $shownNumber1 = $result['correctAnswer'] * generateNumberFromList($restOfList);
        $shownNumber2 = $result['correctAnswer'] * generateNumberFromList($restOfList);

        showMessage(MESSAGE['question'], "$shownNumber1 $shownNumber2");

        $result['userInput'] = getUserInput(MESSAGE['prompt']);
        $result['isCorrect'] = $result['userInput'] == (string)$result['correctAnswer'];

        return $result;
    };
    
    $GameData['getResult'] = $getResult;
    $GameData['instructions'] = INSTRUCTIONS;
    
    return $GameData;
}

function play()
{
    $GameData = initGame();
    runGame($GameData);
}
