<?php

namespace Brain\Engine;

function runGame(array $getRoundData, string $instructions): void
{
    showMessage(MESSAGES['welcome']);
    $user = getUserInput(MESSAGES['name']);
    showMessage(MESSAGES['hello'], $user);
    showMessage($instructions);

    for ($roundNum = 0; $roundNum < ROUNDS_COUNT; $roundNum++) {
        [
            'roundQuestion' => $roundQuestion,
            'roundAnswer' => $roundAnswer,
        ] = $getRoundData();

        showMessage(MESSAGES['question'], $roundQuestion);

        $userInput = getUserInput(MESSAGES['prompt']);
        if ($roundAnswer !== $userInput) {
            showMessage(MESSAGES['incorrect'], $userInput, $roundAnswer);
            showMessage(MESSAGES['try'], $user);
            exit;
        }

        showMessage(MESSAGES['correct']);
    }

    showMessage(MESSAGES['congrats'], $user);
}
