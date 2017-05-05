<?php
require_once('../autoloader.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) {

        //assigning data form sent form into variables
        $name = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        //check if username and email already is in database
        if (User::loadByUsername($name)) {
            echo "<span>Username already exists! Choose another.</span>";
            return false;
        } else if (User::loadByEmail($email)) {
            echo "<span>E-mail already used!</span>";
            return false;
        } else {

            try {

//Creting new user and saving info into database
                $user = new User();
                $user->setUsername($name);
                $user->setEmail($email);
                $user->setPasswordHash($password);
                $user->save();

                echo "Account created. You can log in now. ";
                echo "<a href=../index.php'>Log In</a>";
            } catch (Exception $e) {
                echo "Uwaga: " . $e->getMessage() . "\n";
                return false;
            }
        }
    } else {
        echo "<span>Fill empty spaces!</span>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register to BitterApp</title>
    <link rel="stylesheet" type="text/css" href="../css/stylesOne.css">
</head>
<body>
    <h2 align="center">Register Form :</h2>
    <div>
        <form action="" method="post">
            <label class="registerLabel"> Name: </label><input class="registerInput" type="text" name="username" placeholder="Name">
            <br><br>
            <label class="registerLabel"> E-mail: </label><input class="registerInput" type="text" name="email" placeholder="Mail">
            <br><br>
            <label class="registerLabel"> Password: </label><input class="registerInput" type="password" name="password" placeholder="******">
            <br><br>
            <input class="submitButton" type="submit" value="Register">
        </form>
    </div>
</body>
</html>