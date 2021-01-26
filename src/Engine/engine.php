<?php

namespace Brain\Engine;

function runGame(callable $getRoundData, string $instructions): void
{
    showMessage(MESSAGES['welcome']);
    $user = getUserInput(MESSAGES['name']);
    showMessage(MESSAGES['hello'], $user);
    showMessage($instructions);

    for ($roundNum = 0; $roundNum < ROUNDS_COUNT; $roundNum++) {
        [
            'question' => $question,
            'correctAnswer' => $correctAnswer,
        ] = $getRoundData();

        showMessage(MESSAGES['question'], $question);

        $userInput = getUserInput(MESSAGES['prompt']);
        if ($correctAnswer !== $userInput) {
            showMessage(MESSAGES['incorrect'], $userInput, $correctAnswer);
            showMessage(MESSAGES['try'], $user);
            exit;
        }

        showMessage(MESSAGES['correct']);
    }

    showMessage(MESSAGES['congrats'], $user);
}
