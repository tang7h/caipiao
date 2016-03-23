<?php 
require_once ('config.php'); 
//判断用户权限
if(empty($_SESSION['member'])){
	echo "<script>alert('请进行登陆或注册');location='user.php';</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
	<title>会员主页面</title>
	<link href="style.css" rel="stylesheet" type="text/css" />
	<link href="css/caipiao.css" rel="stylesheet" type="text/css" />
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
	<script src="https://cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/js/bootstrap.js"></script>
</head>
<body class="user">
	<?php
//注销操作
	if(@$_GET["tj"]=="destroy"){
		session_destroy();
		echo "<script>alert('注销成功');location='user.php';</script>";}
		?>
		<?php
//用户修改
		if(@$_GET["tj"]=="modify") {
			if(@$_POST["submit"]){
				mysql_query($sql="update member set member_name='".$_POST['member_name']."',member_qq='".$_POST['member_qq']."',member_phone='".$_POST['member_phone']."',member_email='".$_POST['member_email']."' where member_user='".$_SESSION['member']."'");
				echo "<script>alert('修改成功');location='member.php';</script>";
			} ?>
			<?php
			$sql="select * from member where member_user='".$_SESSION['member']."'";
			$rs=mysql_fetch_array(mysql_query($sql));
			?>

			<form method="post" action="" class="user-info-form">
				<small>修改信息</small>
				<section class="with-padding with-margin">
					<div class="form-group">
						<label class="sr-only" for="member_name">真实姓名</label>
						<input class="form-control" name="member_name" type="text" id="member_name" maxlength="20" placeholder="真实姓名" value="<? echo $rs['member_name'];?>"/>
					</div>
					<div class="form-group">
						<label class="" for="member_sex">性别</label>
						<div class="radio-group">
							<label class="btn btn-sm btn-primary-outline first">
								<input name="member_sex" type="radio" value="0" id="member_sex_0">
							男</label>
							<label class="btn btn-sm btn-primary-outline last">
								<input name="member_sex" type="radio" value="1" id="member_sex_1">
							女</label>
							<script>
								if (<? echo $rs['member_sex'];?>) {
									document.getElementById('member_sex_1').checked=true;
								}else {
									document.getElementById('member_sex_0').checked=true;
								}
							</script>
						</div>
					</div>
					<div class="form-group">
						<label class="sr-only" for="member_qq">QQ</label>
						<input class="form-control" name="member_qq" type="text" id="member_qq" maxlength="20" placeholder="QQ" value="<? echo $rs['member_qq'];?>" />
					</div>
					<div class="form-group">
						<label class="sr-only" for="member_phone">电话</label>
						<input class="form-control" name="member_phone" type="text" id="member_phone" maxlength="20" placeholder="电话" value="<? echo $rs['member_phone'];?>"/>
					</div>
					<div class="form-group">
						<label class="sr-only" for="member_email">电子邮箱</label>
						<input class="form-control" name="member_email" type="text" id="member_email" maxlength="20" placeholder="电子邮箱" value="<? echo $rs['member_email'];?>"/>
					</div>
					<input class="btn btn-secondary" type="reset" name="button" id="button" value="重置"/> 
					<input class="btn btn-primary" type="submit" name="submit" id="submit" value="提交"/>
					
				</section>
			</form>
			<?php } ?>


			<?php
			$result=mysql_query("select * from member where member_user='".$_SESSION['member']."'"); 
			while($rs=mysql_fetch_array($result)){
				?>
				<form method="post" action="" class="form-with-label user-info-form">
					<small>个人信息</small>
					<section class="with-padding with-margin">
						<div class="section-user">
							<div class="user-profile">
							</div>
							<div class="user-info">
								<div class="user-name"><? echo $rs['member_user'];?></div>
								<div class="user-desc">用户描述</div>
							</div>
							<div class="user-tools">
							<?php if($_SESSION['member'])
								{?>
								
								<?php echo "<a href='?tj=modify'>修改信息</a>";?>
								<?php if($_SESSION['member']=="admin"){?>
								<a href="user_index.php">管理</a>
								<?php }
								?>
							</div>
						</div>
					</section>
					<section class="with-padding with-margin">
						<div class="form-group">
							<label class="" for="member_name">真实姓名</label>
							<p class="form-control-static"><? echo $rs['member_name'];?></p>
						</div>
						<div class="form-group">
							<label class="" for="member_sex">性别</label>
							<p class="form-control-static"><? echo $rs['member_sex']?'女':'男';?></p>
						</div>
						<div class="form-group">
							<label class="" for="member_qq">QQ</label>
							<p class="form-control-static"><? echo $rs['member_qq'];?></p>
						</div>
						<div class="form-group">
							<label class="" for="member_phone">电话</label>
							<p class="form-control-static"><? echo $rs['member_phone'];?></p>
						</div>
						<div class="form-group">
							<label class="" for="member_email">电子邮箱</label>
							<p class="form-control-static"><? echo $rs['member_email'];?></p>
						</div>
						<a href='?tj=destroy' class="btn btn-danger btn-block">退出登陆</a>
					</section>
				</form>
				<?php } 
			}
			?>
		</body>
		</html>