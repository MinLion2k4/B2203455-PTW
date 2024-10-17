<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlsv";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$date = date_create($_POST["birth"]);


$sql = "INSERT INTO student (fullname, email, birthday, major_id) VALUES (?, ?, ?, ?)";


$stmt = $conn->prepare($sql);


$fullname = $_POST["name"];
$email = $_POST["email"];
$birthday = $date->format('Y-m-d');
$major_id = $_POST["major_id"];


$stmt->bind_param("sssi", $fullname, $email, $birthday, $major_id);

if ($stmt->execute()) {
    echo "Thêm sinh viên thành công";
    header('Location: taidulieu_bang.php');
} else {
    echo "Lỗi: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>