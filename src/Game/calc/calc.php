<?php

namespace Brain\Game\Calc;

use function Brain\Engine\runGame;

function play(): void
{
    $getQuestionSrcData = function (): array {
        $questionSrcData = [];
        $questionSrcData['operand1'] = mt_rand(MIN_OPERAND_VALUE, MAX_OPERAND_VALUE);
        $questionSrcData['operand2'] = mt_rand(MIN_OPERAND_VALUE, MAX_OPERAND_VALUE);
        $questionSrcData['operator'] = OPERATORS[array_rand(OPERATORS)];

        return $questionSrcData;
    };

    $getQuestionString = function (array $data): string {
        ['operand1' => $operand1, 'operand2' => $operand2, 'operator' => $operator] = $data;
        return "$operand1 $operator $operand2";
    };

    $getCorrectAnswer = function (array $data) use ($getQuestionString): string {
        $questionString = str_replace(' ', '', $getQuestionString($data));
        $result = eval("return $questionString;");

        return (string)$result;
    };

    $getQuestionObject = function () use ($getQuestionSrcData, $getQuestionString, $getCorrectAnswer): array {
        $questionSrcData = $getQuestionSrcData();

        $questionObject = [];
        $questionObject['questionString'] = $getQuestionString($questionSrcData);
        $questionObject['correctAnswer'] = $getCorrectAnswer($questionSrcData);

        return $questionObject;
    };

    $initGameData = function () use ($getQuestionObject): array {
        $gameData = [];
        $gameData['getQuestionObject'] = $getQuestionObject;
        $gameData['instructions'] = INSTRUCTIONS;

        return $gameData;
    };

    runGame($initGameData);
}
