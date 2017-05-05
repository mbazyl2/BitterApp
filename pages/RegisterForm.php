<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register to BitterApp</title>
    <link rel="stylesheet" type="text/css" href="../css/stylesOne.css">
</head>
<body>
    <h2 align="center">Formularz rejestracji</h2>
    <div>
        <form action="../index.php" method="post">
            <label class="registerLabel"> Name: </label><input class="registerInput" type="text" name="name" placeholder="Name">
            <br><br>
            <label class="registerLabel"> E-mail: </label><input class="registerInput" type="text" name="mail" placeholder="Mail">
            <br><br>
            <label class="registerLabel"> Password: </label><input class="registerInput" type="password" name="password" placeholder="******">
            <br><br>
            <input class="submitButton" type="submit" value="Register">
        </form>
    </div>
</body>
</html>