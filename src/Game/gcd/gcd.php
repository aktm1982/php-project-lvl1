<?php

namespace Brain\Game\Gcd;

use function Brain\Common\Engine\runGame;
use function Brain\Common\Helpers\{showMessage, generateNumber};

use const Brain\Game\Gcd\{MIN_VALUE, MAX_VALUE, INSTRUCTIONS};
use const Brain\Common\Settings\MESSAGE;

function initGame(): array
{
    $getDivs = function (int $num): array {
        $divs = [];
        for ($i = 1; $i <= $num; $i++) {
            if ($num % $i === 0) {
                $divs[] = $i;
            }
        }

        return $divs;
    };

    $makeQuestion = function () use ($getDivs): int {
        $number1 = generateNumber(MIN_VALUE, MAX_VALUE);
        $divs1 = $getDivs($number1);

        $number2 = generateNumber(MIN_VALUE, MAX_VALUE);
        $divs2 = $getDivs($number2);

        showMessage(MESSAGE['question'], "$number1 $number2");

        return max(array_intersect($divs1, $divs2));
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
