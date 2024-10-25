<?php

if (isset($_POST['signin'])){
    require './connect.php';

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    if(empty($username) || empty($password)){
        header("Location: index.php?error=Field-is-required");
        exit();
    }

    $sql = "SELECT * FROM accounts WHERE account_username = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: index.php?error=sqlError");
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);

        // grabbing the result
        $result = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($result)){
            $passwordCheck = password_verify($password, $row['account_password']);
            $current_timestamp = date('Y-m-d H:i:s');
            $get_timestamp = $row['login_datetime'];
            if($row['locked'] === 2){
                header("Location: index.php?error=account_locked");
                exit();
            }
            if($current_timestamp < $get_timestamp){
                header("Location: index.php?error=tempo_locked");
                exit();
            }
            if($passwordCheck == false){
                $attempt = $row['attempts'] + 1;
                $sql = "UPDATE accounts SET attempts = ? WHERE account_username = ?";
                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt, $sql);
                mysqli_stmt_bind_param($stmt, 'is', $attempt, $username);
                mysqli_stmt_execute($stmt);
                header("Location: index.php?error=wrong-password");

                if($row['locked'] === 1){
                    if($row['attempts'] > 3){
                        $sql = "UPDATE accounts SET locked = 2 WHERE account_username = ?";
                        $stmt = mysqli_stmt_init($conn);
                        mysqli_stmt_prepare($stmt, $sql);
                        mysqli_stmt_bind_param($stmt, 's', $username);
                        mysqli_stmt_execute($stmt);
                    }
                }

                if($row['locked'] === 0){
                    if($row['attempts'] > 1){
                        $attempt_timestamp = date('Y-m-d H:i:s', strtotime('+30 seconds'));
                        $sql = "UPDATE accounts SET login_datetime = ?, locked = 1 WHERE account_username = ?";
                        $stmt = mysqli_stmt_init($conn);
                        mysqli_stmt_prepare($stmt, $sql);
                        mysqli_stmt_bind_param($stmt, 'ss', $attempt_timestamp, $username);
                        mysqli_stmt_execute($stmt);
                    }
                }
            }
            else if($passwordCheck == true && $row['account_role'] == 'user'){
                $sql = "INSERT INTO logs (username, status,timestamp) VALUES ('$username', 'user_signup',NOW())";
                $conn->query($sql);
                session_start();
                $_SESSION['userId'] = htmlspecialchars($row['id']);
                $_SESSION['username'] = htmlspecialchars($row['username']);

                header("Location: landing.php?login=success");
            }
            else if($passwordCheck == true && $row['account_role'] == 'admin'){
                $sql = "INSERT INTO logs (username, status,timestamp) VALUES ('$username', 'admin_login',NOW())";
                $conn->query($sql);
                session_start();
                $_SESSION['adminId'] = htmlspecialchars($row['account_id']);
                $_SESSION['username'] = htmlspecialchars($row['account_username']);

                header("Location: adminPage.php");
            }
            else{
                header("Location: index.php?error=wrong-password");
                exit();
            }
        }
        else{
            header("Location: index.php?error=nouser");
            exit();
        }
    }
}