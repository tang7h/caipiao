<?php
require_once ('config.php');
?>
<!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>会员注册</title>
	<link href="style.css" rel="stylesheet" type="text/css" />
	<link href="css/caipiao.css" rel="stylesheet" type="text/css" />
	<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
	<script src="https://cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/js/bootstrap.js"></script>
<script language="javascript">
function chk(theForm){
	if (theForm.member_user.value.replace(/(^\s*)|(\s*$)/g, "") == ""){
		alert("帐号不能为空！");
		theForm.member_user.focus();   
		return (false);   
	}		
	
	if (theForm.member_password.value.replace(/(^\s*)|(\s*$)/g, "") == ""){
		alert("密码不能为空！");
		theForm.member_password.focus();   
		return (false);   
	}	
	
	if (theForm.member_password.value != theForm.pass.value){
		alert("两次输入密码不一样！");
		theForm.pass.focus();   
		return (false);   
	}	
		 
	if (theForm.member_name.value.replace(/(^\s*)|(\s*$)/g, "") == "" || theForm.member_name.value.replace(/[\u4e00-\u9fa5]/g, "")){
		alert("真实姓名不能为空且必须为中文！");   
		theForm.member_name.focus();   
		return (false);   
	}
}
</script>
<?php
if(@$_POST["submit"]){
if(empty($_POST['member_user']))
	echo "<script>alert('帐号不能为空');location='?tj=register';</script>";
else if(empty($_POST['member_password']))
	echo "<script>alert('密码不能为空');location='?tj=register';</script>";
else if($_POST['member_password']!=$_POST['pass'])
	echo "<script>alert('两次密码不一样');location='?tj=register';</script>";
else if(!empty($_POST['member_qq'])&&!is_numeric($_POST['member_qq']))
	echo "<script>alert('qq号必须全为数字');location='?tj=register';</script>";
else if(!empty($_POST['member_phone'])&&!is_numeric($_POST['member_phone']))
	echo "<script>alert('手机号码必须全为数字');location='?tj=register';</script>";
else if(!empty($_POST['member_email'])&&!ereg("([0-9a-zA-Z]+)([@])([0-9a-zA-Z]+)(.)([0-9a-zA-Z]+)",$_POST['member_email']))
	echo "<script>alert('邮箱输入不合法');location='?tj=register';</script>";
else{
$_SESSION['member']=$_POST['member_user'];
$sql="insert into member values('','".$_POST['member_user']."','".md5($_POST['member_password'])."','".$_POST['member_name']."','".$_POST['member_sex']."','".$_POST['member_qq']."','".$_POST['member_phone']."','".$_POST['member_email']."')";
$result=mysql_query($sql)or die(mysql_error());
if($result)
echo "<script>alert('恭喜你注册成功,马上进入主页面');location='member.php';</script>";
else
{
	echo "<script>alert('注册失败');location='user.php';</script>";
	mysql_close();
}
	}
}
?>
</head>
<body class="user">
<?php if(@$_GET['tj'] == 'register'){ ?>
<form id="theForm" name="theForm" method="post" action="" onSubmit="return chk(this)" runat="server" class="register-form">
	<h1>会员注册</h1>
	<div class="form-group">
		<label class="sr-only" for="member_user">用户名<small><span>*</span>由字母和数字组成</small></label>
		<input class="form-control input-lg" name="member_user" type="text" id="member_user" maxlength="20" placeholder="用户名" required />
	</div>
	<div class="form-group">
		<label class="sr-only" for="member_password">密码<span>*</span></label>
		<input class="form-control input-lg" name="member_password" type="password" id="member_password" maxlength="20" placeholder="密码" required/>
	</div>
	<div class="form-group">
		<label class="sr-only" for="pass">确认密码<span>*</span></label>
		<input class="form-control input-lg" name="pass" type="password" id="pass" maxlength="20"placeholder="确认密码"  required/>
	</div>
	<div class="form-group">
		<label class="sr-only" for="member_name">真实姓名</label>
		<input class="form-control input-lg" name="member_name" type="text" id="member_name" maxlength="20" placeholder="真实姓名" />
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
		<input class="form-control" name="member_qq" type="text" id="member_qq" maxlength="20" placeholder="QQ"/>
	</div>
	<div class="form-group">
		<label class="sr-only" for="member_phone">电话</label>
		<input class="form-control" name="member_phone" type="text" id="member_phone" maxlength="20" placeholder="电话"/>
	</div>
	<div class="form-group">
		<label class="sr-only" for="member_email">电子邮箱</label>
		<input class="form-control" name="member_email" type="text" id="member_email" maxlength="20" placeholder="电子邮箱"/>
	</div>
	<div class="form-group">
		<input class="btn btn-primary btn-lg btn-block" type="submit" name="submit" id="submit" value="注册" maxlength="20"/>
	</div>
	<a href='user.php'>已有账号，直接登陆</a>
</form>
<?php
} 
	if(@$_GET['tj']== ''){
?>
<?php
if(@$_POST["submit2"]){
$name=$_POST['name'];
$pw=md5($_POST['password']);
$sql="select * from member where member_user='".$name."'"; 
$result=mysql_query($sql) or die("账号不正确");
$num=mysql_num_rows($result);
if($num==0){
	echo "<script>alert('帐号不存在');location='user.php';</script>";
	}
while($rs=mysql_fetch_object($result))
{
	if($rs->member_password!=$pw)
	{
		echo "<script>alert('密码不正确');location='user.php';</script>";
		mysql_close();
	}
	else 
	{
		$_SESSION['member']=$_POST['name'];
		header("Location:member.php");
		mysql_close();
		}
	}
}
?>
<form action="" method="post" name="regform" onSubmit="return Checklogin();" class="login-form">
	<h1>登陆</h1>
	<div class="form-group">
	<label class="sr-only" for="name">用户名</label>
	<input type="text" class="form-control input-lg" id="name" name="name" placeholder="用户名">
  </div>
  <div class="form-group">
	<label class="sr-only" for="exampleInputPassword1">密码</label>
	<input type="password" class="form-control input-lg" id="password" name="password" placeholder="密码">
  </div>
  <div class="form-group">
	<input  type="submit" name="submit2" value="登录" class="btn btn-primary btn-lg btn-block"/>
  </div>
  <a href='user.php?tj=register'>没有账号？立即注册</a>
	</form>
<?php } ?>

<table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td height="5"></td>
	</tr>
</table>


</body>
</html>