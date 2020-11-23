<?php

namespace Brain\Game\Common;

require_once __DIR__ . '/../../vendor/autoload.php';

use function \cli\line;
use function \cli\prompt;

function initializeGame(): string
{
	line("Welcome to the Brain games!");
        $userName = prompt('May I have your name?');
        line("Hello, %s!", $userName);
    
        return $userName;
}

function checkResult(array $result, array $brainGameData) : int
{
	if ($result['isCorrect']) {
		line('Correct!');
		$brainGameData['score'] += 1;
	} else {
		line("'{$result['userInput']}' is wrong answer ;(. Correct answer was '{$result['correctAnswer']}'.");
		line("Let's try again, {$brainGameData['userName']}!");
		$brainGameData['score'] = -1;
	}
		
	if ($brainGameData['score'] >= $brainGameData['targetScore']) {
		line("Congratulations, {$brainGameData['userName']}!");
	}
	
	return $brainGameData['score'];
}	
