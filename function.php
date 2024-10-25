<?php

include "./connect.php";

function display_data(){
    global $conn;
    $sql = "SELECT * FROM accounts";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result;
}