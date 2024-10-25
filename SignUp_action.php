<?php
    if(isset($_POST["submit"])){
        require './connect.php';
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $password2 = $_POST["con_password"];



        //if  There an Empty Space
        if(empty($username) || empty($password) || empty($email)){
            header("Location:./SignUp.php? error=Emptyspace");
            exit();
        }
        //If the Email valid
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location:./SignUp.php? error=Invalid_email");
        exit();

        }
        //Valid User
        elseif(!preg_match("/^[a-zA-Z-' ]*$/", $username)){
            header("Location:./SignUp.php? error=Invalid_username");
            exit();

        }
        //password less than 8
        elseif (strlen($password)< 8) {
            header("Location:./SignUp.php? error=Shorten");
            exit();

        }
        //Password Handler
        elseif (!preg_match("/^[A-Z' ]*$/",subject:$password)) {
            header("Location:./SignUp.php? error=Uppercase");
            exit();

        }
        elseif (!preg_match("/^['a-z']*$/", $password)){
            header("Location:./SignUp.php? error=Lowercase");
            exit();

        }
        elseif (!preg_match("/['!@#$%^&*()_+?.,><;:[]{}\|']^$/", $password)){
            header("Location:./SignUp.php? error=Special_Character");
            exit();
        }
        //Username Email Existing

        else{
        
            $sql = "INSERT INTO `user`(`Username`, `Email`, `Password`) VALUES ('$username','$email','$password')";
            if($conn->query($sql)){
                header("Location:./SignUp.php? Accept=Success");
            }
                else{
                    die("Error".$conn->connect_error);
                }
         }
         mysqli_close($conn);
    }
?>