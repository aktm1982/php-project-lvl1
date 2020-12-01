<?php

namespace Brain\Game\Even;

use function cli\line;
use function cli\prompt;
use function Brain\Game\generateNumber;
use function Brain\Game\getUserInput;

function getCorrectAnswer(int $targetNumber): string
{
    if ($targetNumber % 2 === 0) {
        return 'yes';
    } else {
        return 'no';
    }
}

function initGameData()
{
    $getInstructions = function()
    {
        return 'Answer "yes" if the number is even, otherwise answer "no".';
    };
    
    $getResult = function()
    {
        $result = [];
        $targetNumber = generateNumber();
        line("Question: $targetNumber");
       
        $result['userInput'] = getUserInput();        
        $result['correctAnswer'] = getCorrectAnswer($targetNumber);
        $result['isCorrect'] = strtolower($result['userInput']) === $result['correctAnswer'];
        
        return $result;
    };

    return [
        'getInstructions' => $getInstructions,
        'getResult' => $getResult
    ];
}
