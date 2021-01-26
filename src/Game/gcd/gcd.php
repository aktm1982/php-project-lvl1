<?php

namespace Brain\Game\Gcd;

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

function play(): void
{
    $getRoundData = function () use ($getDivs): array {
        $number1 = mt_rand(MIN_DIVIDED_VALUE, MAX_DIVIDED_VALUE);
        $number2 = mt_rand(MIN_DIVIDED_VALUE, MAX_DIVIDED_VALUE);
        $divs1 = getDivs($number1);
        $divs2 = getDivs($number2);

        $roundData = [];
        $roundData['roundQuestion'] = "$number1 $number2";
        $roundData['roundAnswer'] = (string)max(array_intersect($divs1, $divs2));

        return $roundData;
    };

    runGame($getRoundData, INSTRUCTIONS);
}
