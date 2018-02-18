<?php
session_start();
include "includes/header.php";
require_once("../lib/WorkWithDB/connect.php");


if (isset($_SESSION["user_name"]))
{
  echo  "<script language=\"javascript\">
document.location.href='intropage.php';
        </script>";
}

else {
    if (isset($_POST['login'])) {
        if (!empty($_POST['e-mail']) && !empty($_POST['password'])) {
            $email = htmlspecialchars($_POST['e-mail']);
            $password = htmlspecialchars($_POST['password']);

            $sql = "SELECT `e-mail` FROM Users WHERE `e-mail` = {?}";
            $user_email = $db->selectCell($sql, array($email));
            $query = "SELECT `password` FROM Users WHERE  `password` = {?}";
            $user_password = $db->selectCell($query, array($password));
            $confirmquery = "SELECT `e-mail`, `password` FROM Users WHERE `e-mail` = {?} AND `password` = {?}";
            $numrows = $db->selectRow($confirmquery, array($user_email, $user_password));
            if ($numrows !== false) {


                if ($email == $user_email && $password == $user_password) {
                    $nameQuery = "SELECT `name` FROM Users WHERE `e-mail` = {?}";
                    $surnameQuery = "SELECT `surname` FROM Users WHERE  `e-mail` = {?}";
                    $name = $db->selectCell($nameQuery, array($email));
                    $surname = $db->selectCell($surnameQuery, array($email));
                    $_SESSION['user_name'] = $name;
                    $_SESSION['user_surname'] = $surname;
                    echo "<script language=\"javascript\">
                       document.location.href='intropage.php';
                       </script>";

                }
            } else {
                $mes = "Неверный логин или пароль!";
            }

        }
    }
}

?>

<body>
<?php if (!empty($mes)) {echo "<p class=\"error\">" .  $mes . "</p>";} ?>
<div class="container mlogin">

    <div id="login">
        <h1>Вход</h1>

        <form action="" id="loginform" method="post" name="loginform">
            <p><label for="user_login">E-mail<br>
                    <input class="input" id="e-mail" name="e-mail" size="20"
                           type="email" value=""></label></p>
            <p><label for="user_pass">Пароль<br>
                    <input class="input" id="password" name="password" size="20"
                           type="password" value=""></label></p>
            <p class="submit"><input class="button" name="login" type= "submit" value="Вход"></p>

            <p class="regtext">Еще не зарегистрированы?<a href= "Registration.php">Регистрация</a>!</p>

        </form>

    </div>
</div>
<footer>


</footer>
</body>

