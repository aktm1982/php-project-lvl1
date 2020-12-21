<?php

namespace Brain\Game\Even;

use function Brain\Common\Engine\runGame;
use function Brain\Common\Helpers\{showMessage, getUserInput, generateNumber};

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

    $getRoundResult = function () use ($isEven, $getAnswerAsWord) {
        $targetNumber = generateNumber(MIN_VALUE, MAX_VALUE);
        showMessage(MESSAGE['question'], $targetNumber);

        $result = [];
        $result['userInput'] = getUserInput(MESSAGE['prompt']);
        $result['correctAnswer'] = $getAnswerAsWord($targetNumber, $isEven);
        $result['isCorrect'] = $result['userInput'] === $result['correctAnswer'];

        return $result;
    };

    $GameData['getRoundResult'] = $getRoundResult;
    $GameData['instructions'] = INSTRUCTIONS;

    return $GameData;
}

function play(): void
{
    $GameData = initGame();
    runGame($GameData);
}
