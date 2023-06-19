<?php
require("db.php");
$db = Database();

// username password studentid name surname phoneNumber

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $studentid = $_POST['studentid'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $phoneNumber = $_POST['phoneNumber'];
    $query = $db->prepare("INSERT INTO users (username, password, studentid, name, surname, phoneNumber) VALUES (:username, :password, :studentid, :name, :surname, :phoneNumber)");
    $query->bindParam("username", $username);
    $query->bindParam("password", $password);
    $query->bindParam("studentid", $studentid);
    $query->bindParam("name", $name);
    $query->bindParam("surname", $surname);
    $query->bindParam("phoneNumber", $phoneNumber);
    $query->execute();
    header("Location: login.php");
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
<div class="navbar">

<div class="logo-text">
    <a href="/index.php">Library Management System</a>
</div>
<div class="navbar-links">
    
</div>

</div>

    <form action="register.php" method="post">
        <h1>Register</h1>
        <input class="form-control" type="text" name="username" placeholder="Username">
        <input class="form-control" type="password" name="password" placeholder="Password">
        <input class="form-control" type="text" name="studentid" placeholder="Student ID">
        <input class="form-control" type="text" name="name" placeholder="Name">
        <input class="form-control" type="text" name="surname" placeholder="Surname">
        <input class="form-control" type="text" name="phoneNumber" placeholder="Phone Number">
        <input class="form-control bg-success text-light" type="submit" name="submit" value="Register">
    </form>

</body>
</html>
