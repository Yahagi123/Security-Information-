<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "info_sec_database";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection Error". $conn->connect_error);
    }
?>