<?php

namespace Brain\Game\Progression;

use function Brain\Common\Engine\runGame;
use function Brain\Common\Helpers\{showMessage, getUserInput, generateNumber};

use const Brain\Game\Progression\{MIN_VALUE, MAX_VALUE, INSTRUCTIONS, PROGRESSION_SIZE, PROGRESSION_STEP};
use const Brain\Common\Settings\MESSAGE;

function initGame(): array
{
    $generateNumberFromList = function (array $numbersList): int {
        $index = mt_rand(0, count($numbersList) - 1);
        return $numbersList[$index];
    };

    $getRandomProgression = function (): array {
        $progressionSize = $generateNumberFromList(PROGRESSION_SIZE);
        $progressionStep = $generateNumberFromList(PROGRESSION_STEP);

        $initValue = generateNumber(MIN_VALUE, MAX_VALUE);

        $progression = range($initValue, $initValue + ($progressionSize - 1) * $progressionStep, $progressionStep);

        if ($reversed = mt_rand(0, 1)) {
            $progression = array_reverse($progression);
        }

        return $progression;
    };

    $getRandomElement = function (array $progression): int {
        return $generateNumberFromList($progression);
    };

    $getShownProgression = function (array $progression, int $element): array {
        $index = array_search($element, $progression);
        $progression[$index] = '..';

        return $progression;
    };

    $getRoundResult = function (): array {
        $progression = $getRandomProgression();

        $result = [];
        $result['correctAnswer'] = $getRandomElement($progression);

        $shownProgression = $getShownProgression($progression, $result['correctAnswer']);

        showMessage(MESSAGE['question'], implode(" ", $shownProgression));

        $result['userInput'] = getUserInput(MESSAGE['prompt']);
        $result['isCorrect'] = $result['userInput'] == $result['correctAnswer'];

        return $result;
    };

    $GameData['getRoundResult'] = $getRoundResult;
    $GameData['instructions'] = INSTRUCTIONS;

    return $GameData;
}

function play(): void
{
    $GameData = initGame();
    runGame($GameData);
}
