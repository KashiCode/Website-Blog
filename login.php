<?php

// php code to log a user into the website. 


session_start(); 

$servername = "localhost";
$username = "Maks";
$dbpassword = "O5p48]avsY].Zq!U";
$dbname = "maks"; 

// COMPLETED
$conn = new mysqli($servername, $username, $dbpassword, $dbname);


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

  $email = $_POST['email'];
  $password = $_POST['password'];
 
  $sql = "SELECT email, password FROM user WHERE email = '$email' AND password = '$password'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {

    $_SESSION['user_email'] = $email; 
    
    header("Location: Addpost.html");
    exit();
  } else {
    header("Location: Login.html?error=invalid");
    exit();
  }

$conn->close();
?>
