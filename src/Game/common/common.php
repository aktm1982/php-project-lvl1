<?php

namespace Brain\Game\Common;

use const Brain\Game\Settings\{INIT_SCORE, TARGET_SCORE, MIN_VALUE, MAX_VALUE, MESSAGE};

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
        return $score += 1;
    }

    return $score = -1;
}

function checkResult(string $user, int $score, $gameResult): int
{
    $score = setScore($score, $gameResult['isCorrect']);

    if ($gameResult['isCorrect']) {
        showMessage(MESSAGE['correct']);
        if ($score >= TARGET_SCORE) {
            showMessage(MESSAGE['congrats'], $user);
        }
    } else {
        showMessage(MESSAGE['incorrect'], $gameResult['userInput'], $gameResult['correctAnswer']);
        showMessage(MESSAGE['try'], $user);
    }

    return $score;
}
