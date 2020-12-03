<?php

namespace Brain\Game\Calc;

use function Brain\Game\{showMessage, getUserInput, generateNumber};
use function Brain\Game\generateItemFromList as generateOperator;

use const Brain\Game\Settings\{OPERATORS, MESSAGE};

function getCorrectAnswer(int $operand1, int $operand2, string $operator): int
{
    switch ($operator) {
        case '+':
            return $operand1 + $operand2;
        case '-':
            return $operand1 - $operand2;
    }
}

function initGame()
{
    $getInstructions = function () {
        return MESSAGE['calcInstructions'];
    };

    $getResult = function () {
        $operand1 = generateNumber();
        $operand2 = generateNumber();
        $operator = generateOperator(OPERATORS);

        showMessage(MESSAGE['question'], "$operand1 $operator $operand2");

        $result = [];
        $result['userInput'] = getUserInput(MESSAGE['prompt']);
        $result['correctAnswer'] = getCorrectAnswer($operand1, $operand2, $operator);
        $result['isCorrect'] = $result['userInput'] == $result['correctAnswer'];

        return $result;
    };

    return [
        'getInstructions' => $getInstructions,
        'getResult' => $getResult
    ];
}
