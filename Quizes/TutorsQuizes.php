<?php
session_start();
require_once "../css/includes.php";

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
                <a class="nav-link "  href="#">Опитування викладачів</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Опитування <br> студентів</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Опитування факультета</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Опитування університета</a>
                <hr>
            </li>
            <li class="nav-item">
                <a href="NewQuize.php" id="newQuizbtn"><button class="btn btn-outline-info" type="button">Створити опитування</button></a>
            </li>
        </ul>
    </div>


    <div class="col-md-10 col-xs-12 main">
        <h1 class="text-center display-4">Опитування викладачів</h1>
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
            <tr>
                <th scope="row">1</th>
                <td>Marksdkjgsk</td>
                <td>Otto fon Bismark huismark</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@TwBootstrap</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
            <tr>
                <th scope="row">4</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
            </tr>
            </tbody>
        </table>
    </div>
    </div>
