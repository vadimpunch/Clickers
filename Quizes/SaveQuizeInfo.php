<?php
session_start();
require_once  "../lib/WorkWithDB/connect.php";
require_once "../lib/Separate.php";
require_once "../lib/QuizeInfoOutput.php";
require_once "../css/includes.php";



$separator = new Separate();
$questions = $separator->separateQAarray($questions, '/^question/');
$answers = $separator->answersToQuestions($questions);


for($i=0;  $i<=(count($questions)-1); $i++ ) {

    $answers[$i] = serialize($answers[$i]);
    $sql = "INSERT INTO Questions(Title, Answers) VALUES ({?}, {?})";
    $db->noSelectQuery($sql, array($questions[$i], $answers[$i]));
    echo($db->conection->error);
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

        if($db->conection->error)
        {

            if ($db->conection->error == "Duplicate entry '$theme' for key 'Quizes_Theme_uindex'")
            {
                echo("<div class=\"alert alert-danger\" role=\"alert\">
 Опитування з такою темою вже існує!
</div>");
            }
           die("<div class=\"alert alert-danger\" role=\"alert\">
 Не вдалося створити опитування!
</div>");

        }
    }
    else echo "Вказані не всі параметри!";
}
else echo "<script language=\"javascript\">
                       document.location.href='../Autorization/intropage.php';
                       </script>";


$sql = "SELECT id FROM Quizes WHERE Theme = {?}";
$fileName = base64_encode($db->selectCell($sql, array($theme)));
$fileName .= ".php";
$stream = fopen($fileName, 'w+');
$sql = "SELECT AuthorName FROM Quizes WHERE Theme = {?}";
$authorsName = $db->selectCell($sql, array($theme));
$sql = "SELECT AuhtorSurname FROM Quizes WHERE Theme = {?}";
$authorSurname = $db->selectCell($sql, array($theme));
$sql = "SELECT CountVotings FROM Quizes WHERE Theme = {?}";
$countVouters = $db->selectCell($sql, array($theme));


$file = "
<?php
require_once \"../../css/includes.php\";
?>

<nav class=\"navbar navbar-light bg-light\">
    <span class=\"navbar-brand\" href=\"#\">
        <img src=\"../../images/logo.png\" width=\"45\" height=\"45\" class=\"d-inline-block align-top\" alt=\"\">
    </span>
    <span class=\"navbar-brand mb-0\">
        <b class=\"h4\">Clickers</b>
    </span>
    <form class=\"form-inline\">
        <button class=\"btn btn-outline-danger\" type=\"button\">Вийти</button>
    </form>
</nav>






<div class=\"form-group col-md-6 mx-auto\">
    <h2 class=\"text-center text-info\"><?php echo \"$theme\"?></h2>
</div>
<div class=\"row container-fluid \">
    <div class=\"form-group col-md-3 mx-auto alert alert-success\">
        <h5 class=\"text-center text-info\"><b>Автор опитування:</b></h5>
        <h6 class=\"text-center text-success\"><?php echo \"$authorsName $authorSurname\"?></h6>
        <h5 class=\"text-center text-info\"><b>Кількість опитуванних:</b></h5>
        <h6 class=\"text-center text-success\"><b><?php echo \"$countVouters\"?></b></h6>
    </div>
    <div class=\"form-group col-md-6 mx-auto alert-info\">
        <form   method=\"post\" action='../test.php'>";


fwrite($stream, $file);
for($i=0;  $i<=(count($questions)-1); $i++ ) {
    {
        $questionHtml = "
                    
                <legend>{$questions[$i]}</legend>";

        $answer = unserialize($answers[$i]);
        foreach ($answer as $one) {
            $questionID = array_pop($db->selectColumn("SELECT id FROM Questions WHERE Title = ({?})", array($questions[$i])));
            var_dump($questionID);
            $sql = "INSERT INTO Answers(Title,QuestionsID) VALUES ({?}, {?})";
            $db->noSelectQuery($sql, array($one, $questionID));
            echo ($db->conection->error);
            $questionHtml .= "
<div class=\"form-check\">
                        <label  class=\"form-check-label\">
                        <input type=\"radio\" class=\"form-check-input\" name=\"{$questions[$i]}\" value=\"$one\">
               $one
                         </label>
                </div>
                  
                     <hr>
                  
                    ";
        }

        file_put_contents($fileName, $questionHtml, FILE_APPEND);
    }
}
$right =
"
<div class=\"form-group row\">
            <div class=\"offset-md-5 col-sm-10\">
                <button type=\"submit\" class=\"btn btn-info btn-lg\" > Створити опитування </button>
            </div>
        </div>
</div>
<div class=\"form-group col-md-3 mx-auto alert alert-success\">
        <h5 class=\"text-center text-info\"><b>Дата створення опитування:</b></h5>
        <h6 class=\"text-center text-success\"><?php echo \"25:08:17 21:10\"?></h6>
    </div>
    </div>";
file_put_contents($fileName, $right, FILE_APPEND);
fclose($stream);
rename($fileName, "ActiveQuizes/$fileName");
?>





