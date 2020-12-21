<?php

namespace Brain\Common\Engine;

use function Brain\Common\Helpers\{setUser, showMessage, continueGame, checkResult};

use const Brain\Common\Settings\INIT_SCORE;

function runGame(array $GameData): void
{
    $user = setUser();
    $score = INIT_SCORE;

    showMessage($GameData['instructions']);

    while (continueGame($score)) {
        $roundResult = $GameData['getRoundResult']();
        $score = checkResult($user, $score, $roundResult);
    }
}
