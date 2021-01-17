<?php

namespace Brain\Game\Calc;

use function Brain\Engine\runGame;

function play(): void
{
    $getQuestionData = function (): array {
        $questionData = [];
        $questionData['operand1'] = mt_rand(MIN_OPERAND_VALUE, MAX_OPERAND_VALUE);
        $questionData['operand2'] = mt_rand(MIN_OPERAND_VALUE, MAX_OPERAND_VALUE);
        $questionData['operator'] = OPERATORS[array_rand(OPERATORS)];

        return $questionData;
    };

    $getQuestionMessageBody = function (array $data): string {
        ['operand1' => $operand1, 'operand2' => $operand2, 'operator' => $operator] = $data;
        return "$operand1 $operator $operand2";
    };

    $getCorrectAnswer = function (array $data): string {
        $result = 0;

        switch ($data['operator']) {
            case '+':
                $result = $data['operand1'] + $data['operand2'];
                break;
            case '-':
                $result = $data['operand1'] - $data['operand2'];
                break;
        }

        return (string)$result;
    };

    $initGameData = function () use ($getQuestionData, $getQuestionMessageBody, $getCorrectAnswer): array {
        $questionData = $getQuestionData();

        $gameData = [];
        $gameData['questionMessageBody'] = $getQuestionMessageBody($questionData);
        $gameData['correctAnswer'] = $getCorrectAnswer($questionData);
        $gameData['instructions'] = INSTRUCTIONS;

        return $gameData;
    };

    runGame($initGameData);
}
