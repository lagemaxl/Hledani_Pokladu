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

if (isset($_POST['savedata'])) {
    $conn = new mysqli("localhost", "root", "", "hledani_pokladu");
    // Zpracování dat z AJAX požadavku
    $user_id = $_POST['user_id'];
    $poleX = $_POST['poleX'];
    $poleY = $_POST['poleY'];
    $click = $_POST['click'];

    // SQL dotaz pro vložení dat do tabulky leaderboard
    $sql = "INSERT INTO leaderboard (id_user, poleX, poleY, click) VALUES ('$user_id', '$poleX', '$poleY', '$click')";
    $result = mysqli_query($connect, $sql);

    if ($result) {
        echo 'Data byla úspěšně uložena!';
    } else {
        echo 'Data se nepodařilo uložit!';
    }
}

require 'game.php';

?>
