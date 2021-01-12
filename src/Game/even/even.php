<?php

namespace Brain\Game\Even;

use function Brain\Engine\runGame;

function initGame(): array
{
    $getQuestionData = function (): array {
        $questionData = [];
        $questionData['targetNumber'] = mt_rand(MIN_VALUE, MAX_VALUE);

        return $questionData;
    };

    $getQuestionMessageBody = function (array $questionData): string {

        return "{$questionData['targetNumber']}";
    };

    $isEven = function (int $number): bool {

        return $number % 2 === 0;
    };

    $getCorrectAnswer = function (array $questionData) use ($isEven): string {
        if ($isEven($questionData['targetNumber'])) {
            return 'yes';
        }

        return 'no';
    };

    $gameData['getQuestionData'] = $getQuestionData;
    $gameData['getQuestionMessageBody'] = $getQuestionMessageBody;
    $gameData['getCorrectAnswer'] = $getCorrectAnswer;
    $gameData['instructions'] = INSTRUCTIONS;

    return $gameData;
}

function play(): void
{
    $gameData = initGame();
    runGame($gameData);
}
