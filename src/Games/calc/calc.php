<?php

namespace Brain\Games\Calc;

use function Brain\Engine\runGame;

function getOperations(): array
{
    return [
        '+' => (fn($x, $y) => $x + $y),
        '-' => (fn($x, $y) => $x - $y),
        '*' => (fn($x, $y) => $x * $y)
    ];
}

function getCorrectAnswer(int $operand1, int $operand2, string $operatorIndex): string
{
    return (string)getOperations()[$operatorIndex]($operand1, $operand2);
}

function play(): void
{
    $getRoundData = function (): array {

        $operand1 = mt_rand(MIN_OPERAND_VALUE, MAX_OPERAND_VALUE);
        $operand2 = mt_rand(MIN_OPERAND_VALUE, MAX_OPERAND_VALUE);
        $operatorIndex = (string)array_rand(getOperations());

        $roundData = [];
        $roundData['question'] = "$operand1 $operatorIndex $operand2";
        $roundData['correctAnswer'] = getCorrectAnswer($operand1, $operand2, $operatorIndex);

        return $roundData;
    };

    runGame($getRoundData, INSTRUCTIONS);
}
