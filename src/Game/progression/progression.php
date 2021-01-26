<?php

namespace Brain\Game\Progression;

use function Brain\Engine\runGame;

function randomReverse(array $progression): array
{
    $reverseChance = mt_rand(1, 100);

    return $reverseChance > REVERSE_CHANSE_THRESHOLD ? array_reverse($progression) : $progression;
}

function generateProgression(): array
{
    $progressionSize = mt_rand(MIN_PROGRESSION_SIZE, MAX_PROGRESSION_SIZE);
    $progressionStep = mt_rand(MIN_PROGRESSION_STEP, MAX_PROGRESSION_STEP);
    $initValue = mt_rand(MIN_VALUE, MAX_VALUE);

    $progression = range($initValue, $initValue + ($progressionSize - 1) * $progressionStep, $progressionStep);

    return randomReverse($progression);
}

function getShownProgression(array $progression, int $index): array
{
    $progression[$index] = '..';

    return $progression;
}

function play(): void
{
    $getRoundData = function (): array {
        $progression = generateProgression();
        $targetIndex = (int)array_rand($progression);
        $shownProgression = getShownProgression($progression, $targetIndex);

        $roundData = [];
        $roundData['roundQuestion'] = implode(" ", $shownProgression);
        $roundData['roundAnswer'] = (string)$progression[$targetIndex];

        return $roundData;
    };

    runGame($getRoundData, INSTRUCTIONS);
}
