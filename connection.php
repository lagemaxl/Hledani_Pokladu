<?php

    $connect = new mysqli("localhost", "root","","hledani_pokladu") or die();

    if($connect->connect_errno){
        //echo "Nastala chyba neumíte pracovat s DB: ".$connect->connect_error;
    }
    else{
        //echo "Připojili jste se úšpěšně k DB";
    }
?>