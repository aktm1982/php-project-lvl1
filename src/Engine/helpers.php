<?php

namespace Brain\Engine;

use function cli\line;
use function cli\prompt;

function showMessage(string $message, string ...$args): void
{
    line($message, ...$args);
}

function getUserInput(string $promptComment = " "): string
{
    return prompt($promptComment);
}
