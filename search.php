<?php

$servername = "127.0.0.1:3306";
$username = "root";
$password = "";
$dbname = "some_db";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$searchText = $_GET['search'];


$sql = "SELECT posts.title, comments.body FROM posts INNER JOIN comments ON posts.id = comments.postId WHERE comments.body LIKE '%$searchText%'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<p><strong>Заголовок записи:</strong> " . $row["title"] . "<br><strong>Комментарий:</strong> " . $row["body"] . "</p>";
    }
} else {
    echo "Ничего не найдено";
}


$conn->close();
?>
