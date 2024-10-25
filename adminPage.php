<?php
include "admin_action.php";

if(isset($_POST['logout'])){
    session_start();
    session_destroy();
    $username = $_SESSION['username'];
    $sql = "INSERT INTO logs (username, status,timestamp) VALUES ('$username', 'admin_logout',NOW())";
    $conn->query($sql);
    header("Location: index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-white pb-5" >
    <style>
        #space{
            left: 87%;
            position: absolute;
        }
    </style>

<div class="container" >
<div class="row mt-3">
    <form method="POST">
        <input type="submit" name="logout" class="btn btn-primary" value="Logout">

        <a href="SignUp.php" class="link-dark" id="space">SignUp</a>
    </form>
    
<div class="col">
<div class="card mt-3">
    <div class="card-header">
        <h2 class="display-4 text-center" >Users</h2>
    </div>
    <div class="card-body">
    <table class="table table-bordered text-center" >
    <tr>
        <td class="bg-white text-dark" >User ID</td>
        <td class="bg-white text-dark" >Username</td>
        <td class="bg-white text-dark" >Email</td>
        <td class="bg-white text-dark" >Role</td>
        <td class="bg-white text-dark" >Locked</td>
        <td class="bg-white text-dark" >Action</td>
    </tr>
    <tr>
        <?php
        while($row = mysqli_fetch_assoc($result)){
        
        ?>
        <td><?php echo $row['account_id'] ?></td>
        <td><?php echo $row['account_username'] ?></td>
        <td><?php echo $row['account_email'] ?></td>
        <td><?php echo $row['account_role'] ?></td>
        <td>
            <input type="checkbox" class="form-check-input border border-secondary" name="my_checkbox" value="1" disabled
            <?php if ($row['locked'] == 2) echo 'checked'; ?>>
        </td>
        <td><a href="update.php?id=<?php echo $row['account_id']; ?>" class="btn btn-primary" >Edit</a>
        <a href="delete.php?id=<?php echo $row['account_id']; ?>" class="btn btn-danger" >Delete</a>
    </td>
        <!--  -->
        </tr>
        <?php
        }
        ?>
</table>

    </div>
</div>
<div class="card mt-3">
    <div class="card-header">
        <h2 class="display-4 text-center" >Audit Logs</h2>
    </div>
    <div class="card-body">
    <table class="table table-bordered text-center" >
    <tr>
        <td class="bg-white text-dark" >User ID</td>
        <td class="bg-white text-dark" >Username</td>
        <td class="bg-white text-dark" >Status</td>
        <td class="bg-white text-dark" >Time</td>
    </tr>
    <tr>
        <?php
        while($row = mysqli_fetch_assoc($resultLogs)){
        
        ?>
        <td><?php echo $row['id'] ?></td>
        <td><?php echo $row['username'] ?></td>
        <td><?php echo $row['status'] ?></td>
        <td><?php echo $row['timestamp'] ?></td>
        <!--  -->
        </tr>
        <?php
        }
        ?>
</table>

    </div>
</div>
</div>
</div>
</div>

    
</body>
</html>