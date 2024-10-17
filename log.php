<?php
session_start(); // Bắt đầu session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlbanhang";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $pass = md5($_POST["pass"]);

    // Sử dụng prepared statements để tránh SQL Injection
    $stmt = $conn->prepare("SELECT fullname, email, id FROM customers WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Dang nhap thanh cong";
        $row = $result->fetch_assoc();
        
        // Lưu thông tin người dùng vào session
        $_SESSION["user"] = $row["email"];
        $_SESSION["fullname"] = $row["fullname"];
        $_SESSION["id"] = $row["id"];
        
        header('Location: homepage.php');
    } else {
        echo "Error: Invalid email or password.";
        header('Refresh: 3; URL=login.php');
    }

    $stmt->close();
}

$conn->close();
?>