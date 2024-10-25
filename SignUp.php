<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Arima:wght@100..700&display=swap" rel="stylesheet">
    <title>Sign Up </title>
    <link rel="stylesheet" href="SignUp.css">
</head>
<body>
    <!-- Sign IN Form  -->
     <div class="box_container">

        <form action="SignUp_action.php" method="post">
            <!-- Validation -->
            <div class="valid-container">
    <?php 
    
    if(isset($_GET['error'])){
        if($_GET['error'] == 'emptyfields'){
            echo '<span>Empty fields</span>';
        }
        if($_GET['error'] == 'invalidEmailandUsername'){
            echo '<span>Invalid Email and username</span>';
        }
        if($_GET['error'] == 'invalidEmail'){
            echo '<span>Invalid email</span>';
        }
        if($_GET['error'] == 'usernmatFormat'){
            echo '<span>Invalid username</span>';
        }
        if($_GET['error'] == 'invalidLengthPassword'){
            echo '<span>Password must be more than 8 characters</span>';
        }
        if($_GET['error'] == 'passwordcheck'){
            echo '<span>Password not match</span>';
        }
        if($_GET['error'] == 'usertaken'){
            echo '<span>Username is taken</span>';
        }
        if($_GET['error'] == 'password2'){
            echo '<span>Uppercase</span>';
        }
        if($_GET['error'] == 'password3'){
            echo '<span>Lowercase</span>';
        }
        if($_GET['error'] == 'password4'){
            echo '<span>One digit</span>';
        }
        if($_GET['error'] == 'password5'){
            echo '<span>One special symbol</span>';
        }
    }
    if(isset($_GET['signup'])){
        if($_GET['signup'] == 'success'){
            echo "<span id='success' >account successfully created</span>";
        }
    }

    ?>
</div>
            <h2>Sign In</h2>

            <div class="container">
                <label for="Username">Username</label>
                <input type="text" name="username" id="username" placeholder="Username" >
            </div>
            <div class="container">
                <label for="Email">Email Address</label>
                <input type="email" name="email" id="email" placeholder="Email Address">
            </div>
            <div class="container">
                <label for="Password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" >
            </div>
            <div class="container">
                <label for="Password">Confirm Password</label>
                <input type="password" name="con_password" id="con_password" placeholder="Confirm Password" >
            </div>
            <div class="submit">
                <input type="submit" value="Sign In" name="submit" id="submit">

            </div>
            
        </form>

     </div>
</body>
</html>