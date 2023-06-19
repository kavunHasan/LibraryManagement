<?php
require("db.php");

$db = Database();

// bookName isbn category
// first get book id from url and show data in input fields

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = $db->prepare("SELECT * FROM books WHERE id = :id");
    $query->bindParam("id", $id);
    $query->execute();
    $book = $query->fetch(PDO::FETCH_ASSOC);
}

// update book data

if(isset($_POST['submit'])){
    $bookName = $_POST['bookName'];
    $isbn = $_POST['isbn'];
    $category = $_POST['category'];
    $query = $db->prepare("UPDATE books SET bookName = :bookName, isbn = :isbn, category = :category WHERE id = :id");
    $query->bindParam("bookName", $bookName);
    $query->bindParam("isbn", $isbn);
    $query->bindParam("category", $category);
    $query->bindParam("id", $id);
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


    <form action="editBook.php?id=<?php echo $book['id']; ?>" method="post">
        <h1>Kitap Edit</h1>
        <input class="form-control" type="text" name="bookName" placeholder="Book Name" value="<?php echo $book['bookName']; ?>">
        <input class="form-control" type="text" name="isbn" placeholder="ISBN" value="<?php echo $book['isbn']; ?>">
        <input class="form-control" type="text" name="category" placeholder="Category" value="<?php echo $book['category']; ?>">
        <input class="form-control bg-success text-light" type="submit" name="submit" value="Update Book">
    </form>

</body>
</html>
