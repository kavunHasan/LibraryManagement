<?php
session_start();
require("db.php");
$db = Database();

// get reserved books from database which reserved by user and show them

$query = $db->prepare("SELECT * FROM reservedBooks WHERE userid = :id");
$query->bindParam("id", $_SESSION["id"]);
$query->execute();
$reservedBooks = $query->fetchAll(PDO::FETCH_ASSOC);
$bookIds = array();
$bookDetails = [];
$books =[];
foreach($reservedBooks as $book){
    array_push($bookIds, $book["bookid"]);
}

if(count($bookIds) >0){
    $query = $db->prepare("SELECT * FROM books WHERE id IN (".implode(',',$bookIds).")");
    $query->execute();
    $books = $query->fetchAll(PDO::FETCH_ASSOC);
}

// get books from database which id is in bookIds array and show them


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

   

    <div class="reserved-book-container">
        
    <h1 class="reserved-book-page-h1">Reserved Books </h1>
    <?php if(count($books) == 0) echo "No Record!"; ?>
<?php foreach($books as $book): ?>
    
    <div class="book">
        <svg width="100px" height="100px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M0 96C0 43 43 0 96 0h96V190.7c0 13.4 15.5 20.9 26 12.5L272 160l54 43.2c10.5 8.4 26 .9 26-12.5V0h32 32c17.7 0 32 14.3 32 32V352c0 17.7-14.3 32-32 32v64c17.7 0 32 14.3 32 32s-14.3 32-32 32H384 96c-53 0-96-43-96-96V96zM64 416c0 17.7 14.3 32 32 32H352V384H96c-17.7 0-32 14.3-32 32z"/></svg>
        <div class="book-details">
            <div id="book-name">
                Book Name : <?php echo $book["bookName"] ?> 
            </div>
            <div class="book-isbn">
                ISBN: <?php echo $book["isbn"] ?> 
            </div>
            <div class="book-category">
                Category: <?php echo $book["category"] ?> 
            </div>
            <div class="book-penalty">
                Penalty: <?php

                for($i = 0; $i < count($reservedBooks); $i++){
                    if($reservedBooks[$i]["bookid"] == $book["id"]){
                    
                        $date1 = date_create($reservedBooks[$i]["endDate"]);
                        $date2 = date_create(date("Y-m-d"));
                        // if date1 > date2 then penalty is 0 otherwise penalty is calculated value 

                        if($date1 > $date2){
                            echo "0";
                        }else{
                            $diff = date_diff($date1,$date2);
                            $days = $diff->format("%a");
                            $penalty = $days * 0.5;
                            echo $penalty."$";
                        }
                    }
                }
               
                ?> 
            </div>
            <div class="index-book-operations">
                <a href="<?php echo '/leaveBook.php?id='.$book["id"].'' ?>" class="btn btn-danger">
                    Leave
                </a>
            </div>
        </div>
    </div>
   
<?php endforeach; ?>
</div>
    
</body>
    </html>