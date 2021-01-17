<?php

namespace Brain\Game\Gcd;

use function Brain\Engine\runGame;

function play(): void
{
    $getQuestionData = function (): array {
        $questionData = [];
        $questionData['number1'] = mt_rand(MIN_DIVIDED_VALUE, MAX_DIVIDED_VALUE);
        $questionData['number2'] = mt_rand(MIN_DIVIDED_VALUE, MAX_DIVIDED_VALUE);

        return $questionData;
    };

    $getQuestionMessageBody = function (array $questionData): string {
        ['number1' => $number1, 'number2' => $number2] = $questionData;
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

    $getCorrectAnswer = function (array $questionData) use ($getDivs): string {

        $divs1 = $getDivs($questionData['number1']);
        $divs2 = $getDivs($questionData['number2']);

        $maxDiv = max(array_intersect($divs1, $divs2));

        return (string)$maxDiv;
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
