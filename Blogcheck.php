<?php

//php code to verify if the user is logged in when accessing the blog page from an external page. 

session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location: Blog.php");
    exit();
} else {
    header("Location: viewBlog.php");
    exit();
}
?>