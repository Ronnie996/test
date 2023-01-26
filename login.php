<?php
session_start();
$username = $_POST["username"];
$password = $_POST["password"];

$conn = mysqli_connect("localhost", "root", "", "test");

$query = "SELECT * FROM users WHERE name='$username' AND password='$password'";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['user_id'] = $row['user_ID'];
        
    }
    // redirect the user to the upload page
   header("Location: upload.php");
} else {
    echo "Invalid login credentials.";
}

mysqli_close($conn);
?>