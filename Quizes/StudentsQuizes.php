<?php
session_start();
require_once "../css/includes.php";
require_once "../lib/QuizeInfoOutput.php";
?>


<nav class="navbar navbar-light bg-light">
    <span class="navbar-brand" href="#">
        <img src="../images/logo.png" width="45" height="45" class="d-inline-block align-top" alt="">
        <?php  echo "Вітаю, <i>{$_SESSION['user_name']} {$_SESSION['user_surname']}</i>!"?>
    </span>
    <span class="navbar-brand mb-0"><b class="h4">Clickers</b></span>
    <form class="form-inline">
        <button class="btn btn-outline-danger" type="button">Вийти</button>
    </form>
</nav>
<div class="row container-fluid">
    <div class="col-md-2 col-xs-12 sidebar" id="sidebar_container">
        <ul class="nav flex-column nav-pills nav-fill" >
            <li class="nav-item">
                <a class="nav-link "  href="TutorsQuizes.php">Опитування викладачів</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="StudentsQuizes.php">Опитування <br> студентів</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="FacultyQuizes.php">Опитування факультета</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="UniversityQuizes.php">Опитування університета</a>
                <hr>
            </li>
            <li class="nav-item">
                <a href="NewQuize.php" id="newQuizbtn"><button class="btn btn-outline-info" type="button">Створити опитування</button></a>
            </li>
        </ul>
    </div>

    <?php
    $db = new QuizeInfoOutput();
    $themes = $db->selectAttrInCategory('Опитування студентів', 'Theme');
    $authorsName =  $db->selectAttrInCategory('Опитування студентів', 'AuthorName');
    $authorsSurName =  $db->selectAttrInCategory('Опитування студентів', 'AuhtorSurname');
    $date = $db->selectAttrInCategory('Опитування студентів', 'Date');
    $countVotings = $db->selectAttrInCategory('Опитування студентів', 'Date');




    ?>
    <div class="col-md-10 col-xs-12 main">
        <h1 class="text-center display-4">Опитування студентів</h1>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Тема</th>
                <th>Автор</th>
                <th>Дата</th>
                <th>Кількість опитуваних</th>
            </tr>
            </thead>
            <tbody>
            <?php for ($i=0; $i<=count($themes)-1; $i++)
            { echo("<tr>
                <th scope=\"row\">{$i}</th>
                <td>{$themes[$i]}</td>
                <td>{$authorsName[$i]} {$authorsSurName[$i]}</td>
                <td>{$date[$i]}</td>
                <td>{$countVotings[$i]}</td>
            </tr>");} ?>
            </tbody>
        </table>
    </div>
</div>
