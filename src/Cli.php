<?php

namespace Brain\Games\Cli;

use function cli\line;
use function cli\prompt;

function setUser(): void
{
    line("Welcome to the Brain games!");
    $name = prompt('May I have your name?');
    line("Hello, %s!", $name);
}
