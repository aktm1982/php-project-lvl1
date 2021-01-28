<?php

namespace Brain\Games\Prime;

use function Brain\Engine\runGame;

function isPrime(int $number): bool
{
    if ($number === 1) {
        return false;
    }

    for ($i = 2; $i <= $number / 2; $i++) {
        if ($number % $i === 0) {
            return false;
        }
    }

    return true;
}

function getQuestion(int $targetNumber): string
{
    return "$targetNumber";
}

function getCorrectAnswer(int $targetNumber): string
{
    return isPrime($targetNumber) ? POS_ANSWER : NEG_ANSWER;
}

function play(): void
{
    $getRoundData = function (): array {
        $targetNumber = mt_rand(MIN_PRIME_GAME_VALUE, MAX_PRIME_GAME_VALUE);

        $roundData = [];
        $roundData['question'] = getQuestion($targetNumber);
        $roundData['correctAnswer'] = getCorrectAnswer($targetNumber);

        return $roundData;
    };

    runGame($getRoundData, INSTRUCTIONS);
}
