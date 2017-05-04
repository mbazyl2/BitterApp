<?php

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title> BitterApp </title>
    <link rel="stylesheet" type="text/css" href="css/stylesOne.css">
</head>
<body>

    <h1 align="center"> Welcome to the BitterApp ! </h1>
    <div>
        <form action="./pages/main.php" method="post">
            <label class="loginLabel"> Please, fill your login: </label><input class="loginInput" type="text" name="login" placeholder="Login">
            <br><br>
            <label class="loginLabel"> Enter Your Password here: </label><input class="loginInput" type="password" name="password" placeholder="*********">
            <br><br>
            <input class="submitButton" type="submit" value="Log In :-) !">
        </form>

    </div>
</body>
</html>
