<?php
require('config.php');
header("Content-type: text/html; charset=utf-8");
$username = $_SESSION['openid'];//获取当前用户名
if (isset($username)) {
}else{
	echo "<script>alert('请进行微信授权!'); window.location.href='oauth.php'</script>";
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>充值中心</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1">
	<link rel="stylesheet" href="css/caipiao.css">
</head>
<body>
	<div class="">
		<p class="balance">
			<?php
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
		</p>
	</div>
	<div class="recharge">
		<a href="#" class="recharge-item">50元</a>
		<a href="#" class="recharge-item">100元</a>
		<a href="#" class="recharge-item">200元</a>
		<a href="#" class="recharge-item">500元</a>
		<a href="#" class="recharge-item">1000元</a>
	</div>
</body>
</html>
