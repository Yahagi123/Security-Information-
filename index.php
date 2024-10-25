<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Arima:wght@100..700&display=swap" rel="stylesheet">
    <title>Sign Up </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Sign IN Form  -->
     <div class="box_container">
        <form action="index_action.php" method="post">
        <div class="valid-container">
    <?php 
        if(isset($_GET['error'])){
            if($_GET['error'] == 'Field-is-required'){
                echo '<span>Field is empty</span>';
            }
            else if($_GET['error'] == 'wrong-password'){
                echo '<span>Wrong password</span>';
            }
            else if($_GET['error'] == 'tempo_locked'){
                echo '<span>tempo locked</span>';
            }
            else if($_GET['error'] == 'account_locked'){
                echo '<span>Account locked</span>';
            }
        }

    ?>
</div>
            <h2>Sign In</h2>

            <div class="container">
                <label for="Username">Usernname</label>
                <input type="text" name="username" id="username" placeholder="Username" required>
            </div>
            <div class="container">
                <label for="Password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" required>
            </div>
            <div class="submit">
            <input type="submit" value="Sign In" name="signin" id="signin">

            </div>
            
        </form>

     </div>
</body>
</html>
<div class="valid-container">
    <?php 
        if(isset($_GET['error'])){
            if($_GET['error'] == 'Field-is-required'){
                echo '<span>Field is empty</span>';
            }
            else if($_GET['error'] == 'wrong-password'){
                echo '<span>Wrong password</span>';
            }
            else if($_GET['error'] == 'tempo_locked'){
                echo '<span>tempo locked</span>';
            }
            else if($_GET['error'] == 'account_locked'){
                echo '<span>Account locked</span>';
            }
        }

    ?>
</div>