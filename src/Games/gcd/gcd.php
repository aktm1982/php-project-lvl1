<?php

namespace Brain\Games\Gcd;

use function Brain\Engine\runGame;

function getQuestion(int $number1, int $number2): string
{
    return "$number1 $number2";
}

function getCorrectAnswer(int $number1, int $number2): string
{
    $gcd = 1;
    for($i = 1; $i < ($number1 / 2); $i++) {
        if(($number1 % $i === 0) && ($number2 % $i === 0)) {
            $gcd = $i;
        }
    }

    return (string)$gcd;
}

function play(): void
{
    $getRoundData = function (): array {
        $number1 = mt_rand(MIN_DIVIDED_VALUE, MAX_DIVIDED_VALUE);
        $number2 = mt_rand(MIN_DIVIDED_VALUE, MAX_DIVIDED_VALUE);

        $roundData = [];
        $roundData['question'] = getQuestion($number1, $number2);
        $roundData['correctAnswer'] = getCorrectAnswer($number1, $number2);

        return $roundData;
    };

    runGame($getRoundData, INSTRUCTIONS);
}
