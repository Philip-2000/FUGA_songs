<!DOCTYPE html>
<?php
$conn = new mysqli("localhost", "root", "", "fuga_songs");
if($conn->connect_error) die("连接失败:" . $conn->connect_error);
else echo "欢迎使用经年赋格歌曲查询系统<br />";

$base = "<option value=\"0\">不限</option>";
$search = array("style","content","language","source", "period", "region");
$ret = array("","","","","","","");

for($i = 0; $i < 6; $i = $i+1){
    $result = $conn->query("SELECT * FROM " . $search[$i]);
    $ret[$i] = $base;
    if($result){
    	while($row = $result->fetch_assoc()) {
    		$ret[$i] = $ret[$i] . "<option value=\"" . $row['id'] . "\">" . $row[$search[$i]] . "</option>";
    	}
    }
    else echo "Error: " . "SELECT * FROM " . $search[$i] . $conn->error;
}

#$result = $conn->query("SELECT * FROM style");
#$style_ret = "<option value=\"0\"></option><option value=\"0\">不限</option>";
#if($result) while($row = $result->fetch_assoc()) $style_ret = $style_ret . "<option value=\"" . $row['id'] . "\">" . $row['style'] . "</option>";
#else echo "Error: " . "SELECT * FROM style" . $conn->error;

$conn->close();
?>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="author" content="Philip" />
    <meta name="keywords" content="Keywords" />
    <title>查询歌曲</title>
</head>
<body>
    <button onclick="foo()">管理员</button>
    <textarea type="text" name="password" id="pwd" ></textarea>
    <form action="result.php" method="post">
        <input type="submit" value="提交" /><br />
        歌名：<input type="text" name="song" value="请输入歌名" id="111" /><br />
        <br />
        <br />
        立意：<select name="content"><?php echo $ret[1]; ?></select> 风格：<select name="style"><?php echo $ret[0]; ?> </select> <br />
        语言：<select name="language"> <?php echo $ret[2]; ?> </select> 来源：<select name="source"><?php echo $ret[3]; ?> </select> <br />
        时期：<select name="period"> <?php echo $ret[4]; ?> </select> 地区：<select name="region"><?php echo $ret[5]; ?> </select> <br />
        <br />
        <br />
        <input type="radio" name="accompany" value="0" checked="true"/>无伴奏
        <input type="radio" name="accompany" value="1" />有伴奏<br />
        <br />
        <input type="radio" name="part" value="4" />男声
        <input type="radio" name="part" value="6" />女声<br />
        <input type="radio" name="part" value="2" />混声
        <input type="radio" name="part" value="any" checked="true"/>不限<br />
    </form>
</body>
</html>
<script>
    function foo() {
        if (document.getElementById('pwd').value == 'password') {
            window.location.href = 'add.php';
        }
        else {
            document.getElementById('pwd').value = '密码错误';
        }
    }
</script>