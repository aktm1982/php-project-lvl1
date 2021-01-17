<?php

namespace Brain\Engine;

function runGame(array $gameData): void
{
    [
        'getQuestionData' => $getQuestionData,
        'getQuestionMessageBody' => $getQuestionMessageBody,
        'getCorrectAnswer' => $getCorrectAnswer,
        'instructions' => $instructions
    ] = $gameData;

    showMessage(MESSAGES['welcome']);
    $user = getUserInput(MESSAGES['name']);
    showMessage(MESSAGES['hello'], $user);
    showMessage($instructions);

    for ($roundNum = 0; $roundNum < ROUNDS_COUNT; $roundNum++) {
        $questionData = $getQuestionData();
        showMessage(MESSAGES['question'], $getQuestionMessageBody($questionData));

        $correctAnswer = $getCorrectAnswer($questionData);
        $userInput = getUserInput(MESSAGES['prompt']);

        if ($correctAnswer != $userInput) {
            showMessage(MESSAGES['incorrect'], $userInput, $correctAnswer);
            showMessage(MESSAGES['try'], $user);
            exit;
        }

        showMessage(MESSAGES['correct']);
    }

    showMessage(MESSAGES['congrats'], $user);
}
