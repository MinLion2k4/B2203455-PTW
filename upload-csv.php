<!DOCTYPE html>
<html>
<head>
    <title>Upload CSV File</title>
</head>
<body>

<h2>Upload CSV File</h2>
<form action="upload-csv-processing.php" method="post" enctype="multipart/form-data">
    Chọn tệp CSV để tải lên:
    <input type="file" name="fileToUpload" id="fileToUpload" accept=".csv">
    <br><br>
    <input type="submit" value="Upload CSV" name="submit">
</form>

</body>
</html>
