<?php

//php code to verify if the user is logged into the website. 

session_start();


if (!isset($_SESSION['user_email'])) {
    header("Location: Blog.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Maks Blog</title>
    <link rel="icon" type="image/x-icon" href="img/Image3.png">
</head>
<body>
    <nav>
      <div class="nav__content">
        <div class="logo"><a href="blog.php">Maks</a></div>
        <ul>
          <li><a href="Homepage.html">Home</a></li>
          <li><a href="AddPost.html">Add Post</a></li>
          <div class="action__btns">
            <a href= "logout.php" style="text-decoration: none; color: inherit;">
                <button class="MyCv">Logout</button>
            </a>
          </div>
        </ul>
      </div>
    </nav>
    <section class="blog-posts">
      <div class="blog-posts__container">
        <h2 class="blog-posts__title">Blog Posts</h2>
        <form action="" method="GET">
            <div class="month-selector">
                <label for="monthSelect" class="month-selectorlabel">Select Month:</label>
                <select id="monthSelect" name="monthSelect" class="month-selectorselect">
                    <option value="">--Please choose an option--</option>
                    <option value="January">January</option>
                    <option value="February">February</option>
                    <option value="March">March</option>
                    <option value="April">April</option>
                    <option value="May">May</option>
                    <option value="June">June</option>
                    <option value="July">July</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="October">October</option>
                    <option value="November">November</option>
                    <option value="December">December</option>
                </select>
                <input type="submit" value="Filter">
            </div>
        </form>
        <div class="blog-posts__content">
          <div class="blog-posts__item">
            <!-- PHP code to fetch and sort blog posts begins here -->
          <?php

$servername = "localhost";
$username = "Maks";
$dbpassword = "O5p48]avsY].Zq!U";
$dbname = "maks";


$conn = new mysqli($servername, $username, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$selectedMonth = isset($_GET['monthSelect']) ? $_GET['monthSelect'] : '';


$sql = "SELECT title, post_content, publish_date FROM post";
$result = $conn->query($sql);

$posts = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
}


function dateToTimestamp($date) {
    return strtotime($date);
}


$size = count($posts);
for ($i = 0; $i < $size - 1; $i++) {
    for ($j = 0; $j < $size - $i - 1; $j++) {
        if (dateToTimestamp($posts[$j]['publish_date']) < dateToTimestamp($posts[$j + 1]['publish_date'])) {
            $temp = $posts[$j];
            $posts[$j] = $posts[$j + 1];
            $posts[$j + 1] = $temp;
        }
    }
}


if ($selectedMonth) {
    $filteredPosts = array_filter($posts, function ($post) use ($selectedMonth) {
        $postMonth = date("F", strtotime($post['publish_date']));
        return $postMonth == $selectedMonth;
    });
} else {
    $filteredPosts = $posts;
}


if (count($filteredPosts) > 0) {
    foreach ($filteredPosts as $row) {
        echo '<div class="blog-posts__item">';
        echo '<h3>' . htmlspecialchars($row["title"]) . ' - ' . htmlspecialchars($row["publish_date"]) . '</h3>';
        echo '<p>' . nl2br(htmlspecialchars($row["post_content"])) . '</p>';
        echo '</div>';
    }
} else {
    $monthText = !empty($selectedMonth) ? " for $selectedMonth" : "";
    echo "<div class='blog-posts__item'>No blog posts found$monthText.</div>";
}


$conn->close();
?>

            
          </div>
        </div>
      </div>
    </section>
    <footer class="footer">
        <div class="footer__container">
          <div class="footer__content">
            <a href="https://github.com/KashiCode" class="footer__link">GitHub</a>
            <a href="mailto:ostrynskimaks@gmail.com" class="footer__link">Email</a>
            <a href="https://www.linkedin.com/in/maks-ostrynski-874720255/" class="footer__link">LinkedIn</a>
          </div>
          <p class="footer__copyright">&copy; 2024 Maks. All rights reserved.</p>
        </div>
      </footer>
</body>
</html>