<?php

namespace Brain\Game\Prime;

use function Brain\Common\Engine\runGame;
use function Brain\Common\Helpers\{showMessage, getUserInput, generateNumber};

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

        for ($i = 2; $i < $number / 2; $i++) {
            if ($number % $i === 0) {
                return false;
            }
        }

        return true;
    };

    $getRoundResult = function () use ($getAnswerAsWord, $isPrime): array {
        $result = [];
        $targetNumber = generateNumber(MIN_VALUE, MAX_VALUE);

        showMessage(MESSAGE['question'], $targetNumber);

        $result['correctAnswer'] = $getAnswerAsWord($targetNumber, $isPrime);
        $result['userInput'] = getUserInput(MESSAGE['prompt']);
        $result['isCorrect'] = $result['userInput'] == (string)$result['correctAnswer'];

        return $result;
    };

    $GameData['instructions'] = INSTRUCTIONS;
    $GameData['getRoundResult'] = $getRoundResult;

    return $GameData;
}

function play(): void
{
    $GameData = initGame();
    runGame($GameData);
}