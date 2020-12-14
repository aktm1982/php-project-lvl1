<?php

namespace Brain\Game\Even;

use function Brain\Game\Engine\runGame;
use function Brain\Game\Common\{showMessage, getUserInput, generateNumber};

use const Brain\Game\Even\Settings\INSTRUCTIONS;
use const Brain\Game\Settings\MESSAGE;

function initGame()
{ 
    function getAnswerAsWord(int $number, callable $callback)
    {
        if ($callback($number)) {
            return 'yes';
        }

        return 'no';
    }

    $isEven = function (int $number): bool {
        return $number % 2 === 0;
    };
    
    $getResult = function () use ($isEven) {
        $targetNumber = generateNumber();
        showMessage(MESSAGE['question'], $targetNumber);

        $result = [];
        $result['userInput'] = getUserInput(MESSAGE['prompt']);
        $result['correctAnswer'] = getAnswerAsWord($targetNumber, $isEven);
        $result['isCorrect'] = $result['userInput'] === $result['correctAnswer'];

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
