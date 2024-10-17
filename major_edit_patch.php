<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlsv";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
$sql = "UPDATE major SET name_major = '" . $_POST['name_major'] . "' WHERE id = '" . $id . "'";

if ($conn->query($sql) == TRUE) {
    header('Location: major_index.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

?>