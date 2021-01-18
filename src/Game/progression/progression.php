<?php

namespace Brain\Game\Progression;

use function Brain\Engine\runGame;

function play(): void
{
    $randomReverse = function (array $progression): array {
        $reverseChance = mt_rand(1, 100);

        return $reverseChance > REVERSE_CHANSE_THRESHOLD ? array_reverse($progression) : $progression;
    };

    $generateProgression = function () use ($randomReverse): array {
        $progressionSize = mt_rand(MIN_PROGRESSION_SIZE, MAX_PROGRESSION_SIZE);
        $progressionStep = mt_rand(MIN_PROGRESSION_STEP, MAX_PROGRESSION_STEP);

        $initValue = mt_rand(MIN_VALUE, MAX_VALUE);

        $progression = range($initValue, $initValue + ($progressionSize - 1) * $progressionStep, $progressionStep);

        return $randomReverse($progression);
    };

    $getRandomElement = function (array $progression): int {
        $index = array_rand($progression);
        return $progression[$index];
    };

    $getQuestionSrcData = function () use ($generateProgression, $getRandomElement): array {
        $questionSrcData = [];
        $questionSrcData['progression'] = $generateProgression();
        $questionSrcData['targetNumber'] = $getRandomElement($questionSrcData['progression']);

        return $questionSrcData;
    };

    $getShownProgression = function (array $progression, int $element): array {
        $index = array_search($element, $progression, true);
        $progression[$index] = '..';

        return $progression;
    };

    $getQuestionString = function (array $questionSrcData) use ($getShownProgression): string {
        ['progression' => $progression, 'targetNumber' => $targetNumber] = $questionSrcData;
        $shownProgression = $getShownProgression($progression, $targetNumber);

        return implode(" ", $shownProgression);
    };

    $getCorrectAnswer = function (array $questionSrcData): string {
        $targetNumber = $questionSrcData['targetNumber'];

        return (string)$targetNumber;
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
