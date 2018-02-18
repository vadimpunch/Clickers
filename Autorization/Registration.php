<?php require_once("includes/header.php")?>

<body>
<div class="container mregister">
    <div id="login">
        <h1>Регистрация</h1>
        <form action="Registration.php" id="registerform" method="post" name="registerform">
            <p>
                <label for="user_login">Имя
                    <br>
                    <input class="input" id="name" name="name" size="32"  type="text" value="" required>
                </label>
            </p>
            <p>
                <label for="user_pass">Фамилия
                    <br>
                    <input class="input" id="surname" name="surname" size="20" type="text" value="">
                </label>
            </p>
            <p>
                <label for="user_pass">E-mail
                    <br>
                    <input class="input" id="email" name="email" size="32" type="text"
                           placeholder="@std.npu.edu.ua"
                           pattern="(\W|^)[\w.\-]{0,25}@(std\.npu\.edu\.ua|npu\.edu\.ua)(\W|$)"
                           oninvalid="setCustomValidity('Только для пользователей корпоративной почты НПУ им М.П.Драгоманова')"
                           oninput="setCustomValidity('')"
                    >
                </label>
            </p>
            <p>
                <label for="user_pass">Пароль
                    <br>
                    <input class="input" id="password" name="password" size="32"   type="password" value="">
                </label>
            </p>
            <p class="submit">
                <input class="button" id="register" name= "register" type="submit" value="Зарегистрироваться">
            </p>
            <p class="regtext">Уже зарегистрированы?
                <a href="login.php">Войдите!</a>
            </p>
        </form>
    </div>
</div>
</body>
</html>
<?php
require_once __DIR__ . "/../lib/WorkWithDB/connect.php";
if (isset($_POST['register'])) {
    if (!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        $name = htmlspecialchars($_POST['name']);
        $surname = htmlspecialchars($_POST['surname']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $query = "SELECT `e-mail` FROM Users WHERE `e-mail` = {?}";
        $res = $db->selectCell($query, array("$email"));


        if ($res) {
            $message = "Пользователья с таким e-mail уже зарегистрирован!";
        } else {
            $sql = "INSERT INTO Users(Name, Surname, `e-mail`, password) VALUES ({?},{?},{?},{?})";
            $result = $db->noSelectQuery($sql, array($name, $surname, $email, $password));
                }
            if ($result) {
                $message = "Вы успешно зарегистрированы!";
            } else {
                $message = "Не удалось зарегистрировать пользователя!";
            }

    } else {
        $message = "Не все поля заполнены!";

    }
}
?>
<?php if (!empty($message)) {echo "<p class=\"error\" style='margin-top: -40px;'>" .  $message . "</p>";} ?>


