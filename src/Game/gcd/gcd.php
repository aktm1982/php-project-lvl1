<?php

namespace Brain\Game\Gcd;

use function Brain\Engine\runGame;

function play(): void
{
    $getQuestionSrcData = function (): array {
        $questionSrcData = [];
        $questionSrcData['number1'] = mt_rand(MIN_DIVIDED_VALUE, MAX_DIVIDED_VALUE);
        $questionSrcData['number2'] = mt_rand(MIN_DIVIDED_VALUE, MAX_DIVIDED_VALUE);

        return $questionSrcData;
    };

    $getQuestionString = function (array $questionSrcData): string {
        ['number1' => $number1, 'number2' => $number2] = $questionSrcData;
        return "$number1 $number2";
    };

    $getDivs = function (int $num): array {
        $divs = [];
        for ($i = 1; $i <= $num; $i++) {
            if ($num % $i === 0) {
                $divs[] = $i;
            }
        }

        return $divs;
    };

    $getCorrectAnswer = function (array $questionSrcData) use ($getDivs): string {

        $divs1 = $getDivs($questionSrcData['number1']);
        $divs2 = $getDivs($questionSrcData['number2']);

        $maxDiv = max(array_intersect($divs1, $divs2));

        return (string)$maxDiv;
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
