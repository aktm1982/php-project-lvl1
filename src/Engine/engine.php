<?php

namespace Brain\Engine;

function runGame(array $gameData): void
{
    showMessage(MESSAGES['welcome']);
    $user = getUserInput(MESSAGES['name']);
    showMessage(MESSAGES['hello'], $user);
    showMessage($gameData['instructions']);

    for ($roundNum = 1; $roundNum <= ROUNDS_COUNT; $roundNum++) {
        $questionData = $gameData['getQuestionData']();
        showMessage(MESSAGES['question'], $gameData['getQuestionMessageBody']($questionData));

        $correctAnswer = $gameData['getCorrectAnswer']($questionData);
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
