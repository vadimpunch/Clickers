<?php




function separateQAarray($newarray, $regularExpression)
{
    $newarray = array();
    foreach ($_POST as $key=>$value)
    {
        if (preg_match($regularExpression, $key))
        {
            array_push($newarray ,$_POST[$key]);
        }
    }
    return $newarray;
}

function answersToQuestions($questions, $answers)
{
    for ($i = 0; $i <= array_count_values($questions); $i++){

        array_push($answers, separateQAarray($questions, '/^question'.$i.'/'));
    }
}