<?php
require('config.php');
header("Content-type: text/html; charset=utf-8");
$username = $_SESSION['openid'];//获取当前用户名
if (isset($username)) {
}else{
	echo "<script>alert('请进行微信授权!'); window.location.href='oauth.php'</script>";
	exit();
}
//查询该账户下的余额
$sql = "SELECT balance FROM `member` WHERE member_user = '$username'";
$result = mysql_query($sql);
while ($row = mysql_fetch_array($result)) {
	$data = $row;
}
if ($data['balance'] == '') {
echo "账户余额为0元";
}else{
echo "账户余额为",$data['balance'],"元";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>充值中心</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<style type="text/css">
	body {
		margin: 0;
		padding: 0;
		overflow: hidden;

	}
	.whole {
		width: 80%;
		margin: 0 auto;
	}
	.checks {
		width: 40%;
    	height: 30px;
    	background: red;
    	float: left;
    	margin: 0 0 10px 10px;
    	text-align: center;
    	padding-top: 10px;
	}
	a {
		text-decoration: none;
		color: #FFF;

	}
</style>
<body>
	<form class="" action="index.html" method="post">
		<input type="radio" name="name" value="50" id="price50">
		<label for="price50">50元</label>
		<input type="radio" name="name" value="100" id="price100">
		<label for="price100">100元</label>
		<input type="radio" name="name" value="200" id="price200">
		<label for="price200">200元</label>
		<input type="radio" name="name" value="500" id="price500">
		<label for="price500">500元</label>
		<input type="radio" name="name" value="1000" id="price1000">
		<label for="price1000">1000元</label>

		<input type="submit" name="name" value="提交">
	</form>
</body>
</html>
