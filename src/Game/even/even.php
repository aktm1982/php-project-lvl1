<?php

namespace Brain\Game\Even;

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

    $isEven = function (int $number): bool {

        return $number % 2 === 0;
    };

    $getCorrectAnswer = function (array $questionData) use ($isEven): string {
        if ($isEven($questionData['targetNumber'])) {
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
