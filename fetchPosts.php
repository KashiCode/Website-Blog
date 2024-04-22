<?php

//php code to fetch blog posts from the database for use with the preview function. 

$servername = "localhost";
$username = "Maks";
$dbpassword = "O5p48]avsY].Zq!U";
$dbname = "maks";
$conn = new mysqli($servername, $username, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT title, post_content, publish_date FROM post ORDER BY publish_date DESC";
$result = $conn->query($sql);
$postsHtml = '';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $postsHtml .= '<div class="blog-posts__item">';
        $postsHtml .= '<h3>' . htmlspecialchars($row["title"]) . ' - ' . htmlspecialchars($row["publish_date"]) . '</h3>';
        $postsHtml .= '<p>' . nl2br(htmlspecialchars($row["post_content"])) . '</p>';
        $postsHtml .= '</div>';
    }
} else {
    $postsHtml .= '<div class="blog-posts__item">No blog posts found.</div>';
}
$conn->close();

echo $postsHtml;
?>