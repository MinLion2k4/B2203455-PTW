<!DOCTYPE HTML>
<html>
<head>
    <title>Cập Nhật Thông Tin Sinh Viên</title>
</head>
<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "qlsv";

    // Kết nối đến cơ sở dữ liệu
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Lấy ID từ POST
    $id = $_POST['id'];

    // Truy vấn thông tin sinh viên
    $sql = "SELECT * FROM student WHERE id='" . $id . "'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    // Truy vấn danh sách chuyên ngành
    $sqlMajor = "SELECT * FROM major";
    $resultMajor = $conn->query($sqlMajor);
    ?>

    <h1>Cập Nhật Thông Tin Sinh Viên</h1>
    <form action="sua.php" method="post">
        ID: <input type="text" name="id" value="<?php echo htmlspecialchars($row['id']); ?>" readonly><br>
        Name: <input type="text" name="fullname" value="<?php echo htmlspecialchars($row['fullname']); ?>"><br>
        E-mail: <input type="text" name="email" value="<?php echo htmlspecialchars($row['email']); ?>"><br>
        Birthday: <input type="date" name="birth" value="<?php echo htmlspecialchars($row['Birthday']); ?>"><br>
        
        <label for="major">Chọn Chuyên Ngành:</label>
        <select id="major" name="major_id" required>
            <option value="">Chọn chuyên ngành</option>
            <?php

            while ($major = $resultMajor->fetch_assoc()) {
                $selected = ($row['major_id'] == $major['id']) ? 'selected' : '';
                echo "<option value='" . $major["id"] . "' $selected>" . $major["name_major"] . "</option>";
            }
            ?>
        </select><br>
        
        <input type="submit" value="Cập Nhật">
    </form>

    <?php

    $conn->close();
    ?>
</body>
</html>
