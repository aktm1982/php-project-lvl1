<?php

namespace Brain\Engine;

function runGame(array $initGameData): void
{
    showMessage(MESSAGES['welcome']);
    $user = getUserInput(MESSAGES['name']);
    showMessage(MESSAGES['hello'], $user);

    for ($roundNum = 0; $roundNum < ROUNDS_COUNT; $roundNum++) {
        [
            'instructions' => $instructions,
            'questionMessageBody' => $questionMessageBody,
            'correctAnswer' => $correctAnswer
        ] = $initGameData();

        if ($roundNum === 0) {
            showMessage($instructions);
        }

        showMessage(MESSAGES['question'], $questionMessageBody);

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
