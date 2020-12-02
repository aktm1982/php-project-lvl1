<?php

namespace Brain\Game\Gcd;

use function cli\line;
use function cli\prompt;
use function Brain\Game\getUserInput;

function initGameData()
{
    $getInstructions = function()
    {
        return 'Find the greates common divisor of given numbers';
    };
    
    $getResult = function()
    {
        $simpleNums = [2,3,5,7,11];
        $simpleNumsMaxIndex = count($simpleNums) - 1;
        
        $result = [];
        
        $indexOfCorrectAnswer = mt_rand(0, $simpleNumsMaxIndex);
        $result['correctAnswer'] = $simpleNums[$indexOfCorrectAnswer];
        
        $indexOfMultiplyer1 = rand($indexOfCorrectAnswer, $simpleNumsMaxIndex);
        $shownNumber1 = $result['correctAnswer'] * $simpleNums[$indexOfMultiplyer1];
        
        $indexOfMultiplyer2 = mt_rand($indexOfCorrectAnswer, $simpleNumsMaxIndex);
        $shownNumber2 = $result['correctAnswer'] * $simpleNums[$indexOfMultiplyer2];
        
        line("Question: $shownNumber1 $shownNumber2");
       
        $result['userInput'] = getUserInput();        
        $result['isCorrect'] = $result['userInput'] == (string)$result['correctAnswer'];
        
        return $result;
    };

    return [
        'getInstructions' => $getInstructions,
        'getResult' => $getResult
    ];
}
