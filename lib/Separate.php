<?php
/**
 * Created by PhpStorm.
 * User: Панченко
 * Date: 17.02.2018
 * Time: 17:17
 */

class Separate
{
    public function separateQAarray($newarray, $regularExpression)
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

   public function answersToQuestions($questions)
    {
        $answers = array();
        for ($i = 1; $i <= count($questions); $i++){

            array_push($answers, $this->separateQAarray($answers, '/^answer'.$i.'/'));
        }
        return $answers;
    }

}
