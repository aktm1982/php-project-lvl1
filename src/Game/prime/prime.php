<?php

namespace Brain\Game\Prime;

use function Brain\Game\Engine\runGame;
use function Brain\Game\Common\{showMessage, getUserInput, generateNumber};

use const Brain\Game\Prime\Settings\INSTRUCTIONS;
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
    
    $isPrime = function (int $number): bool {
        for ($i = 2; $i < $number / 2; $i++) {
            if ($number % $i === 0) {
                return false;
            }
        }

        return true;
    };

    $getResult = function () use ($isPrime) {
        $result = [];
        $targetNumber = generateNumber();

        showMessage(MESSAGE['question'], $targetNumber);

        $result['correctAnswer'] = getAnswerAsWord($targetNumber, $isPrime);
        $result['userInput'] = getUserInput(MESSAGE['prompt']);
        $result['isCorrect'] = $result['userInput'] == (string)$result['correctAnswer'];

        return $result;
    };
    
    $GameData['instructions'] = INSTRUCTIONS;
    $GameData['getResult'] = $getResult;
    
    return $GameData;
}

function play()
{
    $GameData = initGame();
    runGame($GameData);
}
