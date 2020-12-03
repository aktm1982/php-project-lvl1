<?php

namespace Brain\Game\Gcd;

use const Brain\Game\Settings\{MESSAGE, SIMPLE_NUMS};
use function Brain\Game\{showMessage, getUserInput, generateItemFromList};

function initGame()
{
    $getInstructions = function()
    {
        return MESSAGE['gcdInstructions'];
    };
    
    $getResult = function()
    {
        $result = [];
        $result['correctAnswer'] = generateItemFromList(SIMPLE_NUMS);
        
        $correctIndex = array_search($result['correctAnswer'], SIMPLE_NUMS);
        $restOfList = array_slice(SIMPLE_NUMS, $correctIndex);
        $shownNumber1 = $result['correctAnswer'] * generateItemFromList($restOfList); 
        $shownNumber2 = $result['correctAnswer'] * generateItemFromList($restOfList);
        
        showMessage(MESSAGE['question'], "$shownNumber1 $shownNumber2");
       
        $result['userInput'] = getUserInput(MESSAGE['prompt']);        
        $result['isCorrect'] = $result['userInput'] == (string)$result['correctAnswer'];
        
        return $result;
    };

    return [
        'getInstructions' => $getInstructions,
        'getResult' => $getResult
    ];
}
