<?php
	header("Content-Type:text/html;charset=utf-8");//定义读取文本为utf-8；
	require("config.php");//因为属于长时间链接数据库~所以使用require而不是include；
	$sql = "SELECT title,pic from banner_img ORDER BY id limit 4";
	//$sql_1 = "SELECT title,pic from news_info ORDER BY id limit 4"; 
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
			<div class="nav-item-icon"><img src="images/iconfont-clock-12.png"></div>
			<div class="nav-item-label">比分直播</div><!--视频直播跳转-->
		</a>
		<a href="#" class="nav-item">
			<div class="nav-item-icon"><img src="images/iconfont-clock-13.png"></div>
			<div class="nav-item-label">视频直播</div>
		</a>
		<a href="#" class="nav-item">
			<div class="nav-item-icon"><img src="images/iconfont-clock-14.png"></div>
			<div class="nav-item-label">开场哨</div>
		</a>
		<a href="#" class="nav-item">
			<div class="nav-item-icon"><img src="images/iconfont-clock-15.png"></div>
			<div class="nav-item-label">球市新闻</div>
		</a>
		<a href="#" class="nav-item">
			<div class="nav-item-icon"><img src="images/iconfont-clock-16.png"></div>
			<div class="nav-item-label">帮助说明</div>
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
			<h2>标题</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum omnis blanditiis esse, hic mollitia perferendis sapiente inventore exercitationem asperiores velit tenetur nobis quibusdam commodi labore corporis debitis quisquam quia eum.</p>
		</div>
		<div class="article-item">
			<img src="holder.js/120x80" alt="">
			<h2>标题</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias quasi sit, cumque</p>
		</div>
		<div class="article-item">
			<img src="holder.js/120x80" alt="">
			<h2>标题</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias quasi sit, cumque</p>
		</div>
	</div>

	<!-- 底部导航和 floating action button -->
	<div class="section-bottom">
		<div class="nav-bottom">
			<div class="nav-bottom-item">
				<div class="icon">
					<img src="images/iconfont-clock-07.png">
				</div>
				<div class="icon-label">
					首页
				</div>
			</div>
			
			<div class="nav-bottom-item">
				<a href="hunhe_spf.php">
				<div class="icon">
					<img src="images/iconfont-clock-11.png">
				</div>
				<div class="icon-label">
					走势
				</div>
				</a>
			</div>
			
			<div class="nav-bottom-item">
				<div class="icon">
					<img src="images/iconfont-clock-09.png">
				</div>
				<div class="icon-label">
					说说
				</div>
			</div>
			<div class="nav-bottom-item">
				<div class="icon">
					<img src="images/iconfont-clock-10.png">
				</div>
				<div class="icon-label">
					米米
				</div>
			</div>
			
			<div class="nav-bottom-item">
				<a href="user.php">
				<div class="icon">
					<img src="images/iconfont-clock-08.png">
				</div>
				<div class="icon-label">
					我的
				</div>
				</a>
			</div>
			
		</div>

		<div class="fab">
			<i class="fab-add"></i>
		</div>
	</div>
</body>
</html>