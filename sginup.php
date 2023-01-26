<?php

$username = $_POST["username"];
$password = $_POST["password"];
$major = $_POST["major"];

$conn = mysqli_connect("localhost", "root", "", "test");

$query = "SELECT MAX(user_ID) as max_id FROM users";
echo "hi";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$max_id = $row["max_id"];

$new_id = $max_id + 1;

$query = "INSERT INTO users (user_ID,name, major, password) VALUES ('$new_id','$username', '$major', '$password')";
mysqli_query($conn, $query);

header("Location: index.php");

mysqli_close($conn);
?>