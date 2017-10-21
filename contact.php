<?php
header("Content-type: text/html; charset=utf-8"); 
define("LOCALHOST","localhost");
define("USER","root");
define("PASSWORD","11111111");
define("BASENAME","zhy_php");

$n = $_POST['name'];
$a = $_POST['age'];
$t=time();

$db=mysqli_connect(LOCALHOST,USER,PASSWORD);

if(!$db){
	die("连接错误".mysqli_error($db));
}

$sql="create table zhy_xx(".
	"zhy_id INT NOT NULL AUTO_INCREMENT,".
	"zhy_name VARCHAR(32) NOT NULL,".
	"zhy_age TINYINT NOT NULL,".
	"submission_date DATE, ".
	"PRIMARY KEY ( zhy_id ))ENGINE=InnoDB DEFAULT CHARSET=utf8; ";

mysqli_query($db , "set names utf8");
mysqli_select_db($db,BASENAME);
if(mysqli_query($db,$sql)){
	die("数据表创建成功了");
}

$text="INSERT INTO zhy_xx (zhy_name,zhy_age,submission_date) VALUES ('{$n}','{$a}','{$t}')";
$find="SELECT zhy_name,zhy_age, submission_date FROM zhy_xx ";

$link=mysqli_query($db,$text);
$news=mysqli_query($db,$find);
echo '<h2>菜鸟教程 mysqli_fetch_array 测试<h2>';
echo '<table border="1"><tr><td>教程 ID</td><td>标题</td><td>作者</td><td>提交日期</td></tr>';
while($row = mysqli_fetch_array($news, MYSQL_NUM))
{
    echo "<tr><td> {$row[0]}</td> ".
         "<td>{$row[1]} </td> ".
         "<td>{$row[2]} </td> ".
         "<td>{$row[3]} </td> ".
         "</tr>";
}
mysqli_free_result($news);

mysqli_close($db);
?>