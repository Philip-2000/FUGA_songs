<!DOCTYPE html>
<?php
$conn = new mysqli("localhost", "root", "", "fuga_songs");
if($conn->connect_error) die("连接失败:" . $conn->connect_error);
else echo "欢迎使用经年赋格歌曲查询系统
<br />";

$result = $conn->query("SELECT * FROM style");
$style_ret = "\n";
if($result){
    $style_ret = $style_ret . "<option value=\"0\"></option><option value=\"0\">不限</option>";
	while($row = $result->fetch_assoc()) {
		$style_ret = $style_ret . "<option value=\"" . $row['id'] . "\">" . $row['style'] . "</option>";
	}
}
else echo "Error: " . "SELECT * FROM style" . $conn->error;

$result = $conn->query("SELECT * FROM content");
$content_ret = "<option value=\"0\"></option><option value=\"0\">不限</option>";
if($result){
	while($row = $result->fetch_assoc()) {
		$content_ret = $content_ret . "<option value=\"" . $row['id'] . "\">" . $row['content'] . "</option>";
	}
}
else echo "Error: " . "SELECT * FROM content" . $conn->error;

$conn->close();
?>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="author" content="Philip" />
    <meta name="keywords" content="Keywords" />
    <title>test</title>
</head>
<body>
    <button onclick="foo()">管理员</button>
    <textarea type="text" name="password" id="pwd" ></textarea>
    <form action="PHPPage2.php" method="post">
        <input type="submit" value="提交" />
        歌名：<input type="text" name="song" value="请输入歌名" id="111" /><br />
        风格：<select id="style_select" innerHTML="<?php echo $style_ret; ?>"> </select> <br />
        立意：<select id="content_select" innerHTML="<?php echo $content_ret; ?>"> </select> <br />
        <input type="checkbox" name="accompany" value="accompany" />有伴奏<br />
        <input type="radio" name="part" value="any" />不限<br />
        <input type="radio" name="part" value="mix" />混声合唱<br />
        <input type="radio" name="part" value="boy" />男声合唱<br />
        <input type="radio" name="part" value="girl" />女声合唱<br />
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