<?php
session_start();
require("db.php");
$error = false;
$db = Database();

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = $db->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
    $query->bindParam("username", $username);
    $query->bindParam("password", $password);
    $query->execute();
    if($query->rowCount() > 0){
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $_SESSION['id'] = $row['id'];
            header("Location: index.php");
        }
        $_SESSION['id'] = $query['id'];
        header("Location: index.php");
    }
    else{
        $error = true;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="login.php" method="post">
        <h1>Library Management System</h1>
        <input class="form-control" type="text" name="username" placeholder="Username">
        <input class="form-control" type="password" name="password" placeholder="Password">
        <input id="submit" class="form-control" type="submit" name="submit" value="Login">
        <?php if($error){echo '<span id="login-error">Invalid username or password</span>';} ?>
        <a class="btn btn-lg bg-warning text-light" href="/register.php">Register</a>
      </form>    
</body>
</html>


