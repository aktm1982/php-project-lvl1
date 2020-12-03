<?php
namespace Brain\Game;

use const Brain\Game\Settings\{INIT_SCORE, TARGET_SCORE, MIN_VALUE, MAX_VALUE, MESSAGE};

use function Brain\Game\Calc\initGame as initCalcGame;

use function Brain\Game\Even\initGame as initEvenGame;

use function Brain\Game\Gcd\initGame as initGcdGame;

use function Brain\Game\Prime\initGame as initPrimeGame;

use function Brain\Game\Progression\initGame as initProgressionGame;

use function cli\line;

use function cli\prompt;

function showMessage(string $message, ...$args)
{
    line($message, ...$args);
}

function getUserInput($promptComment = null)
{
    do {
        $result = trim(prompt($promptComment));
    } while (empty($result));

    return $result;
}

function setUser(): string
{
    showMessage(MESSAGE['welcome']);
    $user = getUserInput('May I have your name?');
    showMessage(MESSAGE['hello'], $user);

    return $user;
}

function continueGame(int $score): bool
{
    return $score >= INIT_SCORE && $score < TARGET_SCORE;
}

function generateNumber(): int
{
    return rand(MIN_VALUE, MAX_VALUE);	
}


function generateItemFromList($itemList)
{
    return $itemList[mt_rand(0, count($itemList) - 1)];
}

function getAnswerAsWord(int $number, callable $callback)
{
    if($callback($number)) {
        return 'yes';
    }

    return 'no';
} 

function initGame(string $GameType): array
{
    switch($GameType) {
        case "BrainCalc":
            return initCalcGame();
        case "BrainEven":
            return initEvenGame();
        case "BrainGcd":
            return initGcdGame();
        case "BrainPrime":
            return initPrimeGame();
        case "BrainProgression":
            return initProgressionGame();
    }
}

function setScore(int $score, bool $correct): int
{
    if($correct) {
        return $score += 1;
    }

    return $score = -1;
}

function checkResult(string $user, int $score, $gameResult): int
{
    $score = setScore($score, $gameResult['isCorrect']);

    if ($gameResult['isCorrect']) {
        showMessage(MESSAGE['correct']);
        if ($score >= TARGET_SCORE) {
            showMessage(MESSAGE['congrats'], $user);
        }
    } else {
        showMessage(MESSAGE['incorrect'], $gameResult['userInput'], $gameResult['correctAnswer']);
        showMessage(MESSAGE['try'], $user);
    }

    return $score;
}

function playGame(string $GameType)
{
    ['getInstructions' => $getInstructions, 'getResult' => $getResult] = initGame($GameType);
    $user = setUser();
    $score = INIT_SCORE;

    line($getInstructions());

    $gameResult = [];

    while(continueGame($score)) {
        $gameResult = $getResult();
        $score = checkResult($user, $score, $gameResult);
    }
}
