<?php

namespace Brain\Game\Gcd;

use function Brain\Engine\runGame;

function initGame(): array
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

    $getCorrectAnswer = function (array $questionData) use ($getDivs): int {

        $divs1 = $getDivs($questionData['number1']);
        $divs2 = $getDivs($questionData['number2']);

        return max(array_intersect($divs1, $divs2));
    };

    $gameData = [];
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
