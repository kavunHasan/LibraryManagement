<?php
session_start();
require("db.php");
$db = Database();
// get logined user details from database and show them in table format
//  WHERE id = :id
$query = $db->prepare("SELECT * FROM users WHERE id = :id");
$query->bindParam("id", $_SESSION['id']);
$query->execute();
$user = $query->fetch(PDO::FETCH_ASSOC);

if($_SERVER["REQUEST_METHOD"] == "POST"){
   // name, surname, studentId, username, password, phoneNumber
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $studentId = $_POST['studentId'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $phoneNumber = $_POST['phoneNumber'];
    $query = $db->prepare("UPDATE users SET name = :name, surname = :surname, studentId = :studentId, username = :username, password = :password, phoneNumber = :phoneNumber WHERE id = :id");
    $query->bindParam("name", $name);
    $query->bindParam("surname", $surname);
    $query->bindParam("studentId", $studentId);
    $query->bindParam("username", $username);
    $query->bindParam("password", $password);
    $query->bindParam("phoneNumber", $phoneNumber);
    $query->bindParam("id", $_SESSION['id']);
    $query->execute();
    header("Location: index.php"); 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="navbar">

    <div class="logo-text">
        <a href="/index.php">Library Management System</a>
    </div>
    <div class="navbar-links">
            <div class="navbar-link">
                <a href="/addBook.php">Add Book</a>
            </div>
            <div class="navbar-link">
                <a href="/user.php">User</a>
            </div>
            <div class="navbar-link">
                <a href="/filterBooks.php">Filter Books</a>
            </div>
            <div class="navbar-link">
                <a href="/showReservedBooks.php">Reserved Books</a>
            </div>
            <div class="navbar-link">
                <a href="/editProfile.php">Edit Profile</a>
            </div>
            <div class="navbar-link">
                <a href="/logout.php">Logout</a>
            </div>
            
        </div>

</div>
<div class="show-user-container">
    <h1>User Details</h1>
    <form action="editProfile.php" method="POST">
        <div class="user-info">
            <div>Username: <input type="text" name="username" value="<?php echo $user["username"] ?>" /></div>
            <div>Password:  <input type="text" name="password" value="<?php echo $user["password"] ?>" /></div>
            <div>Student ID:  <input type="text" name="studentId" value="<?php echo $user["studentId"] ?>" /></div>
            <div>Name:  <input type="text" name="name" value="<?php echo $user["name"] ?>" /></div>
            <div>Surname:  <input type="text" name="surname" value="<?php echo $user["surname"] ?>" /></div>
            <div>Phone Number:  <input type="text" name="phoneNumber" value="<?php echo $user["phoneNumber"] ?>" /></div>
            <input class="btn btn-outline-danger" type="submit" value="Update!" />

        </div>
    </form>
    

</div>


    
</body>
</html>
