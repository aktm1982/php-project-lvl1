<?php

namespace Brain\Games\Gcd;

use function Brain\Engine\runGame;

function getDivs(int $num): array
{
    $divs = [];
    for ($i = 1; $i <= $num; $i++) {
        if ($num % $i === 0) {
            $divs[] = $i;
        }
    }

    return $divs;
}

function getGcd(int $number1, int $number2): string
{
    $divs1 = getDivs($number1);
    $divs2 = getDivs($number2);

    return (string)max(array_intersect($divs1, $divs2));
}

function play(): void
{
    $getRoundData = function (): array {
        $number1 = mt_rand(MIN_DIVIDED_VALUE, MAX_DIVIDED_VALUE);
        $number2 = mt_rand(MIN_DIVIDED_VALUE, MAX_DIVIDED_VALUE);

        $roundData = [];
        $roundData['question'] = "$number1 $number2";
        $roundData['correctAnswer'] = getGcd($number1, $number2);

        return $roundData;
    };

    runGame($getRoundData, INSTRUCTIONS);
}
