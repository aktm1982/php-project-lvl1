<?php

namespace Brain\Game\Prime;

use function Brain\Engine\runGame;

function play(): void
{
    $getQuestionData = function (): array {
        $questionData = [];
        $questionData['targetNumber'] = mt_rand(MIN_VALUE, MAX_VALUE);

        return $questionData;
    };

    $getQuestionMessageBody = function (array $questionData): string {

        return "{$questionData['targetNumber']}";
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

    $getCorrectAnswer = function (array $questionData) use ($isPrime): string {
        if ($isPrime($questionData['targetNumber'])) {
            return POS_ANSWER;
        }

        return NEG_ANSWER;
    };

    $initGameData = function() use ($getQuestionData, $getQuestionMessageBody, $getCorrectAnswer): array {
        $questionData = $getQuestionData();
    
        $gameData = [];
        $gameData['questionMessageBody'] = $getQuestionMessageBody($questionData);
        $gameData['correctAnswer'] = $getCorrectAnswer($questionData);
        $gameData['instructions'] = INSTRUCTIONS;
    
        return $gameData;
    };

    runGame($initGameData);
}
