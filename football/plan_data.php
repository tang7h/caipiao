<?php
require('../config.php');
header('content-type: text/html charset=utf8');
$username = $_SESSION['member'];//通过session取得用户名赋值到pidname
if (isset($username)) {
	echo "1";
}else{
	echo "2";
}
$ball = $_POST['ball'];
if (isset($ball)) {
	echo "1";
}else{
	echo "2";
}
$sql = "INSERT INTO `user_plan` (username,football)VALUES ('$username','$ball');"
?>