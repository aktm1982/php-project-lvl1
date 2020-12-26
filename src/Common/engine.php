<?php

namespace Brain\Common\Engine;

use function Brain\Common\Helpers\{setUser, showMessage, getUserInput, continueGame, checkResult};

use const Brain\Common\Settings\{INIT_SCORE, MESSAGE};

function runGame(array $gameData): void
{
    $user = setUser();
    $score = INIT_SCORE;

    showMessage($gameData['instructions']);

    while (continueGame($score)) {
        $roundResult['question'] = $gameData['makeQuestion']();
        $roundResult['userInput'] = getUserInput(MESSAGE['prompt']);

        $roundResult['isCorrect'] = $roundResult['question'] == $roundResult['userInput'];
        $score = checkResult($user, $score, $roundResult);
    }
}
