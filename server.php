<?php
include 'connection.php';

if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $check_password = $_POST['check_password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) > 0) {
        require 'registrace.php';
        echo 'Email již v databázy existuje!';
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
        if (mysqli_query($connect, $sql)) {
            echo 'Registrace proběhla úspěšně!';
            header('Location: game.php');
        }
    }
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            echo 'Přihlášení proběhlo úspěšně!';
            header('Location: game.php');
        } else {
            require 'login.php';
            echo 'Špatné heslo!';
        }
    } else {
        require 'login.php';
        echo 'Špatný email!';
    }
}

require 'game.php';

?>
