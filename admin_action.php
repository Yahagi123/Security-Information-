<?php

include "connect.php";
$sql = "SELECT * FROM accounts";
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$sql = "SELECT * FROM logs";
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_execute(statement: $stmt);
$resultLogs = mysqli_stmt_get_result($stmt);