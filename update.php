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

    if(!$result){
        die('SQL FAILED: ');
    }
    else{
        $row = mysqli_fetch_assoc($result);
    }
}
?>

<?php 
    if(isset($_POST['submit'])){

        if(isset($_GET['id_new'])){
            $idnew = $_GET['id_new'];
        }

        $username = $_POST['username'];
        $email = $_POST['email'];

        $sql = "UPDATE accounts SET account_username = ?, account_email = ? WHERE account_id = ?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, 'ssi', $username, $email, $idnew);
        mysqli_stmt_execute($stmt);
        
        if(!isset($_POST['my_checkbox'])){
        $sql = "UPDATE accounts SET locked = 0 WHERE account_id = ?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $idnew);
        mysqli_stmt_execute($stmt);
    }
        else{
            $sql = "UPDATE accounts SET locked = 2 WHERE account_id = ?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $idnew);
        mysqli_stmt_execute($stmt);
    }
    $sql = "INSERT INTO logs (username, status,timestamp) VALUES ('$username', 'user_updated',NOW())";
    $conn->query($sql);
    header("Location: adminPage.php?update=success");

    }
    else if(isset($_POST['cancel'])){
        header("Location: adminPage.php");

    }
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<div class="container" >
<div class="row mt-5">
<div class="col">


<form action="update.php?id_new=<?php echo $id ?>" method="POST">
<div class="form-group" >
    <label for="username">Username: </label>
    <input type="text" name="username" class="form-control" value="<?php echo $row['account_username']; ?>">
    <label for="username">Email: </label>
    <input type="text" name="email" class="form-control" value="<?php echo $row['account_email']; ?>">
    <label for="username">Locked: </label>
    <input type="checkbox" name="my_checkbox" value="1" 
    <?php if ($row['locked'] == 2) echo 'checked'; ?>>
</div>
<input type="submit" class="btn btn-success" name="submit" value="UPDATE">
<input type="submit" class="btn btn-secondary" name="cancel" value="CANCEL">
</form>
    
</div>
</div>
</div>
