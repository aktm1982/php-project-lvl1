<?php

namespace Brain\Game\Progression;

use function Brain\Common\Engine\runGame;
use function Brain\Common\Helpers\{showMessage, generateNumber};

use const Brain\Game\Progression\{MIN_VALUE, MAX_VALUE, INSTRUCTIONS, PROGRESSION_SIZE, PROGRESSION_STEP};
use const Brain\Common\Settings\MESSAGE;

function initGame(): array
{
    $generateNumberFromList = function (array $numbersList): int {
        $index = mt_rand(0, count($numbersList) - 1);
        return $numbersList[$index];
    };

    $getRandomProgression = function () use ($generateNumberFromList): array {
        $progressionSize = $generateNumberFromList(PROGRESSION_SIZE);
        $progressionStep = $generateNumberFromList(PROGRESSION_STEP);

        $initValue = generateNumber(MIN_VALUE, MAX_VALUE);

        $progression = range($initValue, $initValue + ($progressionSize - 1) * $progressionStep, $progressionStep);

        if ($reversed = mt_rand(0, 1)) {
            $progression = array_reverse($progression);
        }

        return $progression;
    };

    $getRandomElement = function (array $progression) use ($generateNumberFromList): int {
        return $generateNumberFromList($progression);
    };

    $getShownProgression = function (array $progression, int $element): array {
        $index = array_search($element, $progression);
        $progression[$index] = '..';

        return $progression;
    };

    $makeQuestion = function () use ($getRandomProgression, $getRandomElement, $getShownProgression): int {
        $progression = $getRandomProgression();
        $targetNumber = $getRandomElement($progression);
        $shownProgression = $getShownProgression($progression, $targetNumber);

        showMessage(MESSAGE['question'], implode(" ", $shownProgression));

        return $targetNumber;
    };

    $gameData['makeQuestion'] = $makeQuestion;
    $gameData['instructions'] = INSTRUCTIONS;

    return $gameData;
}

function play(): void
{
    $gameData = initGame();
    runGame($gameData);
}
