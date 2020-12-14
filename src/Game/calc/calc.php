<?php

namespace Brain\Game\Calc;

use function Brain\Game\Engine\runGame;
use function Brain\Game\Common\{showMessage, getUserInput, generateNumber};

use const Brain\Game\Calc\Settings\{OPERATORS, INSTRUCTIONS};
use const Brain\Game\Settings\MESSAGE;

function initGame(): array
{ 
    function generateOperator($operatorsList)
    {
        $index = mt_rand(0, count($operatorsList) - 1);
        return $operatorsList[$index];
    }

    function getCorrectAnswer(int $operand1, int $operand2, string $operator): int
    {
        switch ($operator) {
      	    case '+':
               return $operand1 + $operand2;
	    case '-':
		return $operand1 - $operand2;
	}
    }
    
    $getResult = function () {
        $operand1 = generateNumber();
        $operand2 = generateNumber();
        $operator = generateOperator(OPERATORS);

        showMessage(MESSAGE['question'], "$operand1 $operator $operand2");

        $result = [];
        $result['userInput'] = getUserInput(MESSAGE['prompt']);
        $result['correctAnswer'] = getCorrectAnswer($operand1, $operand2, $operator);
        $result['isCorrect'] = $result['userInput'] == $result['correctAnswer'];

        return $result;
    };
    
    $GameData['getResult'] = $getResult;
    $GameData['instructions'] = INSTRUCTIONS;
    
    return $GameData;
}

function play()
{
    $GameData = initGame();
    runGame($GameData);
}
