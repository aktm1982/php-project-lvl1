<?php

namespace Brain\Engine;

use function cli\line;
use function cli\prompt;

function runGame(callable $getRoundData, string $instructions): void
{
    line(MESSAGES['welcome']);
    $user = prompt(MESSAGES['name']);
    line(MESSAGES['hello'], $user);
    line($instructions);

    for ($roundNum = 0; $roundNum < ROUNDS_COUNT; $roundNum++) {
        [
            'question' => $question,
            'correctAnswer' => $correctAnswer,
        ] = $getRoundData();

        line(MESSAGES['question'], $question);

        $userInput = prompt(MESSAGES['prompt']);
        if ($correctAnswer !== $userInput) {
            line(MESSAGES['incorrect'], $userInput, $correctAnswer);
            line(MESSAGES['try'], $user);
            exit;
        }

        line(MESSAGES['correct']);
    }

    line(MESSAGES['congrats'], $user);
}
