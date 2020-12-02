<?php

namespace Brain\Game\Progression;

use const Brain\Game\Settings\{PROGRESSION_MIN_SIZE, PROGRESSION_MAX_SIZE, STEP_MIN_SIZE, STEP_MAX_SIZE};

use function cli\line;
use function cli\prompt;
use function Brain\Game\generateNumber;
use function Brain\Game\getUserInput;

function getRandomProgression($minSize, $maxSize, $minStep, $maxStep) : array
{
    $progressionSize = mt_rand($minSize, $maxSize);
    $initValue = generateNumber();
    $stepSize = mt_rand($minStep, $maxStep);
    
    $progression = [];
    
    for($i = 0; $i < $progressionSize; $i++)
    {
        $progression[$i] = $initValue + $stepSize * $i;
    }
    
    $reversed = mt_rand(0,1);
    if($reversed) {
        $progression = array_reverse($progression);
    }
    
    return $progression;
}

function initGameData()
{
    $getInstructions = function()
    {
        return 'What number is missing in the progression?';
    };
    
    $getResult = function()
    {
        $result = [];
        
        $progression = getRandomProgression(PROGRESSION_MIN_SIZE, PROGRESSION_MAX_SIZE, STEP_MIN_SIZE, STEP_MAX_SIZE);
         
        $targetIndex = mt_rand(0, count($progression) - 1);
        $result['correctAnswer'] = $progression[$targetIndex];
        $progression[$targetIndex] = '..';
        $shownProgression = implode($progression, ", ");
        
        line("Question: $shownProgression");
        
        $result['userInput'] = getUserInput();
        $result['isCorrect'] = $result['userInput'] == $result['correctAnswer'];
    
        return $result;
    };

    return [
        'getInstructions' => $getInstructions,
        'getResult' => $getResult
    ];
}
