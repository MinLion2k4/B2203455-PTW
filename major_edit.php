<!DOCTYPE HTML>
<html>
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
$sql = "select * FROM major WHERE id='" . $id . "'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

?>

<body>
    <form action="major_edit_patch.php" method="post">
        ID:<input type="text" name="id" value="<?php echo $row['id']; ?>"><br>
        Major name: <input type="text" name="name_major" value="<?php echo
            $row['name_major']; ?>"><br>
        <input type="submit">
    </form>
</body>

</html>