<?php

session_start();
$user_id = $_SESSION['user_id'];
$target_dir = "uploads/";
$file = $_FILES["file"];
$file_name = $file["name"];
$file_tmp = $file["tmp_name"];
$file_size = $file["size"];
$file_error = $file["error"];
$target_file = $target_dir . $file_name;

$file_ext = explode('.', $file_name);
$file_ext = strtolower(end($file_ext));

$allowed = array('pdf', 'doc', 'docx', 'txt');

if (in_array($file_ext, $allowed)) {
    if ($file_error === 0) {
        if ($file_size <= 2097152) {
            $file_name_new = uniqid('', true) . '.' . $file_ext;
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
               
               
            }else {

            $file_destination = 'uploads/' . $file_name ;
            if (move_uploaded_file($file_tmp, $file_destination)) {
                //connect to the database
                $conn = mysqli_connect("localhost", "root", "", "test");

                // generate a new id for the file based on a counter
                $query = "SELECT MAX(id) as max_id FROM doc";
                $result = mysqli_query($conn, $query);

                $row = mysqli_fetch_assoc($result);
                $max_id = $row["max_id"];

                $file_id = $max_id == NULL ? 1 : $max_id + 1;

                // insert the file information in the database
                $query = "INSERT INTO doc (id, file_name, file_size, file_ext, file_path, user_id) VALUES ('$file_id','$file_name', '$file_size', '$file_ext', '$file_destination', '$user_id')";
                mysqli_query($conn, $query);
                echo "File uploaded successfully!";
                mysqli_close($conn);
            }
        }
    }
    }
}
?>