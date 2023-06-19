<?php
require("db.php");
$db = Database();

$books = [];

if (isset($_GET['submit'])) {
    $bookName = $_GET['bookName'];
    $category = $_GET['category'];
    $query = $db->prepare("SELECT * FROM books WHERE LOWER(bookName) LIKE LOWER(:bookName) AND LOWER(category) LIKE LOWER(:category)");
    $query->bindValue("bookName", '%' . $bookName . '%');
    $query->bindValue("category", '%' . $category . '%');
    $query->execute();
    $books = [];
    $books = $query->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filter Books</title>
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

   <div class="filter-container">
   <div class="filter-container">
        <form class="search-container"action="filterBooks.php" method="get">
            <h1>Filter Books</h1>
            <input class="form-control" type="text" name="bookName" placeholder="Book Name">
            <input class="form-control" type="text" name="category" placeholder="Category">
            <input id="submit" class="form-control bg-success text-light" type="submit" name="submit" value="Filter">
        </form>
        <div class="result-container">
        <?php
        foreach ($books as $book) {
            echo '<div class="book">';
            echo '<div class="book-details">';
            echo '<h2 id="book-name">' . $book['bookName'] . '</h2>';
            echo '<p>Category: ' . $book['category'] . '</p>';
            echo '</div>';
            echo '</div>';
        }
        ?>
        </div>
    </div>

   </div>
</body>

</html>
