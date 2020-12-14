<?php

namespace Brain\Game\Engine;

use function Brain\Game\Common\{setUser, showMessage, continueGame, checkResult};

use const Brain\Game\Settings\INIT_SCORE;

function runGame(array $GameData)
{
    $user = setUser();
    $score = INIT_SCORE;

    showMessage($GameData['instructions']);

    while (continueGame($score)) {
        $gameResult = $GameData['getResult']();
        $score = checkResult($user, $score, $gameResult);
    }
}
