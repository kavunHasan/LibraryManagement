<?php 
require("db.php");
$db = Database();

// get book id from url and remove book from database

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = $db->prepare("DELETE FROM reservedBooks WHERE bookid = :id");
    $query->bindParam("id", $id);
    $query->execute();
    header("Location: index.php");
}