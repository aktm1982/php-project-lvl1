<?php

namespace Brain\Game\Calc;

use function Brain\Engine\runGame;

function play(): void
{
    $calcs = [
        '+' => (fn($x, $y) => $x + $y),
        '-' => (fn($x, $y) => $x - $y),
        '*' => (fn($x, $y) => $x * $y)
    ];

    $getQuestionSrcData = function () use ($calcs): array {
        $operand1 = mt_rand(MIN_OPERAND_VALUE, MAX_OPERAND_VALUE);
        $operand2 = mt_rand(MIN_OPERAND_VALUE, MAX_OPERAND_VALUE);
        $operatorSign = array_rand($calcs);

        $questionSrcData = [];
        $questionSrcData['questionString'] = "$operand1 $operatorSign $operand2";
        $questionSrcData['result'] = $calcs[$operatorSign]($operand1, $operand2);

        return $questionSrcData;
    };

    $getQuestionString = function (array $data): string {

        return $data['questionString'];
    };

    $getCorrectAnswer = function (array $data): string {

        return (string)$data['result'];
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
