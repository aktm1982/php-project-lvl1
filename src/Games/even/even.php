<?php

namespace Brain\Games\Even;

use function Brain\Engine\runGame;

function isEven(int $number): bool
{
    return $number % 2 === 0;
}

function play(): void
{
    $getRoundData = function (): array {
        $targetNumber = mt_rand(MIN_EVEN_GAME_VALUE, MAX_EVEN_GAME_VALUE);

        $roundData = [];
        $roundData['question'] = "$targetNumber";
        $roundData['correctAnswer'] = isEven($targetNumber) ? POS_ANSWER : NEG_ANSWER;

        return $roundData;
    };

    runGame($getRoundData, INSTRUCTIONS);
}