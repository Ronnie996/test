<link rel="stylesheet" type="text/css" href="style.css">
<table>
  <tr>
    <th>File ID</th>
    <th>File Name</th>
    <th>Download</th>
  </tr>
  <?php
  //connect to the database
  $conn = mysqli_connect("localhost", "root", "", "test");
  $query = "SELECT * FROM doc";
  $result = mysqli_query($conn, $query);
  while ($row = mysqli_fetch_assoc($result)) {
    $file_id = $row["id"];
    $file_name = $row["file_name"];
    $file_path = $row["file_path"];
    $original_file_name = $row["file_name"];
    echo "<tr>";
    echo "<td>$file_id</td>";
    echo "<td>$file_name</td>";
    echo "<td><a href='$file_path' download='$original_file_name'>Download</a></td>";
    echo "</tr>";
}