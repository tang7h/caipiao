<?php
include_once("../config.php");
$username = $_SESSION['member'];//获取当前用户名；
$sql = "SELECT * FROM `user_plan` WHERE username = '$username'  ORDER BY id DESC LIMIT 0,1";
$result = mysql_query($sql);
while ($row = mysql_fetch_array($result)) {
	$data = $row;
}
// echo "<pre>";
// print_r($data);
echo $data['username'];//调用用户名
echo $data['football'];//调用数据
?>