<?php
include 'connection.php';
session_start();

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
            header('Location: login.php');
        }
    }
} elseif (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            echo 'Přihlášení proběhlo úspěšně!';
            $_SESSION['user_id'] = $row['id']; // ID uživatele

            header('Location: game.php');
        } else {
            require 'login.php';
            echo 'Špatné heslo!';
        }
    } else {
        require 'login.php';
        echo 'Špatný email!';
    }
} else if(isset($_POST['NoLogin'])){
    require 'game.php';

} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_id = $_SESSION['user_id'];
        $poleX = $_POST['poleX'];
        $poleY = $_POST['poleY'];
        $click = $_POST['click'];
        if ($user_id != 0) {
            // SQL dotaz pro vložení dat do tabulky leaderboard
            $sql = "INSERT INTO leaderboard (id_user, poleX, poleY, clicks) VALUES ('$user_id', '$poleX', '$poleY', '$click')";
            $result = mysqli_query($connect, $sql);

            if ($result) {
                echo 'Data byla úspěšně uložena!';
            } else {
                echo 'Data se nepodařilo uložit!';
            }
        }
    }
}

?>
