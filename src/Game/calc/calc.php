<?php

namespace Brain\Game\Calc;

use function Brain\Engine\runGame;

function play(): void
{
    $getRoundData = function (): array {
        $operations = [
            '+' => (fn($x, $y) => $x + $y),
            '-' => (fn($x, $y) => $x - $y),
            '*' => (fn($x, $y) => $x * $y)
        ];

        $operand1 = mt_rand(MIN_OPERAND_VALUE, MAX_OPERAND_VALUE);
        $operand2 = mt_rand(MIN_OPERAND_VALUE, MAX_OPERAND_VALUE);
        $operatorIndex = array_rand($operations);
        $operation = $operations[$operatorIndex];

        $roundData = [];
        $roundData['roundQuestion'] = "$operand1 $operatorIndex $operand2";
        $roundData['roundAnswer'] = (string)$operation($operand1, $operand2);

        return $roundData;
    };

    runGame($getRoundData, INSTRUCTIONS);
}
