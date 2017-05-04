<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="../css/stylesOne.css">
</head>
<body>
<div align="center">
<?php
if(isset($_POST['login']) && isset($_POST["password"])){
    $login = $_POST['login'];
    $password = $_POST["password"];

    echo "Zalogowany użytkownik o loginie $login <br>";
    echo "Hasło użytkownika to: $password";
}else{
    echo "Nie podano wymaganych danyc do logowania ;-)";
}
?>
    <br>
    <a href="../index.php"><button>Starting Page</button></a>
</div>
</body>
</html>



