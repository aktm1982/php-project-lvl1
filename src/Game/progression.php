<?php

namespace Brain\Game\Progression;

use const Brain\Game\Settings\{MESSAGE, PROGRESSION_SIZE, PROGRESSION_STEP};
use function Brain\Game\{showMessage, getUserInput, generateNumber, generateItemFromList};

function getRandomProgression() : array
{
    $progressionSize = generateItemFromList(PROGRESSION_SIZE);
    $progressionStep = generateItemFromList(PROGRESSION_STEP);
    
    $initValue = generateNumber();
    
    $progression = range($initValue, $initValue + ($progressionSize - 1) * $progressionStep, $progressionStep);
    
    if($reversed = mt_rand(0,1)) {
        $progression = array_reverse($progression);
    }
    
    return $progression;
}

function getRandomElement($progression)
{
    return generateItemFromList($progression);
}

function getShownProgression($progression, $element)
{
    $index = array_search($element, $progression);
    $progression[$index] = '..';
    
    return $progression;
}

function initGame()
{
    $getInstructions = function()
    {
        return MESSAGE['progressionInstructions'];
    };
    
    $getResult = function()
    {
        $progression = getRandomProgression();
        
        $result = [];
        $result['correctAnswer'] = getRandomElement($progression);
        
        $shownProgression = getShownProgression($progression, $result['correctAnswer']);
        
        showMessage(MESSAGE['question'], implode($shownProgression, ", "));
        
        $result['userInput'] = getUserInput(MESSAGE['prompt']);
        $result['isCorrect'] = $result['userInput'] == $result['correctAnswer'];
    
        return $result;
    };

    return [
        'getInstructions' => $getInstructions,
        'getResult' => $getResult
    ];
}
