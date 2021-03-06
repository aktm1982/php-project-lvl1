<?php

namespace Brain\Games\Progression;

use function Brain\Engine\runGame;

function randomReverse(array $progression): array
{
    $reverseChance = mt_rand(1, 100);

    return $reverseChance > REVERSE_CHANCE_THRESHOLD ? array_reverse($progression) : $progression;
}

function generateProgression(): array
{
    $progressionSize = mt_rand(MIN_PROGRESSION_SIZE, MAX_PROGRESSION_SIZE);
    $progressionStep = mt_rand(MIN_PROGRESSION_STEP, MAX_PROGRESSION_STEP);
    $initValue = mt_rand(MIN_VALUE, MAX_VALUE);

    $progression = range($initValue, $initValue + ($progressionSize - 1) * $progressionStep, $progressionStep);

    return randomReverse($progression);
}

function getQuestion(array $progression, int $targetIndex): string
{
    $progression[$targetIndex] = '..';

    return implode(" ", $progression);
}

function getCorrectAnswer(array $progression, int $targetIndex): string
{
    return (string)$progression[$targetIndex];
}

function play(): void
{
    $getRoundData = function (): array {
        $progression = generateProgression();
        $targetIndex = (int)array_rand($progression);

        $roundData = [];
        $roundData['question'] = getQuestion($progression, $targetIndex);
        $roundData['correctAnswer'] = getCorrectAnswer($progression, $targetIndex);

        return $roundData;
    };

    runGame($getRoundData, INSTRUCTIONS);
}
