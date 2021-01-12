<?php

namespace Brain\Engine;

function runGame(array $gameData): void
{
    showMessage(MESSAGE['welcome']);
    $user = getUserInput('May I have your name?');
    showMessage(MESSAGE['hello'], $user);
    showMessage($gameData['instructions']);

    $roundWins = [];

    while (true) {
        $questionData = $gameData['getQuestionData']();
        showMessage(MESSAGE['question'], $gameData['getQuestionMessageBody']($questionData));

        $roundResult = [];
        $roundResult['correctAnswer'] = $gameData['getCorrectAnswer']($questionData);
        $roundResult['userInput'] = getUserInput(MESSAGE['prompt']);

        $roundResult['check'] = $roundResult['correctAnswer'] == $roundResult['userInput'];

        if (!$roundResult['check']) {
            showMessage(MESSAGE['incorrect'], $roundResult['userInput'], $roundResult['correctAnswer']);
            showMessage(MESSAGE['try'], $user);
            break;
        }

        showMessage(MESSAGE['correct']);
        $roundWins[] = $roundResult['check'];

        if (count($roundWins) === ROUNDS_COUNT) {
            showMessage(MESSAGE['congrats'], $user);
            break;
        }
    }
}
