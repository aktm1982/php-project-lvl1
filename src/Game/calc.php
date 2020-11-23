<?php

namespace Brain\Game\Calc;

use function cli\line;
use function cli\prompt;

function getCorrectAnswer(int $operand1, string $operator, int $operand2): int
{
    switch ($operator) {
        case '+':
            return $operand1 + $operand2;
        case '-':
            return $operand1 - $operand2;
    }
}

function getResult(): array
{
    $result = [];
    $operators = ['+','-'];
    $operand1 = mt_rand(1, 100);
    $operand2 = mt_rand(1, 100);
    $operator = $operators[mt_rand(0, 1)];
    line("Question: $operand1 $operator $operand2");
    $result['userInput'] = trim(prompt('Your answer'));
    $result['correctAnswer'] = getCorrectAnswer($operand1, $operator, $operand2);
    $result['isCorrect'] = $result['userInput'] == $result['correctAnswer'];
    return $result;
}
