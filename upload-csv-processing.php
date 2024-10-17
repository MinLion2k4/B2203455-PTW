<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Kiểm tra xem biểu mẫu đã được gửi chưa
if (isset($_POST["submit"])) {
    // Kiểm tra loại tệp
    if ($fileType != "csv") {
        echo "Chỉ chấp nhận các file CSV.";
        $uploadOk = 0;
    }

    // Kiểm tra xem $uploadOk có được đặt thành 0 bởi lỗi nào không
    if ($uploadOk == 0) {
        echo "File của bạn không được upload.";
    // Nếu mọi thứ đều ổn, cố gắng upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "File ". htmlspecialchars(basename($_FILES["fileToUpload"]["name"])). " đã được upload.";
            // Gọi hàm xử lý file CSV
            processCSV($target_file);
        } else {
            echo "Có lỗi xảy ra khi upload file của bạn.";
        }
    }
}

// Hàm xử lý file CSV
function processCSV($file) {
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

    // Đọc file CSV
    if (($handle = fopen($file, "r")) !== FALSE) {
        // Bỏ qua dòng tiêu đề
        fgetcsv($handle, 1000, ",");

        // Đọc từng dòng của file CSV
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $fullname = $data[0];
            $email = $data[1];
            $password = md5($data[2]); // Băm mật khẩu với md5

            // Chèn dữ liệu vào bảng customers
            $stmt = $conn->prepare("INSERT INTO customers (fullname, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $fullname, $email, $password);
            $stmt->execute();
        }
        fclose($handle);
    }

    $conn->close();
}
?>