<?php

namespace Brain\Game\Gcd;

use function Brain\Common\Engine\runGame;
use function Brain\Common\Helpers\{showMessage, generateNumber, getUserInput};

use const Brain\Game\Gcd\{MIN_VALUE, MAX_VALUE, INSTRUCTIONS};
use const Brain\Common\Settings\MESSAGE;

function initGame()
{
    function getDivs(int $num)
    {
        $divs = [];
        for ($i = 1; $i <= $num; $i++) {
            if ($num % $i === 0) {
                $divs[] = $i;
            }
        }

        return $divs;
    }

    $getRoundResult = function () {
        $number1 = generateNumber(MIN_VALUE, MAX_VALUE);
        $divs1 = getDivs($number1);

        $number2 = generateNumber(MIN_VALUE, MAX_VALUE);
        $divs2 = getDivs($number2);

        $result['correctAnswer'] = max(array_intersect($divs1, $divs2));

        showMessage(MESSAGE['question'], "$number1 $number2");

        $result['userInput'] = getUserInput(MESSAGE['prompt']);
        $result['isCorrect'] = $result['userInput'] == (string)$result['correctAnswer'];

        return $result;
    };

    $GameData['getRoundResult'] = $getRoundResult;
    $GameData['instructions'] = INSTRUCTIONS;

    return $GameData;
}

function play()
{
    $GameData = initGame();
    runGame($GameData);
}
