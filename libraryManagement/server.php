<?php
session_start();
require("db.php");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

// if user is logged in then show the showBook page otherwise show the login page

$db = Database();
$query = $db->prepare("SELECT * FROM books");
$query->execute();
$books = $query->fetchAll(PDO::FETCH_ASSOC); 

echo json_encode($books);