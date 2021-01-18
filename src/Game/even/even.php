<?php

namespace Brain\Game\Even;

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

    $isEven = function (int $number): bool {

        return $number % 2 === 0;
    };

    $getCorrectAnswer = function (array $questionSrcData) use ($isEven): string {
        if ($isEven($questionSrcData['targetNumber'])) {
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
