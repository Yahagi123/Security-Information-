<?php

if(isset($_POST['submit'])){
    require './connect.php';

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cf_pasword = $_POST['con_password'];

    // VALID EMPTY FIELDS
    if(empty($username) || empty($email) || empty($password) || empty($cf_pasword)){
        header('Location: ./signup.php?error=emptyfields');
        exit();
    }
    // VALID EMAIL
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header('Location: ./signup.php?error=invalidEmail');
        exit();
    }
    // VALID USERNAME
    else if(!preg_match('/[a-zA-Z]+\.[a-zA-Z]+$/', $username)){
        header('Location: ./signup.php?error=usernmatFormat');
    }

    // PASSWORD HANDLERS
    
    else if(strlen($password) < 8){
        header('Location: ./signup.php?error=invalidLengthPassword');
        exit();
    }
    else if(!preg_match('/[A-Z]/', $password)){
        header('Location: ./signup.php?error=password2');
    }
    else if(!preg_match('/[a-z]/', $password)){
        header('Location: ./signup.php?error=password3');
    }
    else if(!preg_match('/\d/', $password)){
        header('Location: ./signup.php?error=password4');
    }
    else if(!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)){
        header('Location: ./signup.php?error=password5');   
    }
    else if($password !== $cf_pasword){
        header('Location: ./signup.php?error=passwordcheck');
        exit();
    }

    // IF USERNAME IS TAKEN HANDLERS
    else{

        $sql = "SELECT account_username FROM accounts WHERE account_username = ?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header('Location: ./signup.php?error=sqlerror');
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $result = mysqli_stmt_num_rows($stmt);
            if($result > 0){
                header('Location: ./signup.php?error=usertaken');
                exit();
            }
            else{

                $sql  = "INSERT INTO accounts (account_username, account_password, account_email, account_role) VALUES (?,?,?,'user');";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header('Location: ./signup.php?error=sqlerror');
                    exit();
                }
                else{

                    $hash_password = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sss", $username, $hash_password, $email);
                    mysqli_stmt_execute($stmt);

                    $sql = "INSERT INTO logs (username, status,timestamp) VALUES ('$username', 'user_signupz',NOW())";
                    $conn->query($sql);
                    header('Location: ./signup.php?signup=success');
                    exit();
                }

            }
        }

    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);


}
else{
    header('Location: ./register.php');
}