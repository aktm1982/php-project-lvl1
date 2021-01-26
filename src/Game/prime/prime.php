<?php

namespace Brain\Game\Prime;

use function Brain\Engine\runGame;

function play(): void
{
    $isPrime = function (int $number): bool {
        if ($number === 1) {
            return false;
        }

        for ($i = 2; $i <= $number / 2; $i++) {
            if ($number % $i === 0) {
                return false;
            }
        }

        return true;
    };
    
    $getRoundData = function () use ($isPrime): array {
        $targetNumber = mt_rand(MIN_VALUE, MAX_VALUE);

        $roundData = [];
        $roundData['roundQuestion'] = "$targetNumber";
        $roundData['roundAnswer'] = $isPrime($targetNumber) ? POS_ANSWER : NEG_ANSWER;
    
        return $roundData;
    };

    runGame($getRoundData, INSTRUCTIONS);
}
