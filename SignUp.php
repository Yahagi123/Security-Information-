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
            <div class="validation">
                <?php
                    if(isset($_GET['error'])){
                        if($_GET['error'] =="Emptyspace"){
                            echo '<span>There an Empty Space</span>';
                        }
                        if($_GET['error'] =="Invalid_Email"){
                            echo '<span>The Email Is Invalid</span>';
                        }
                        if($_GET['error'] =="Invalid_username"){
                            echo '<span>Invalid Username</span>';
                        }
                        if($_GET['error'] =="Shorten"){
                            echo '<span>The Password Must be 8-16</span>';
                        }
                        if($_GET['error'] =="UpperCase"){
                            echo '<span>Password Must Have A Uppercase</span>';
                        }
                        if($_GET['error'] =="Lowercase"){
                            echo '<span>Password Must Have A Lowercase</span>';
                        }
                        if($_GET['error'] =="Special_Character"){
                            echo '<span>There an Empty Space</span>';
                        }
                        if($_GET['error'] =="Similar"){
                            echo '<span>The Password Is Not The Same</span>';
                        }
                        if($_GET['error'] == 'user_exist'){
                            echo '<span>User Is already Exist</span>';
                        }
                        if($_GET['error'] =='email_exsit'){
                            echo '<span>Email is already Exist</span>';
                        }
                        if($_GET['Accept'] =='Success'){
                            echo '<span>Sign Up Successfull';
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