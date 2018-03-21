<?php
require_once "../../lib/WorkWithDB/connect.php";



$curIdArr = [];
$curAnsIdArr =[];
$countVotingArr =[];
$numericPOST = [];
$result = [];

foreach ($_POST as $key=>$value)
{
    array_push($numericPOST, $value);
}


foreach ($_POST as $question=>$answer)
{


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

for ($i=0; $i<=(count($countVotingArr)-1); $i++)
{

    $countVotingArr[$i] +=1;
    $sql = "UPDATE Answers SET CountVouts ={?} WHERE QuestionsID = {?} AND Title = {?}";

    $db->noSelectQuery($sql, array($countVotingArr[$i], $resultArr[$i], $numericPOST[$i]));
    echo ($db->conection->error);


}

foreach ($resultArr as $id) {

    $sql = "SELECT CountVouts FROM Answers WHERE QuestionsID = {?}";
    $countVoting = $db->selectColumn($sql, array($id));
    if ($countVoting) {
        for ($i = 0; $i <= (count($countVoting) - 1); $i++)
            array_push($result, $countVoting[$i]);
    }


}
$result = json_encode($result);
echo($result);

