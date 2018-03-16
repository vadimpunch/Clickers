<?php
require_once "../css/includes.php";
?>



<nav class="navbar navbar-light bg-light">
    <span class="navbar-brand" href="#">
        <img src="../images/logo.png" width="45" height="45" class="d-inline-block align-top" alt="">
        <span  class="h3">Нове опитування</span>
    </span>
    <span class="navbar-brand mb-0">
        <b class="h4">Clickers</b>
    </span>
    <form class="form-inline">
        <button class="btn btn-outline-danger" type="button">Вийти</button>
    </form>
</nav>
<form id="newQuizForm" action="SaveQuizeInfo.php" method="post">
        <div class="form-group col-md-6 mx-auto">
                <label for="Theme" id="labelForQuizeName">Тема</label>
                <input type="text" class="form-control"  id="Theme" name="theme" placeholder="Введіть тему опитування" required>
            </div>

     <div class="form-group col-md-6 mx-auto">
         <label class="mr-sm-2" for="inlineFormCustomSelect">Категорія</label>
         <select class="form-control" id="inlineFormCustomSelect" name="category" required>
           <option disabled selected>Оберіть категорію опитування</option>
           <option value="Опитування викладаів">Опитування викладачів</option>
           <option value="Опитування студентів">Опитування студентів</option>
           <option value="Опитування факульетета">Опитування факультета</option>
           <option value="Опитування університета">Опитування університета</option>
         </select>
      </div>
    <div class="form-group col-md-6 mx-auto">
         <fieldset class="form-group">
            <legend>Коментарі</legend>
              <div class="form-check">
                 <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="allowcomments" value="1">
                Так
                 </label>
            </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="allowcomments"  value="0">
               Ні
            </label>
        </div>
    </fieldset>
    </div>
    <div class="form-group col-md-6 mx-auto">
        <fieldset class="form-group" id="radioSetupQuizes">
                <legend>Анонімне опитування</legend>
            <div class="form-check">
                <label  class="form-check-label" id="anonLabel">
                    <input type="radio" class="form-check-input" name="anon" value="1">
                    Так
                </label>
            </div>
            <div class="form-check">
                <label  class="form-check-label" id="anonLabel2">
                    <input type="radio" class="form-check-input" name="anon" value="0">
                  Ні
                </label>
            </div>
        </fieldset>
        <hr>
    </div>

    <div class="form-group col-md-6 mx-auto">

        <div class="form-group row">
            <div class="offset-md-5 col-sm-10">
                <button type="button" class="btn btn-info btn-lg" id="add_question"> Додати питання </button>
            </div>
        </div>

    </div>
    <div class="form-group col-md-6 mx-auto" id="add_quize">

        <div class="form-group row">
            <div class="offset-md-5 col-sm-10">
                <button type="submit" class="btn btn-info btn-lg" > Створити опитування </button>
            </div>
        </div>

    </div>


</form>