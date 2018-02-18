<?php
session_start();
require_once  "../lib/WorkWithDB/connect.php";
require_once "../lib/Separate.php";

$separator = new Separate();
$questions = $separator->separateQAarray($questions, '/^question/');
print_r($questions);
$answers = $separator->answersToQuestions($questions);
echo "<br>";print_r($questions);

foreach ($questions as $value)
{
    $sql = "INSERT INTO Questions(Title) VALUES ({?})";
    $db->noSelectQuery($sql, array($value));
    echo($db->conection->error);
}

foreach ($answers as &$value)
{
        $value = serialize($value);
        $sql = "INSERT INTO Questions(Answers) VALUES ({?})";
        $db->noSelectQuery($sql, array($value));

}





if (isset($_SESSION['user_name']) && isset($_SESSION['user_surname'])) {
    if (isset($_POST['theme']) && isset($_POST['category'])
        && isset($_POST['allowcomments']) && isset($_POST['anon'])) {

        $category = htmlspecialchars($_POST['category']);
        $theme = htmlspecialchars($_POST['theme']);
        $allowComments = $_POST['allowcomments'];
        $allowAnon = $_POST['anon'];
        date_default_timezone_set('Europe/Kiev');
        $currentDate = date('Y\.m\.d H:i:s');
        $sql = "INSERT INTO Quizes(Category, Theme, Comments, Date, AuthorName, AuhtorSurname, Anon ) VALUES ({?},{?},{?},{?},{?},{?},{?})";

        $result = $db->noSelectQuery($sql, array($category, $theme, $allowComments,$currentDate,$_SESSION['user_name'],$_SESSION['user_surname'], $allowAnon));
        echo ($db->conection->error);    }
    else echo "LOHI";
}
else echo "<script language=\"javascript\">
                       document.location.href='../Autorization/intropage.php';
                       </script>";




