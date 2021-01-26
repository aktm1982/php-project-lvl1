<?php

namespace Brain\Game\Even;

use function Brain\Engine\runGame;

function play(): void
{
    
    $isEven = function (int $number): bool {

        return $number % 2 === 0;
    };
    
    $getRoundData = function () use ($isEven): array {
        $targetNumber = mt_rand(MIN_VALUE, MAX_VALUE);

        $roundData = [];
        $roundData['roundQuestion'] = "$targetNumber";
        $roundData['roundAnswer'] = $isEven($targetNumber) ? POS_ANSWER : NEG_ANSWER;
    
        return $roundData;
    };

    runGame($getRoundData, INSTRUCTIONS);
}
