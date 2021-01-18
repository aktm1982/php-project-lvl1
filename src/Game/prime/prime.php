<?php

namespace Brain\Game\Prime;

use function Brain\Engine\runGame;

function play(): void
{
    $getQuestionSrcData = function (): array {
        $questionSrcData = [];
        $questionSrcData['targetNumber'] = mt_rand(MIN_VALUE, MAX_VALUE);

        return $questionSrcData;
    };

    $getQuestionString = function (array $questionSrcData): string {

        return "{$questionSrcData['targetNumber']}";
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

    $getQuestionObject = function () use ($getQuestionSrcData, $getQuestionString, $getCorrectAnswer): array {
        $questionSrcData = $getQuestionSrcData();

        $questionObject = [];
        $questionObject['questionString'] = $getQuestionString($questionSrcData);
        $questionObject['correctAnswer'] = $getCorrectAnswer($questionSrcData);

        return $questionObject;
    };

    $initGameData = function () use ($getQuestionObject): array {
        $gameData = [];
        $gameData['getQuestionObject'] = $getQuestionObject;
        $gameData['instructions'] = INSTRUCTIONS;

        return $gameData;
    };

    runGame($initGameData);
}
