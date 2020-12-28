<?php

namespace Brain\Game\Calc;

use function Brain\Common\Engine\runGame;

use const Brain\Common\Settings\MESSAGE;

function initGame(): array
{
    $getQuestionData = function (): array {
        $questionData = [];
        $questionData['operand1'] = mt_rand(MIN_OPERAND_VALUE, MAX_OPERAND_VALUE);
        $questionData['operand2'] = mt_rand(MIN_OPERAND_VALUE, MAX_OPERAND_VALUE);
        $questionData['operator'] = OPERATORS[array_rand(OPERATORS)];

        return $questionData;
    };

    $getQuestionMessageBody = function (array $questionData): string {
        ['operand1' => $operand1, 'operand2' => $operand2, 'operator' => $operator] = $questionData;
        return "$operand1 $operator $operand2";
    };

    $getCorrectAnswer = function (array $questionData) use ($getQuestionMessageBody): int {
        $result = 0;

        switch ($questionData['operator']) {
            case '+':
                $result = $questionData['operand1'] + $questionData['operand2'];
                break;
            case '-':
                $result = $questionData['operand1'] - $questionData['operand2'];
                break;
        }

        return $result;
    };

    $gameData['getQuestionData'] = $getQuestionData;
    $gameData['getQuestionMessageBody'] = $getQuestionMessageBody;
    $gameData['getCorrectAnswer'] = $getCorrectAnswer;
    $gameData['instructions'] = INSTRUCTIONS;

    return $gameData;
}

function play(): void
{
    $gameData = initGame();
    runGame($gameData);
}
