<?php

namespace Brain\Game\Calc;

use function Brain\Common\Engine\runGame;
use function Brain\Common\Helpers\{showMessage, getUserInput, generateNumber};

use const Brain\Game\Calc\{MIN_VALUE, MAX_VALUE, OPERATORS, INSTRUCTIONS};
use const Brain\Common\Settings\MESSAGE;

function initGame(): array
{
    function generateOperatorFromList($operatorsList)
    {
        $index = mt_rand(0, count($operatorsList) - 1);
        return $operatorsList[$index];
    }

    function getCorrectAnswer(int $operand1, int $operand2, string $operator): int
    {
        switch ($operator) {
            case '+':
                return $operand1 + $operand2;
            case '-':
                return $operand1 - $operand2;
        }
    }

    $getRoundResult = function () {
        $operand1 = generateNumber(MIN_VALUE, MAX_VALUE);
        $operand2 = generateNumber(MIN_VALUE, MAX_VALUE);
        $operator = generateOperatorFromList(OPERATORS);

        showMessage(MESSAGE['question'], "$operand1 $operator $operand2");

        $result = [];
        $result['userInput'] = getUserInput(MESSAGE['prompt']);
        $result['correctAnswer'] = getCorrectAnswer($operand1, $operand2, $operator);
        $result['isCorrect'] = $result['userInput'] == $result['correctAnswer'];

        return $result;
    };

    $GameData['getRoundResult'] = $getRoundResult;
    $GameData['instructions'] = INSTRUCTIONS;

    return $GameData;
}

function play()
{
    $GameData = initGame();
    runGame($GameData);
}
