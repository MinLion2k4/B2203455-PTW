<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlsv";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM student";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Cach 1
    // print_r($result);
    // echo '<br>';
    // echo '<br>';

    // Cach 2
    // while ($row = $result->fetch_assoc()) {
    //     echo "id: " . $row["id"] . " - Hoten: " . $row["fullname"] . " " .
    //         $row["email"] . ' ngaysinh: ' . $row['Birthday'] . "<br>";
    // }
    // echo '<br>';
    // echo '<br>';

    // Cach 3
    // $result = $conn->query($sql);
    // $result_all = $result->fetch_all();
    // print_r($result_all);

    // echo "<table border=1><tr><th>ID</th><th>Hoten</th><th>email</th><th>ngaysinh</th></tr>";

    // foreach ($result_all as $row) {

    //     $date = date_create($row[3]);

    //     echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] .
    //         "</td><td>" . $row[2] . "</td><td>" . $date->format('d-m-Y') . "</td></tr>";
    // }
    // echo "</table>";

    // Cach 4
    // echo "Cach 4: Dung fetch_array()" . "<br>";
    // while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    //     echo "id: " . $row["id"] . " - Hoten: " . $row["fullname"] . " " .
    //         $row["email"] . ' ngaysinh: ' . $row['Birthday'] . "<br>";
    // }
    // echo '<br>';
    // echo '<br>';

    // Cach 5
    echo "Cach 5: Dung fetch_object()" . "<br>";

    $result_all = [];

    while ($row = $result->fetch_object()) {
        $result_all[] = $row;
    }

    echo "<table border=1><tr><th>ID</th><th>Hoten</th><th>email</th><th>ngaysinh</th></tr>";
    foreach ($result_all as $row) {
        $date = date_create($row->Birthday);
    
        echo "<tr><td>" . $row->id . "</td><td>" . $row->fullname .
            "</td><td>" . $row->email . "</td><td>" . $date->format('d-m-Y') . "</td></tr>";
    }
    echo "</table>";

}

$conn->close();
?>