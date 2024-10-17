<?php   
session_start(); // Bắt đầu session

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION["user"])) {
    header('Location: login.php');
    exit();
}

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
    $old_password = md5($_POST["old_password"]);
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];
    $user_id = $_SESSION["id"];

    // Kiểm tra mật khẩu cũ
    $stmt = $conn->prepare("SELECT password FROM customers WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row["password"] !== $old_password) {
        echo "Mật khẩu cũ không đúng.";
    } elseif ($new_password !== $confirm_password) {
        echo "Mật khẩu mới và xác nhận mật khẩu không khớp.";
    } elseif ($old_password === md5($new_password)) {
        echo "Mật khẩu mới không được giống mật khẩu cũ.";
    } else {
        // Cập nhật mật khẩu mới
        $new_password_hashed = md5($new_password);
        $stmt = $conn->prepare("UPDATE customers SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $new_password_hashed, $user_id);
        if ($stmt->execute()) {
            echo "Mật khẩu đã được cập nhật thành công.";
        } else {
            echo "Có lỗi xảy ra. Vui lòng thử lại.";
        }
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chỉnh sửa mật khẩu</title>
</head>
<body>
    <h2>Chỉnh sửa mật khẩu</h2>
    <form method="post" action="sua_mk.php">
        <label for="old_password">Mật khẩu cũ:</label><br>
        <input type="password" id="old_password" name="old_password" required><br><br>
        <label for="new_password">Mật khẩu mới:</label><br>
        <input type="password" id="new_password" name="new_password" required><br><br>
        <label for="confirm_password">Xác nhận mật khẩu mới:</label><br>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>
        <button type="submit">Cập nhật mật khẩu</button>
    </form>
</body>
</html>