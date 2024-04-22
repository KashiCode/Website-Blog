<?php

// php to log a user out of the system. 

session_start(); 


$_SESSION = array();

session_destroy();


header("Location: Blog.php");
exit();
?>