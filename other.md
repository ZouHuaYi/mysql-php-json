# MySQL数据库的学习

### MySQL数据库的命令
1. 链接数据库 mysql -u root -p 然后输入密码
2. 显示数据库的列表 show databases;
3. 使用数据库中的表和显示 use mysql;show tables;
4. 显示数据表的结构 describe listname;或者是show columns from listname;
5. 建数据库 create database name; 删除库 drop database name;
6. 建数据表 create table listname(字段列表)；删除 drop table name;

		这里就创建了一个简单的数据表
		 mysql>  create table zhy_xx(
		    -> name varchar(32) not null,
		    -> password varchar(64) not null)
		    -> default charset=utf8;
		Query OK, 0 rows affected (0.04 sec)

7. 向数据表中填写内容  insert 语句的三种方法；
> -  insert into tablename values(value1,value2,...)
> -  insert into tablename(fieldname1,fieldname2,...) values(value1,value2,...)
> - insert into tablename(fieldname1,fieldname2) select fieldname1,fieldname2 from tablename1 
> - 在使用变量传输的时候要注意书写格式
 $text="INSERT INTO zhy_xx (zhy_name,zhy_age,submission_date) VALUES ('{$n}','{$a}','{$t}')";

8. 查看数据表中的数据 select * from name;清除表中的记录 delete from name


## php+MySQL的函数和方法；

1. 链接数据库的函数 mysqli_connect(localhost,user,password); --使用die(mysqli_error($db));输出错误。
2. 创建数据库和删除数据库的函数 mysql_query($db,$sql);$sql 是SQL语句。
3. 选择数据库 mysql_select_db($db,"zhy");
4. $row=mysqli_fetch_array ($link,MYSQL_ASSOC)这是参数获取数据.$row['id']---mysqli_fetch_assoc($link)这是一样的方法来的。
5. $row=mysqli_fetch_array ($link,MYSQL_NUM)这是参数获取数据.$row['1']
6. 要养成良好的释放内存的习惯 mysqli_free_result($link)


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
		echo $str=json_encode($zhy); //转化成一个json格式[{},{}]输出的是
		mysqli_close($db);
		?>

### mysql语句的where语法
	
- 使用查询的时候 select a,b,c from all;使用分号隔开是非常
- WHERE是指语句中的指定条件。相当于 if语句的存在。
- 可以是AND或者OR来指定一个或者多个条件。
- WHERE也可以在DELETE或者UPDATE中使用。 select * from zhy_xx where zhy_id=4;
- update是经常跟where语句混合在一个起的 update zhy_xx set zhy_name='newsname' where zhy_id=1;删除多条数据delete from zhy_xx where zhy_id in (1,7,9);可以在in 的后面书写更多的条件

## SQL语句的对数据进行排序

-  SQL SELECT 语句使用 ORDER BY 子句将查询数据排序后再返回数据；select * from zhy_xx order by zhy_id desc;降序 ASC 这是升序。