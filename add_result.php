<!DOCTYPE html>
<?php
$conn = new mysqli("localhost", "root", "", "fuga_songs");
if($conn->connect_error) die("连接失败:" . $conn->connect_error);
else echo "修改结果<br />";

#check name
if( !isset($_POST['songs_cre']) || $_POST['songs_cre'] == "请输入歌名" || $_POST['songs_cre'] == "" ){
    echo "请返回上一页中并输入歌名";
    die();
}

#add properties and manage them
$search = array("style","content","language","source", "period", "region", "songs", "part");
$index = array(0,0,0,0,0,0,0,0);
for($i = 0; $i < 7; $i = $i + 1){
    if(isset( $_POST[ $search[$i] . '_create' ] ) || $i == 6 ){
        $res = $conn->query(" INSERT INTO " . $search[$i] . " (". $search[$i] .") VALUES ( \"" . $_POST[$search[$i] . "_cre" ] . "\")"); if($res != true) echo "Error:" . $conn->error . "<br>";
        $ret = ( $conn->query("SELECT id FROM ". $search[$i] . " WHERE " . $search[$i] . "= \""  . $_POST[$search[$i] . "_cre" ] . "\"" ) )->fetch_assoc();
        $index[$i] = $ret['id'];
    }
    else $index[$i] = $_POST[ $search[$i] ];
}
$index[7] = $_POST[ $search[7] ];
if(isset($_POST['accompany'])) $index[7] = $index[7]-1;

#add relation
$sql = "INSERT INTO relation ( songs, part";
$SQL = ") VALUES (" . $index[6] . "," . $index[7];
for($i = 0; $i < 6; $i = $i + 1){
    if($index[$i] != 0){
        $sql = $sql . "," . $search[$i];
        $SQL = $SQL . "," . $index[$i];
    }
}

$res = $conn->query( $sql . $SQL . ")" );
if($res != true) echo "Error: " . $conn->error . "<br />";

$conn->close();
?>