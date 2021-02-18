<!DOCTYPE html>
<?php
$conn = new mysqli("localhost", "root", "", "fuga_songs");
if($conn->connect_error) die("连接失败:" . $conn->connect_error);
else echo "查询结果<br />";

if($_POST['song'] != "请输入歌名" && $_POST['song'] != ""){
    $res = $conn->query("SELECT * FROM songs WHERE name =" .$_POST['name'])->fetch_assoc();
    if($res){
        #print the res
    }
    $conn->close();
    die();
}
$sql = 'SELECT song FROM relation';

#make up the query
$search = array("style","content","language","source", "period", "region");
$ret = array("","","","","","","");
$flag = 0;
for($i = 0; $i < 6; $i += 1){
    if($_POST[$search[$i]] != 0){
        if($flag == 0){
            $flag = 1;
            $sql = $sql . " WHERE ";
        }
        else {
            $sql = $sql . " AND ";
        }
        $sql = $sql . $search[$i] . "=" . $_POST[$search[$i]];
    }
    echo $sql . "<br />"; #debug print
}

#query
$result = $conn->query($sql);
if($result){
  	while($row = $result->fetch_assoc()) {
        $res = $conn->query('SELECT * FROM songs WHERE id = ' . $row['song'])->fetch_assoc();
        if($res){
            #print the res
        }
        else echo "Error: id = " . $row['song'] . $conn->error;
   	}
    echo '没有了';
}
else echo "Error: " . $sql . $conn->error;

$conn->close();
?>