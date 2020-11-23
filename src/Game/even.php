<?php

namespace Brain\Game\Even;

use function \cli\line;
use function \cli\prompt;

function getCorrectAnswer(int $targetNumber) : string
{
	if($targetNumber % 2 === 0) {
		return 'yes';
	}
	
	return 'no';
}

function getResult() : array
{
	$result = [];
	$targetNumber = mt_rand(1,100);
	line("Question: $targetNumber");
	$result['userInput'] = trim(prompt('Your answer'));
	$result['correctAnswer'] = getCorrectAnswer($targetNumber);
	$result['isCorrect'] = $result['userInput'] === $result['correctAnswer'];
	return $result;
}
