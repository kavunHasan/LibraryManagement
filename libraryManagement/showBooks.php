<?php
require("db.php");
$db = Database();

// show all books 

$query = $db->prepare("SELECT * FROM books");
$query->execute();
$books = $query->fetchAll(PDO::FETCH_ASSOC);

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
</head>
<body>

    <h1>Library Management System</h1>
    <a href="addBook.php">Add Book</a>
    <table>
        <thead>
            <tr>
                <th>Book Name</th>
                <th>ISBN</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($books as $book): ?>
            <tr>
                <td><?php echo $book['bookName']; ?></td>
                <td><?php echo $book['isbn']; ?></td>
                <td><?php echo $book['category']; ?></td>
                <td>
                    <a href="editBook.php?id=<?php echo $book['id']; ?>">Edit</a>
                    <a href="removeBook.php?id=<?php echo $book['id']; ?>">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
                
</body>
</html>


