<?php
    include "connection.php";
    
    if(isset($_POST["register"])){
        $email = $_POST["email"];
        $password = $_POST["password"];
        $check_password = $_POST["check_password"];

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($connect, $sql);
        if(mysqli_num_rows($result) > 0){
            echo "Email již existuje!";
        }else{
            if($password == $check_password){
                if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                    if(strlen($password) < 25){
                        $password = password_hash($password, PASSWORD_DEFAULT);
                        $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
                        if(mysqli_query($connect, $sql)){
                            echo "Registrace proběhla úspěšně!";
                        }else{
                            echo "Registrace se nezdařila!";
                        }
                    }else{
                        echo "Heslo je příliš dlouhé!";
                    }
                }else{
                    echo "Email není validní!";
                }
            }else{
                echo "Hesla se neshodují!";
            }
        }
    }

    if(isset($_POST["login"])){
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($connect, $sql);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row["password"])){
                echo "Přihlášení proběhlo úspěšně!";
            }else{
                echo "Špatné heslo!";
            }
        }else{
            echo "Špatný email!";
        }
    }

?>