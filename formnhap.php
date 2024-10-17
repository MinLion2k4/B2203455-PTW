<!DOCTYPE HTML>
<html>
<head>
    <title>Thêm Sinh Viên</title>
</head>
<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "qlsv";
    
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM major";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "
            <h1>Thêm Sinh Viên</h1>
            <form action='luu.php' method='post'>
                Name: <input type='text' name='name' required><br>
                E-mail: <input type='text' name='email' required><br>
                Birthday: <input type='date' name='birth' required><br>
                <label for='major'>Chọn Chuyên Ngành:</label>
                <select id='major' name='major_id' required>
                    <option value=''>Chọn chuyên ngành</option>
        ";

        while ($major = $result->fetch_assoc()) {
            echo "<option value='" . $major["id"] . "'>" . $major["name_major"] . "</option>";
        }

        echo "
                </select><br>
                <input type='submit' value='Thêm Sinh Viên'>
            </form>
        ";
    } else {
        echo "0 kết quả trả về";
    }

    // Đóng kết nối
    $conn->close();
    ?>
</body>
</html>
