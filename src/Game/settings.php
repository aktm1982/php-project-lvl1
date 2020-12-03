<?php

namespace Brain\Game\Settings;

const INIT_SCORE           = 0;
const TARGET_SCORE         = 3;

const MIN_VALUE            = 1;
const MAX_VALUE            = 100;

const OPERATORS            = ['+', '-'];

const PROGRESSION_SIZE     = [5, 6, 7, 8, 9, 10];
const PROGRESSION_STEP     = [2, 3, 4, 5];

const SIMPLE_NUMS          = [2, 3, 5, 7, 11];

const MESSAGE              = [
    'welcome' => 'Welcome to the Brain games!',
    'hello' => 'Hello, %s',
    'question' => 'Question: %s',
    'prompt' => 'Your answer',
    'correct' => 'Correct!',
    'incorrect' => '\'%s\' is wrong answer ;(. Correct answer was \'%s\'.',
    'congrats' => 'Congratulations, %s!',
    'try' => 'Let\'s try again, %s!',
    'evenInstructions' => 'Answer "yes" if the number is even, otherwise answer "no".',
    'calcInstructions' => 'What is the result of the expression?',
    'gcdInstructions' => 'Find the greates common divisor of given numbers',
    'progressionInstructions' => 'What number is missing in the progression?',
    'primeInstructions' => 'Answer "yes" if given number is prime. Otherwise answer "no".'
];
