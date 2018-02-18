<?php
session_start();
    if (!isset($_SESSION['user_name']) && !isset($_SESSION['user_surname']))
{
    header("Location: login.php");
}
else
{
require_once("includes/header.php");
?>


<div id="welcome">
    <h2>Добро пожаловать, <span> <?php echo "{$_SESSION['user_name']} {$_SESSION['user_surname']}"; }?>!</span></h2>
<div class="quizWrapper">
    <a href="../Quizes/TutorsQuizes.php" class="quizBtn">       <div>Опитування викладачів</div></a>
    <a href="../Quizes/StudentsQuizes.php" class="quizBtn">     <div>Опитування студентів </div></a>
    <a href="../Quizes/FacultyQuizes.php" class="quizBtn">      <div>Опитування факультету</div></a>
    <a href="../Quizes/UniversityQuizes.php" class="quizBtn">   <div>Опитування університету</div></a>
</div>
    <p><a href="logout.php">Выйти</a> из системы</p>
</div>

