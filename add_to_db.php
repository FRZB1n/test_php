<?php

$servername = "127.0.0.1:3306";
$username = "root";
$password = "";
$dbname = "some_db";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$data = file_get_contents('https://jsonplaceholder.typicode.com/posts');
$posts = json_decode($data, true);

$data = file_get_contents('https://jsonplaceholder.typicode.com/comments');
$comments = json_decode($data, true);


foreach ($posts as $post) {
    $sql = "INSERT INTO posts (userId, title, body) VALUES ('".$post['userId']."', '".$post['title']."', '".$post['body']."')";
    $conn->query($sql);
}


foreach ($comments as $comment) {
    $sql = "INSERT INTO comments (postId, name, email, body) VALUES ('".$comment['postId']."', '".$comment['name']."', '".$comment['email']."', '".$comment['body']."')";
    $conn->query($sql);
}


echo "Загружено " . count($posts) . " записей и " . count($comments) . " комментариев";


$conn->close();
?>
