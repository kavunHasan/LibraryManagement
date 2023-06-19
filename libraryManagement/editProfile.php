<?php
session_start();
require("db.php");

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$message = '';
$db = Database();

$query = $db->prepare("SELECT * FROM users WHERE id = :id");
$query->execute([':id' => $_SESSION['id']]);
$user = $query->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $phoneNumber = $_POST['phoneNumber'];

    $query = $db->prepare("UPDATE users SET username = :username, name = :name, surname = :surname, phoneNumber = :phoneNumber WHERE id = :id");
    $result = $query->execute([
        ':username' => $username,
        ':name' => $name,
        ':surname' => $surname,
        ':phoneNumber' => $phoneNumber,
        ':id' => $_SESSION['id']
    ]);

    if ($result) {
        $message = "Profile updated successfully.";
    } else {
        $message = "Sorry, there was a problem updating your profile.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
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
    
    <div class="update-container">
        <form class="search-container" action="editProfile.php" method="post">
            <h1>Edit Profile</h1>
        <input class="form-control" type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>">
        <input class="form-control" type="text" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>">
        <input class="form-control" type="text" id="surname" name="surname" value="<?= htmlspecialchars($user['surname']) ?>">
        <input class="form-control" type="text" id="phoneNumber" name="phoneNumber" value="<?= htmlspecialchars($user['phoneNumber']) ?>">
            <input id="submit" class="form-control bg-success text-light" type="submit" value="Update Profile">
            <?php if (!empty($message)) : ?>
                <p id="login-error"><?= $message ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
