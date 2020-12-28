<?php

namespace Brain\Game\Prime;

use function Brain\Common\Engine\runGame;

use const Brain\Common\Settings\MESSAGE;

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
