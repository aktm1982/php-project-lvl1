<?php
namespace Brain\Game;

require_once __DIR__ . '/../../vendor/autoload.php';

use const Brain\Game\Settings\{INIT_SCORE, TARGET_SCORE, MIN_VALUE, MAX_VALUE};

use function Brain\Game\Calc\initGameData as initCalcGameData;
use function Brain\Game\Even\initGameData as initEvenGameData;

use function cli\line;
use function cli\prompt;

function setUser(): string
{
    line("Welcome to the Brain games!");
    $userName = prompt('May I have your name?');
    line("Hello, %s!", $userName);
    return $userName;
}

function continueGame(int $score): bool
{
    return $score >= INIT_SCORE && $score < TARGET_SCORE;
}

function generateNumber(): int
{
    return mt_rand(MIN_VALUE, MAX_VALUE);	
}

function getUserInput()
{
    do {
        $result = trim(prompt('Your answer'));
    } while (empty($result));
    
    return $result;
}  

function initGameData(string $GameType): array
{
    switch($GameType) {
        case "BrainCalc":
            return initCalcGameData();
        case "BrainEven":
            return initEvenGameData();
    }
}

function checkResult(array $gameData, $gameResult): int
{
    if ($gameResult['isCorrect']) {
        line('Correct!');
        $gameData['score'] += 1;
        if ($gameData['score'] >= TARGET_SCORE) {
            line("Congratulations, {$gameData['user']}!");
        }
    } else {
        line("'{$gameResult['userInput']}' is wrong answer ;(. Correct answer was '{$gameResult['correctAnswer']}'.");
        line("Let's try again, {$gameData['user']}!");
        $gameData['score'] = -1;
    }

    return $gameData['score'];
}

function playGame(string $GameType)
{
    $gameData = initGameData($GameType);
    $gameData['user'] = setUser();
    $gameData['score'] = INIT_SCORE;
    
    line($gameData['getInstructions']());
    
    $gameResult = [];
    
    while(continueGame($gameData['score'])) {
        $gameResult = $gameData['getResult']();
        $gameData['score'] = checkResult($gameData, $gameResult);
    }
}
