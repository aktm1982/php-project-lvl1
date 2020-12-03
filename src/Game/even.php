<?php

namespace Brain\Game\Even;

use function Brain\Game\{showMessage, getUserInput, generateNumber, getAnswerAsWord};

use const Brain\Game\Settings\MESSAGE;

function initGame()
{
    $getInstructions = function () {
        return MESSAGE['evenInstructions'];
    };

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

    return [
        'getInstructions' => $getInstructions,
        'getResult' => $getResult
    ];
}
