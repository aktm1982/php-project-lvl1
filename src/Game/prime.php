<?php

namespace Brain\Game\Prime;

use Brain\Game;

use const Brain\Game\Settings\MESSAGE;

use function Brain\Game\{showMessage, getUserInput, generateNumber, getAnswerAsWord};

function initGame()
{
    $getInstructions = function() {
        return MESSAGE['primeInstructions'];
    };

    $isPrime = function(int $number): bool {
        for($i = 2; $i < $number / 2; $i++) {
            if($number % $i === 0) {
                return false;
            }
        }

        return true;
    };

    $getResult = function() use ($isPrime) {
        $result = [];
        $targetNumber = generateNumber();

        showMessage(MESSAGE['question'], $targetNumber);

        $result['correctAnswer'] = getAnswerAsWord($targetNumber, $isPrime);
        $result['userInput'] = getUserInput(MESSAGE['prompt']);        
        $result['isCorrect'] = $result['userInput'] == (string)$result['correctAnswer'];

        return $result;
    };

    return [
        'getInstructions' => $getInstructions,
        'getResult' => $getResult
    ];
}
