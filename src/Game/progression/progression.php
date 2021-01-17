<?php

namespace Brain\Game\Progression;

use function Brain\Engine\runGame;

function initGame(): array
{
    $randomReverse = function (array $progression): array {
        $reverseChance = mt_rand(1, 100);

        return $reverseChance > REVERSE_THRESHOLD ? array_reverse($progression) : $progression;
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

    $getQuestionData = function () use ($generateProgression, $getRandomElement): array {
        $questionData = [];
        $questionData['progression'] = $generateProgression();
        $questionData['targetNumber'] = $getRandomElement($questionData['progression']);

        return $questionData;
    };

    $getShownProgression = function (array $progression, int $element): array {
        $index = array_search($element, $progression, true);
        $progression[$index] = '..';

        return $progression;
    };

    $getQuestionMessageBody = function (array $questionData) use ($getShownProgression): string {
        ['progression' => $progression, 'targetNumber' => $targetNumber] = $questionData;
        $shownProgression = $getShownProgression($progression, $targetNumber);

        return implode(" ", $shownProgression);
    };

    $getCorrectAnswer = function (array $questionData): int {

        return $questionData['targetNumber'];
    };

    $gameData = [];
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
