<?php
require("db.php");
$db = Database();

// get book id from url and remove book from database

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = $db->prepare("DELETE FROM books WHERE id = :id");
    $query->bindParam("id", $id);
    $query->execute();
    header("Location: index.php");
}else{
    header("Location: index.php");
}
