<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
        }
    </style>
</head>
<body>

<h2>Library Management System</h2>

<!-- Form to insert/update book -->
<form method="POST" action="index.php">
    <label>Book Name:</label>
    <input type="text" name="book_name" required><br><br>
    
    <label>ISBN No:</label>
    <input type="text" name="isbn_no" required><br><br>
    
    <label>Book Title:</label>
    <input type="text" name="book_title" required><br><br>
    
    <label>Author Name:</label>
    <input type="text" name="author_name" required><br><br>
    
    <label>Publisher Name:</label>
    <input type="text" name="publisher_name" required><br><br>
    
    <input type="submit" name="insert" value="Insert Book">
    <input type="submit" name="update" value="Update Book">
</form>

<hr>

<!-- Form to delete book by ISBN -->
<form method="POST" action="index.php">
    <label>Enter ISBN No to Delete:</label>
    <input type="text" name="isbn_to_delete" required>
    <input type="submit" name="delete" value="Delete Book">
</form>

<hr>

<!-- Form to search book by ISBN -->
<form method="POST" action="index.php">
    <label>Enter ISBN No to Search:</label>
    <input type="text" name="isbn_to_search" required>
    <input type="submit" name="search" value="Search Book">
</form>

<hr>

<!-- Display Book Records -->
<h2>Book Records</h2>
<?php
include 'db_connect.php';

// Insert Book Details
if (isset($_POST['insert'])) {
    $book_name = $_POST['book_name'];
    $isbn_no = $_POST['isbn_no'];
    $book_title = $_POST['book_title'];
    $author_name = $_POST['author_name'];
    $publisher_name = $_POST['publisher_name'];

    // Basic form validation
    if (!empty($book_name) && !empty($isbn_no) && !empty($book_title) && !empty($author_name) && !empty($publisher_name)) {
        $sql = "INSERT INTO books (book_name, isbn_no, book_title, author_name, publisher_name) 
                VALUES ('$book_name', '$isbn_no', '$book_title', '$author_name', '$publisher_name')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New book added successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "All fields are required.";
    }
}

// Update Book Details
if (isset($_POST['update'])) {
    $book_name = $_POST['book_name'];
    $isbn_no = $_POST['isbn_no'];
    $book_title = $_POST['book_title'];
    $author_name = $_POST['author_name'];
    $publisher_name = $_POST['publisher_name'];

    // Basic form validation
    if (!empty($book_name) && !empty($isbn_no) && !empty($book_title) && !empty($author_name) && !empty($publisher_name)) {
        $sql = "UPDATE books SET book_name='$book_name', book_title='$book_title', author_name='$author_name', publisher_name='$publisher_name' 
                WHERE isbn_no='$isbn_no'";
        
        if ($conn->query($sql) === TRUE) {
            echo "Book details updated successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "All fields are required.";
    }
}

// Delete Book
if (isset($_POST['delete'])) {
    $isbn_no = $_POST['isbn_to_delete'];

    $sql = "DELETE FROM books WHERE isbn_no='$isbn_no'";
    if ($conn->query($sql) === TRUE) {
        echo "Book deleted successfully.";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Search Book
if (isset($_POST['search'])) {
    $isbn_no = $_POST['isbn_to_search'];

    $sql = "SELECT * FROM books WHERE isbn_no='$isbn_no'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Book Name</th><th>ISBN No</th><th>Book Title</th><th>Author Name</th><th>Publisher Name</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["id"]."</td><td>".$row["book_name"]."</td><td>".$row["isbn_no"]."</td><td>".$row["book_title"]."</td><td>".$row["author_name"]."</td><td>".$row["publisher_name"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No book found with ISBN: $isbn_no.";
    }
}

// Display All Books
$sql = "SELECT * FROM books";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Book Name</th><th>ISBN No</th><th>Book Title</th><th>Author Name</th><th>Publisher Name</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["book_name"]."</td><td>".$row["isbn_no"]."</td><td>".$row["book_title"]."</td><td>".$row["author_name"]."</td><td>".$row["publisher_name"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "No records found.";
}

$conn->close();
?>

</body>
</html>
