<?php

namespace Brain\Game\Even;

use function Brain\Common\Engine\runGame;
use function Brain\Common\Helpers\{showMessage, generateNumber};

use const Brain\Game\Even\{MIN_VALUE, MAX_VALUE, INSTRUCTIONS};
use const Brain\Common\Settings\MESSAGE;

function initGame(): array
{
    $getAnswerAsWord = function (int $number, callable $callback): string {
        if ($callback($number)) {
            return 'yes';
        }

        return 'no';
    };

    $isEven = function (int $number): bool {
        return $number % 2 === 0;
    };

    $makeQuestion = function () use ($isEven, $getAnswerAsWord): string {
        $targetNumber = generateNumber(MIN_VALUE, MAX_VALUE);
        showMessage(MESSAGE['question'], (string)$targetNumber);

        return $getAnswerAsWord($targetNumber, $isEven);
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
