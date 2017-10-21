<?php
header("Access-Control-Allow-Origin:*");//此处使网站可以进行跨域访问
header("Content-type:text/html;charset=utf-8");//字符编码设置 
define("LOCALHOST","localhost");
define("USER","root");
define("PASSWORD","11111111");
define("BASENAME","zhy_php");

$db=mysqli_connect(LOCALHOST,USER,PASSWORD);
if(!$db){die("连接错误".mysqli_error($db));}

$sql_select="select * from zhy_xx";

mysqli_query($db,"set names utf8");
mysqli_select_db($db,BASENAME);
$result=mysqli_query($db,$sql_select);

$zhy=array();

while ($row = mysqli_fetch_array($result,MYSQL_ASSOC)) {
	$count=count($row);//这个长度会变化的；
	for($i=0;$i<$count;$i++){
		unset($row[$i]);//删除冗余数据  
	}
	array_push($zhy, $row);
}
print_r($zhy);
echo $str=json_encode($zhy); //转化成一个json格式
mysqli_close($db);
?>