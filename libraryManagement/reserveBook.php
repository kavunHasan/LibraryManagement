<?php
session_start();
require("db.php");
$db = Database();

$query = $db->prepare("SELECT bookid,endDate from  reservedBooks where bookid = :bookid");
$query->bindParam("bookid", $_GET["id"]);
$query->execute();
$book = $query->fetch(PDO::FETCH_ASSOC);
if($book){

    echo '
    
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
        <div class="already-reserved-container"> 
            <h1>Kitap '.$book['endDate'].' tarihine kadar rezerve edilmistir</h1>
        </div>
      
    </body>
    </html>
    
    ';
   
}
else{
    // get book id from url and get reserve end date from user and update database
    if(isset($_POST['submit']) ){
        echo "istek alindi";
        $query = $db->prepare("INSERT INTO reservedBooks(bookid, userid,endDate) VALUES(:bookid, :userid, :endDate)");
        $query->bindParam("bookid", $_POST["id"]);
        $query->bindParam("userid",$_SESSION["id"]);
        $query->bindParam("endDate", $_POST['endDate']);
        $query->execute();
        header("Location: index.php");
    }

    echo '
    
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
                <a href="/addBook.php">Reserved Books</a>
            </div>
            <div class="navbar-link">
                <a href="/logout.php">Logout</a>
            </div>
                
        </div>
        <form action="reserveBook.php" method="post">
            <h1 style="color: black;">Rezervasyon Teslim Tarihi</h1>
            <input class="form-control " type="date" name="endDate" placeholder="Rezervasyon Teslim Tarihi">
            <input class="form-control " type="hidden" name="id" value="'.$_GET["id"].'">
            <input class="form-control bg-success text-light" type="submit" name="submit" value="Reserve">
        </form>
    </body>
    </html>
    ';

}


