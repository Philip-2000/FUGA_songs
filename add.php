<!DOCTYPE html>
<?php
$conn = new mysqli("localhost", "root", "", "fuga_songs");
if($conn->connect_error) die("连接失败:" . $conn->connect_error);
else echo "欢迎使用经年赋格歌曲管理系统<br />";

$search = array("style","content","language","source", "period", "region");
$ret = array("","","","","","","");

for($i = 0; $i < 6; $i = $i+1){
    $result = $conn->query("SELECT * FROM " . $search[$i]);
    if($result){
    	while($row = $result->fetch_assoc()) {
            if( $row[$search[$i]] == "其他") $ret[$i] = $ret[$i] . "<option value=\"" . $row['id'] . "\" selected>其他</option>";
    		else $ret[$i] = $ret[$i] . "<option value=\"" . $row['id'] . "\">" . $row[$search[$i]] . "</option>";
    	}
    }
    else echo "Error: " . "SELECT * FROM " . $search[$i] . $conn->error;
}

$conn->close();
?>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="author" content="Philip" />
    <meta name="keywords" content="Keywords" />
    <title>管理歌曲</title>
</head>
<body>
    <form action="add_result.php" method="post">
        <input type="submit" value="提交" /><br />
        歌名：<input type="text" name="songs_cre" value="请输入歌名" id="111" /><br />
        <br />
        <br />
        立意：<select name="content" id="con_sel"> <?php echo $ret[1]; ?> </select> <input type="text" name="content_cre" id="con_cre" style='display:none' />  <input type="checkbox" name="content_create" id="con_create" style="display:none" value="create"/><br /> 
        风格：<select name="style" id="sty_sel"> <?php echo $ret[0]; ?> </select> <input type="text" name="style_cre" id="sty_cre" style='display:none' /> <input type="checkbox" name="style_create" id="sty_create" style="display:none" value="create"/><br />
        语言：<select name="language" id="lan_sel"> <?php echo $ret[2]; ?> </select> <input type="text" name="language_cre" id="lan_cre" style='display:none' /> <input type="checkbox" name="language_create" id="lan_create" style="display:none" value="create"/><br />
        来源：<select name="source" id="sou_sel"> <?php echo $ret[3]; ?> </select> <input type="text" name="source_cre" id="sou_cre" style='display:none' /> <input type="checkbox" name="source_create" id="sou_create" style="display:none" value="create"/><br />
        时期：<select name="period" id="per_sel"> <?php echo $ret[4]; ?> </select> <input type="text" name="period_cre" id="per_cre" style='display:none' /> <input type="checkbox" name="period_create" id="per_create" style="display:none" value="create"/><br />
        地区：<select name="region" id="reg_sel"> <?php echo $ret[5]; ?> </select> <input type="text" name="region_cre" id="reg_cre" style='display:none' /> <input type="checkbox" name="region_create" id="reg_create" style="display:none" value="create"/><br />
        <br />
        <br />
        <input type="checkbox" name="accompany" value="accompany"> 有伴奏<br />
        <br />
        <input type="radio" name="part" value="4" />男声
        <input type="radio" name="part" value="6" />女声
        <input type="radio" name="part" value="2" checked="true" />混声<br />
    </form>
    <button onclick="create('con')" id="con_sign">创建</button></br>
    <button onclick="create('sty')" id="sty_sign">创建</button></br>
    <button onclick="create('lan')" id="lan_sign">创建</button></br>
    <button onclick="create('sou')" id="sou_sign">创建</button></br>
    <button onclick="create('per')" id="per_sign">创建</button></br>
    <button onclick="create('reg')" id="reg_sign">创建</button></br>
</body>
</html>
<script>
    function create(name){
        if(document.getElementById(name+'_create').checked == false){
            document.getElementById(name+'_create').checked = true;
            document.getElementById(name+'_sel').style.display='none';
            document.getElementById(name+'_cre').style.display='';
            document.getElementById(name+'_sign').innerHTML='选择';
        }
        else{
            document.getElementById(name+'_create').checked = false;
            document.getElementById(name+'_sel').style.display='';
            document.getElementById(name+'_cre').style.display='none';
            document.getElementById(name+'_sign').innerHTML='创建';
        }
    }
</script>