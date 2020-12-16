<?php

namespace Brain\Game\Progression;

use function Brain\Game\Engine\runGame;
use function Brain\Game\Common\{showMessage, getUserInput, generateNumber};

use const Brain\Game\Progression\{MIN_VALUE, MAX_VALUE, INSTRUCTIONS, PROGRESSION_SIZE, PROGRESSION_STEP};
use const Brain\Game\Settings\MESSAGE;

function initGame()
{
    function generateNumberFromList($numbersList)
    {
        $index = mt_rand(0, count($numbersList) - 1);
        return $numbersList[$index];
    }

    function getRandomProgression(): array
    {
        $progressionSize = generateNumberFromList(PROGRESSION_SIZE);
        $progressionStep = generateNumberFromList(PROGRESSION_STEP);

        $initValue = generateNumber(MIN_VALUE, MAX_VALUE);

        $progression = range($initValue, $initValue + ($progressionSize - 1) * $progressionStep, $progressionStep);

        if ($reversed = mt_rand(0, 1)) {
            $progression = array_reverse($progression);
        }

        return $progression;
    }

    function getRandomElement($progression)
    {
        return generateNumberFromList($progression);
    }

    function getShownProgression($progression, $element)
    {
        $index = array_search($element, $progression);
        $progression[$index] = '..';

        return $progression;
    }

    $getResult = function () {
        $progression = getRandomProgression();

        $result = [];
        $result['correctAnswer'] = getRandomElement($progression);

        $shownProgression = getShownProgression($progression, $result['correctAnswer']);

        showMessage(MESSAGE['question'], implode($shownProgression, ", "));

        $result['userInput'] = getUserInput(MESSAGE['prompt']);
        $result['isCorrect'] = $result['userInput'] == $result['correctAnswer'];

        return $result;
    };

    $GameData['getResult'] = $getResult;
    $GameData['instructions'] = INSTRUCTIONS;

    return $GameData;
}

function play()
{
    $GameData = initGame();
    runGame($GameData);
}
