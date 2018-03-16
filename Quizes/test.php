<?php
require_once "../lib/WorkWithDB/connect.php";

$curIdArr = [];
$curAnsIdArr =[];
$countVotingArr =[];
$numericPOST = [];

foreach ($_POST as $key=>$value)
{
    array_push($numericPOST, $value);
}
var_dump($numericPOST);

foreach ($_POST as $question=>$answer)
{
    echo $answer;

    $question = str_replace('_', " ", $question);
$sql = "SELECT id FROM Questions WHERE Title = {?}";
$questionId = $db->selectColumn($sql,  array($question));
for ($i=0; $i<=(count($questionId)-1); $i++)
{
    array_push($curIdArr , $questionId[$i]);
}



    $sql = "SELECT QuestionsId FROM Answers WHERE Title={?}";
    $answerId = $db->selectColumn($sql, array($answer));

    for ($i=0; $i<=(count($answerId)-1); $i++)
    {
        array_push($curAnsIdArr , $answerId[$i]);
    }

}

$resultArr = array_uintersect($curIdArr, $curAnsIdArr, "strcasecmp");
print_r($resultArr);

foreach ($resultArr as $id)
{
    foreach ($_POST as $question=>$answer) {
        $sql = "SELECT CountVouts FROM Answers WHERE Title = {?} AND QuestionsID = {?}";
        $countVoting = $db->selectColumn($sql, array($answer, $id));
        if ($countVoting)
        {for ($i=0; $i<=(count($countVoting)-1); $i++)
             array_push($countVotingArr, $countVoting[$i]);
        }
    }


}
var_dump($countVotingArr);
for ($i=0; $i<=(count($countVotingArr)-1); $i++)
{

    $countVotingArr[$i] +=1;
    $sql = "UPDATE Answers SET CountVouts ={?} WHERE QuestionsID = {?} AND Title = {?}";

        $db->noSelectQuery($sql, array($countVotingArr[$i], $resultArr[$i], $numericPOST[$i]));
        echo ($db->conection->error);


}

foreach ($resultArr as $id) {
    foreach ($_POST as $question => $answer) {
        $sql = "SELECT CountVouts FROM Answers WHERE Title = {?} AND QuestionsID = {?}";
        $countVoting = $db->selectColumn($sql, array($answer, $id));
        if ($countVoting) {
            for ($i = 0; $i <= (count($countVoting) - 1); $i++)
                array_push($countVotingArr, $countVoting[$i]);
        }
        $countVotingArr = array_unique($countVotingArr);
    }
}
print_r($countVotingArr);

