<!DOCTYPE html>
<?php
$conn = new mysqli("localhost", "root", "", "fuga_songs");
if($conn->connect_error) die("连接失败:" . $conn->connect_error);
else echo "修改结果
<br />";



$conn->close();
?>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="author" content="Philip" />
    <meta name="keywords" content="Keywords" />
    <title>修改结果</title>
</head>
<body>

</body>
</html>
<script>

</script>