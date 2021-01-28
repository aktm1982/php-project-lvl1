<?php

namespace Brain\Games\Even;

use function Brain\Engine\runGame;

function isEven(int $number): bool
{
    return $number % 2 === 0;
}

function getQuestion(int $targetNumber): string
{
    return "$targetNumber";
}

function getCorrectAnswer(int $targetNumber): string
{
    return isEven($targetNumber) ? POS_ANSWER : NEG_ANSWER;
}

function play(): void
{
    $getRoundData = function (): array {
        $targetNumber = mt_rand(MIN_EVEN_GAME_VALUE, MAX_EVEN_GAME_VALUE);

        $roundData = [];
        $roundData['question'] = getQuestion($targetNumber);
        $roundData['correctAnswer'] = getCorrectAnswer($targetNumber);

        return $roundData;
    };

    runGame($getRoundData, INSTRUCTIONS);
}
