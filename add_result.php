<!DOCTYPE html>
<?php
$conn = new mysqli("localhost", "root", "", "fuga_songs");
if($conn->connect_error) die("连接失败:" . $conn->connect_error);
else echo "修改结果<br />";

#add properties: 


#add song

#add relation

$conn->close();
?>