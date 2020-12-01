<?php

namespace Brain\Game\Calc;

use const Brain\Game\Settings\OPERATORS;

use function cli\line;
use function cli\prompt;
use function Brain\Game\generateNumber;
use function Brain\Game\getUserInput;

function getCorrectAnswer(int $operand1, int $operand2, string $operator): int
{
    switch ($operator) {
        case '+':
            return $operand1 + $operand2;
        case '-':
            return $operand1 - $operand2;
    }
}

function initGameData()
{
    $getInstructions = function()
    {
        return 'What is the result of the expression?';
    };
    
    $getResult = function()
    {
        $result = [];
        $operators = OPERATORS;
        
        $operand1 = generateNumber();
        $operand2 = generateNumber();
        $operator = $operators[mt_rand(0, count($operators) - 1)];
        
        line("Question: $operand1 $operator $operand2");
        
        $result['userInput'] = getUserInput();
        $result['correctAnswer'] = getCorrectAnswer($operand1, $operand2, $operator);
        $result['isCorrect'] = $result['userInput'] == $result['correctAnswer'];
    
        return $result;
    };

    return [
        'getInstructions' => $getInstructions,
        'getResult' => $getResult
    ];
}
