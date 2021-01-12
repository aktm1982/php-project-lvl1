<?php

namespace Brain\Engine;

function runGame(array $gameData): void
{
    showMessage(MESSAGES['welcome']);
    $user = getUserInput('May I have your name?');
    showMessage(MESSAGES['hello'], $user);
    showMessage($gameData['instructions']);

    for ($roundNum = 1; $roundNum <= ROUNDS_COUNT; $roundNum++) {
        $questionData = $gameData['getQuestionData']();
        showMessage(MESSAGES['question'], $gameData['getQuestionMessageBody']($questionData));

        $roundResult = [];
        $roundResult['correctAnswer'] = $gameData['getCorrectAnswer']($questionData);
        $roundResult['userInput'] = getUserInput(MESSAGES['prompt']);

        $roundResult['check'] = $roundResult['correctAnswer'] == $roundResult['userInput'];
        if (!$roundResult['check']) {
            showMessage(MESSAGES['incorrect'], $roundResult['userInput'], $roundResult['correctAnswer']);
            showMessage(MESSAGES['try'], $user);
            break;
        }

        showMessage(MESSAGES['correct']);

        if ($roundNum === ROUNDS_COUNT) {
            showMessage(MESSAGES['congrats'], $user);
            break;
        }
    }
}
