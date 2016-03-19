<html>
<head>
<title>创建 MySQL 数据表</title>
</head>
<body>
<?php
$dbhost = 'localhost:3036';
$dbuser = 'root';
$dbpass = 'root';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('连接失败: ' . mysql_error());
}
echo '连接成功<br />';
$sql = "CREATE TABLE runoob_tbl( ".
       "runoob_id INT NOT NULL AUTO_INCREMENT, ".
       "runoob_title VARCHAR(100) NOT NULL, ".
       "runoob_author VARCHAR(40) NOT NULL, ".
       "submission_date DATE, ".
       "PRIMARY KEY ( runoob_id )); ";
mysql_select_db( 'RUNOOB' );
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('数据表创建失败: ' . mysql_error());
}
echo "数据表创建成功\n";
mysql_close($conn);
?>
</body>
</html>