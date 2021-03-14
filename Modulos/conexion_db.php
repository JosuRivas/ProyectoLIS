<?php

    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "AeroViajes03";
    $db = "aerolinea";

    $conn = new mysqli($db_host,$db_user,$db_pass,$db);
    if($conn){
    }
    else {
        die("Coneccion fallida: %s\n". $conn -> error);
    }
    return $conn;




?>