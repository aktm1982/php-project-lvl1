<?php

namespace Brain\Game\Calc;

use function Brain\Common\Engine\runGame;
use function Brain\Common\Helpers\{showMessage, generateNumber};

use const Brain\Game\Calc\{MIN_VALUE, MAX_VALUE, OPERATORS, INSTRUCTIONS};
use const Brain\Common\Settings\MESSAGE;

function initGame(): array
{
    $generateOperatorFromList = function (array $operatorsList): string {
        $index = mt_rand(0, count($operatorsList) - 1);
        return $operatorsList[$index];
    };

    $getCorrectAnswer = function (int $operand1, int $operand2, string $operator): int {
        $result = 0;

        switch ($operator) {
            case '+':
                $result = $operand1 + $operand2;
                break;
            case '-':
                $result = $operand1 - $operand2;
                break;
        }

        return $result;
    };

    $makeQuestion = function () use ($generateOperatorFromList, $getCorrectAnswer): int {
        $operand1 = generateNumber(MIN_VALUE, MAX_VALUE);
        $operand2 = generateNumber(MIN_VALUE, MAX_VALUE);
        $operator = $generateOperatorFromList(OPERATORS);

        showMessage(MESSAGE['question'], "$operand1 $operator $operand2");

        return $getCorrectAnswer($operand1, $operand2, $operator);
    };

    $gameData['makeQuestion'] = $makeQuestion;
    $gameData['instructions'] = INSTRUCTIONS;

    return $gameData;
}

function play(): void
{
    $gameData = initGame();
    runGame($gameData);
}
