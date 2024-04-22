<?php

// Code to add the title, post content, and publish date to the database. 

session_start();

$servername = "localhost";
$username = "Maks";
$dbpassword = "O5p48]avsY].Zq!U";
$dbname = "maks";


if (!isset($_SESSION['user_email'])) {
    header("Location: Login.html");
    exit();
}


$conn = new mysqli($servername, $username, $dbpassword, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $conn->real_escape_string($_POST['title']);
    $post_content = $conn->real_escape_string($_POST['post_content']);
    
    // Prepare an insert statement
    $sql = "INSERT INTO post (title, post_content) VALUES (?, ?)";
    
    if ($stmt = $conn->prepare($sql)) {

        $stmt->bind_param("ss", $title, $post_content);
        

        if ($stmt->execute()) {

            header("Location: viewBlog.php");
            exit();
        } else {
            echo "ERROR: Could not execute query: $sql. " . $conn->error;
        }
        
        // Close statement
        $stmt->close();
    } else {
        echo "ERROR: Could not prepare query: $sql. " . $conn->error;
    }
} else {

    header("Location: AddPost.html"); 
}


$conn->close();
?>