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

        <form action="" method="post">
            <h2>Sign In</h2>

            <div class="container">
                <label for="Username">Username</label>
                <input type="text" name="username" id="username" placeholder="Username" required>
            </div>
            <div class="container">
                <label for="Email">Email Address</label>
                <input type="email" name="email" id="email">
            </div>
            <div class="container">
                <label for="Password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" required>
            </div>
            <div class="container">
                <label for="Password">Confirm Password</label>
                <input type="password" name="con_password" id="con_password" placeholder="Password" required>
            </div>
            <div class="submit">
                <input type="submit" value="Sign In" name="signin" id="signin">

            </div>
            
        </form>

     </div>
</body>
</html>