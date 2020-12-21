<?php

namespace Brain\Common\Helpers;

use const Brain\Common\Settings\{INIT_SCORE, TARGET_SCORE, SCORE_STEP, LOST_SCORE, MESSAGE};

function showMessage(string $message, ...$args)
{
    \cli\line($message, ...$args);
}

function getUserInput($promptComment = null)
{
    do {
        $result = \cli\prompt($promptComment);
    } while (empty($result));

    return $result;
}

function setUser(): string
{
    showMessage(MESSAGE['welcome']);
    $user = getUserInput('May I have your name?');
    showMessage(MESSAGE['hello'], $user);

    return $user;
}

function continueGame(int $score): bool
{
    return $score >= INIT_SCORE && $score < TARGET_SCORE;
}

function generateNumber($minValue, $maxValue): int
{
    return rand($minValue, $maxValue);
}

function setScore(int $score, bool $correct): int
{
    if ($correct) {
        return $score += SCORE_STEP;
    }

    return $score = LOST_SCORE;
}

function checkResult(string $user, int $score, $roundResult): int
{
    $score = setScore($score, $roundResult['isCorrect']);

    if ($roundResult['isCorrect']) {
        showMessage(MESSAGE['correct']);
        if ($score >= TARGET_SCORE) {
            showMessage(MESSAGE['congrats'], $user);
        }
    } else {
        showMessage(MESSAGE['incorrect'], $roundResult['userInput'], $roundResult['correctAnswer']);
        showMessage(MESSAGE['try'], $user);
    }

    return $score;
}
