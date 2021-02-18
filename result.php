<!DOCTYPE html>
<?php
$conn = new mysqli("localhost", "root", "", "fuga_songs");
if($conn->connect_error) die("连接失败:" . $conn->connect_error);
else echo "查询结果<br />";

#query by name
if($_POST['songs'] != "请输入歌名" && $_POST['songs'] != ""){
    $res = $conn->query("SELECT * FROM songs WHERE songs =\"" .$_POST['songs'] . "\"")->fetch_assoc();
    if($res){
        echo $res['songs'] . "<br />"; #print the res
    }
    $conn->close();
    die();
}

$sql = 'SELECT songs FROM relation';
#make up the query
$search = array("style","content","language","source", "period", "region");

if($_POST['part'] == 'any'){
    if(isset($_POST['accompany'])) $sql = $sql . " WHERE (part = 1 OR part = 3 OR part = 5)";
    else  $sql = $sql . " WHERE (part = 2 OR part = 4 OR part = 6)";
}
else{
    $sql = $sql . " WHERE part = " . ($_POST['part'] - (isset($_POST['accompany']) == true));
}

for($i = 0; $i < 6; $i += 1){
    if($_POST[$search[$i]] != 0) $sql = $sql . " AND " . $search[$i] . "=" . $_POST[$search[$i]];
}

#query
$result = $conn->query($sql);
if($result){
  	while($row = $result->fetch_assoc()) {
        $res = $conn->query('SELECT * FROM songs WHERE id = ' . $row['songs'])->fetch_assoc();
        if($res){
            echo $res['songs'] . "<br />"; #print the res
        }
        else echo "Error: id = " . $row['songs'] . $conn->error;
   	}
    echo '没有了';
}
else echo "Error: " . $sql . $conn->error;

$conn->close();
?>