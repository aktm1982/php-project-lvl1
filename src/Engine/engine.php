<?php

namespace Brain\Engine;

function runGame(callable $initGameData): void
{
    [
        'instructions' => $instructions,
        'getQuestionObject' => $getQuestionObject,
    ] = $initGameData();

    showMessage(MESSAGES['welcome']);
    $user = getUserInput(MESSAGES['name']);
    showMessage(MESSAGES['hello'], $user);
    showMessage($instructions);

    for ($roundNum = 0; $roundNum < ROUNDS_COUNT; $roundNum++) {
        [
            'questionString' => $questionString,
            'correctAnswer' => $correctAnswer,
        ] = $getQuestionObject();

        showMessage(MESSAGES['question'], $questionString);

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
