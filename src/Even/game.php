<?php

namespace Brain\Even\Source;

require_once __DIR__ . '/../../vendor/autoload.php';

use Brain\Even\Options;

use function \cli\line;
use function \cli\prompt;

function setUser(): string
{
	line("Welcome to the Brain games!");
        $userName = prompt('May I have your name?');
        line("Hello, %s!", $userName);
        line('Answer "yes" if the number is even, otherwise answer "no".');
        return $userName;
}

function getRightAnswer(int $targetNumber) : string
{
	if($targetNumber % 2 === 0) {
		return 'yes';
	}
	
	return 'no';
}

function checkUserInput(int $targetNumber, string $userInput) : bool 
{
	
	if ($userInput === getRightAnswer($targetNumber)) {
		return true;
	} 
	
	return false;
}

function setScore(bool $result, int $score) 
{
	if ($result) {
		return $score += 1;
	} 
	
	return $score;
}
