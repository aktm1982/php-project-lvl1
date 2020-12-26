<?php

namespace Brain\Game\Prime;

use function Brain\Common\Engine\runGame;
use function Brain\Common\Helpers\{showMessage, generateNumber};

use const Brain\Game\Prime\{MIN_VALUE, MAX_VALUE, INSTRUCTIONS};
use const Brain\Common\Settings\MESSAGE;

function initGame(): array
{
    $getAnswerAsWord = function (int $number, callable $callback): string {
        if ($callback($number)) {
            return 'yes';
        }

        return 'no';
    };

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

    $makeQuestion = function () use ($getAnswerAsWord, $isPrime): string {
        $targetNumber = generateNumber(MIN_VALUE, MAX_VALUE);

        showMessage(MESSAGE['question'], (string)$targetNumber);

        return $getAnswerAsWord($targetNumber, $isPrime);
    };

    $gameData['makeQuestion'] = $makeQuestion;
    $gameData['instructions'] = INSTRUCTIONS;

    return $gameData;
}

function play(): void
{
    $gameData = initGame();
    runGame($gameData);
}
