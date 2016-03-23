<?php
	header("Content-Type:text/html;charset=utf-8");//定义读取文本为utf-8；
	require("config.php");//因为属于长时间链接数据库~所以使用require而不是include；
	$sql = "SELECT title,pic from banner_img ORDER BY id limit 4";
	$result = mysql_query($sql); //执行查询语句	//输出查询结果
	while ($row = mysql_fetch_array($result)) {
	//echo $row['title'] ,"<br />", $row['pic'],"<br />"; 
		// foreach ($result as $val) {
		// 	print_r($val);
		// }
		$arr[$i] = $row;
		$i++;
		}
		
		//  echo "<pre>";
		//  print_r($arr);
		// die;
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0"/>
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="Keywords" content="彩票,体育彩票,足球彩票,手机彩票,wap彩票,手机预定彩票"/>
	<title>彩票</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<script src="holder.js"></script>
	<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
	<script src="https://cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/js/bootstrap.js"></script>
	<link rel="stylesheet" type="text/css" href="css/caipiao.css">
</head>
<body>
	<!-- 顶部轮播 -->
	<div class="section-scroll-ad">
		<div id="carousel-top" class="carousel slide" data-ride="carousel" data-interval="3000">
			<!-- Carousel items -->
			<div class="carousel-inner">
				<div class="active carousel-item">
					<a href="">
						<img src="<?php echo ''.$arr[1]['pic'].'';?>">
						<p><?php echo ''.$arr[1]['title'].'';?></p>
					</a>
				</div>
				<div class="carousel-item">
					<a href="">
						<img src="<?php echo ''.$arr[2]['pic'].'';?>">
						<p><?php echo ''.$arr[2]['title'].'';?></p>
					</a>
				</div>
				<div class="carousel-item">
					<a href="">
						<img src="<?php echo ''.$arr[3]['pic'].'';?>">
						<p><?php echo ''.$arr[3]['title'].'';?></p>
					</a>
				</div>

			</div>
		</div>
	</div>

	<!-- 快捷入口图标 -->
	<div class="section-nav-icons card">
		<a href="#" class="nav-item">
			<div class="nav-item-icon"></div>
			<div class="nav-item-label">链接</div>
		</a>
		<a href="#" class="nav-item">
			<div class="nav-item-icon"></div>
			<div class="nav-item-label">链接</div>
		</a>
		<a href="#" class="nav-item">
			<div class="nav-item-icon"></div>
			<div class="nav-item-label">链接</div>
		</a>
		<a href="#" class="nav-item">
			<div class="nav-item-icon"></div>
			<div class="nav-item-label">链接</div>
		</a>
		<a href="#" class="nav-item">
			<div class="nav-item-icon"></div>
			<div class="nav-item-label">链接</div>
		</a>
	</div>

	<!-- 滚动新闻 -->
	<div class="section-scroll-news card">
		<div class="scroll-news">
			<ul class="scroll-news-list">
				<li class="scroll-news-item">
					<a href="#">
						<img src="holder.js/14x14" alt="">2秒切换
					</a>
				</li>
				<li class="scroll-news-item">
					<a href="#">
						<img src="holder.js/14x14" alt="">第二个
					</a>
				</li>
				<li class="scroll-news-item">
					<a href="#">
						<img src="holder.js/14x14" alt="">第三个
					</a>
				</li>
				<li class="scroll-news-item">
					<a href="#">
						<img src="holder.js/14x14" alt="">最后一个
					</a>
				</li>
			</ul>
		</div>
	</div>

	<!-- 文章列表 -->
	<div class="article-list card card-with-margin">
		<div class="article-item">
			<img src="holder.js/120x80" alt="">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias quasi sit, cumque</p>
		</div>
		<div class="article-item">
			<img src="holder.js/120x80" alt="">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias quasi sit, cumque</p>
		</div>
		<div class="article-item">
			<img src="holder.js/120x80" alt="">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias quasi sit, cumque</p>
		</div>
	</div>

	<!-- 底部导航和 floating action button -->
	<div class="section-bottom">
		<div class="nav-bottom"