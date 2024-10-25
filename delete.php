<?php 
include './connect.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM accounts WHERE account_id = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
}
if(isset($_POST['delete'])){
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "DELETE FROM accounts WHERE account_id = ?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $sql = "INSERT INTO logs (username, status,timestamp) VALUES ('$username', 'user_deleted',NOW())";
        $conn->query($sql);
        header("Location: adminPage.php?delete=success");
    }
}
if(isset($_POST['cancel'])){
    header("Location: adminPage.php");

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
<body class="vh-100 w-100 d-flex justify-content-center align-items-center" >
    <form class="container d-flex justify-content-center align-items-center flex-column" method="POST">
        <h1>Are you sure you want to delete userame <span class="text-primary" ><?php echo $row['account_username'] ?> </span></h1>
        <div>
            
    <input type="submit" class="btn btn-danger" name="delete" value="Delete">
    <input type="submit" class="btn btn-secondary" name="cancel" value="Cancel">
        </div>
</form>
</body>
</html>