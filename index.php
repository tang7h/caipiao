<?php
	header("Content-Type:text/html;charset=utf-8");//定义读取文本为utf-8；
	require("config.php");//因为属于长时间链接数据库~所以使用require而不是include；
	$sql = "SELECT title,pic from banner_img  ORDER BY id desc limit 4";
	$sql_1 = "SELECT title,text,pic,id from news_info  ORDER BY id desc limit 6";

	$result = mysql_query($sql); //执行查询语句	//输出查询结果
	$rs = mysql_query($sql_1);
	while ($row = mysql_fetch_array($result)) {
	//echo $row['title'] ,"<br />", $row['pic'],"<br />";
		// foreach ($result as $val) {
		// 	print_r($val);
		// }
		$arr[$i] = $row;
		$i++;
		}
		// echo "<pre>";
		// print_r($arr);
		// die;
	while ($row_1 = mysql_fetch_array($rs)) {
		$arr_1[$i] = $row_1;
		$i++;
	}
		// echo "<pre>";
		// print_r($arr_1);
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
	<div class="section-nav-icons section">
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
	<div class="section-scroll-news section">
		<div class="scroll-news">
			<ul class="scroll-news-list">
				<li class="scroll-news-item">
					<a href="#">
						<img src="images/iconfont-clock-18.png" alt="">欧冠8强抽签——干爹队抽狼堡！
					</a>
				</li>
				<li class="scroll-news-item">
					<a href="#">
						<img src="images/iconfont-clock-18.png" alt="">巴萨对阵马竞，躺赢？
					</a>
				</li>
				<li class="scroll-news-item">
					<a href="#">
						<img src="images/iconfont-clock-18.png" alt="">欧冠8强抽签——干爹队抽狼堡！
					</a>
				</li>
				<li class="scroll-news-item">
					<a href="#">
						<img src="images/iconfont-clock-18.png" alt="">巴萨对阵马竞，躺赢？
					</a>
				</li>
			</ul>
		</div>
	</div>

	<!-- 文章列表 -->
	<div class="article-list section with-margin">
		<a href="article_class.php?id=<?php echo ''.$arr_1[4]['id'].'';?>">
		<div class="article-item">
			<img src="<?php echo ''.$arr_1[4]['pic'].'';?>" alt="">
			<h2><?php echo ''.$arr_1[4]['title'].'';?></h2>
			<p><?php echo ''.$arr_1[4]['text'].'';?></p>
		</div>
		</a>
		<a href="article_class.php?id=<?php echo ''.$arr_1[5]['id'].'';?>">
		<div class="article-item">
			<img src="<?php echo ''.$arr_1[5]['pic'].'';?>" alt="">
			<h2><?php echo ''.$arr_1[5]['title'].'';?></h2>
			<p><?php echo ''.$arr_1[5]['text'].'';?></p>
		</div>
		</a>
		<a href="article_class.php?id=<?php echo ''.$arr_1[6]['id'].'';?>">
		<div class="article-item">
			<img src="<?php echo ''.$arr_1[6]['pic'].'';?>" alt="">
			<h2><?php echo ''.$arr_1[6]['title'].'';?></h2>
			<p><?php echo ''.$arr_1[6]['text'].'';?></p>
		</div>
		</a>
		<a href="article_class.php?id=<?php echo ''.$arr_1[7]['id'].'';?>">
		<div class="article-item">
			<img src="<?php echo ''.$arr_1[7]['pic'].'';?>" alt="">
			<h2><?php echo ''.$arr_1[7]['title'].'';?></h2>
			<p><?php echo ''.$arr_1[7]['text'].'';?></p>
		</div>
		</a>
		<a href="article_class.php?id=<?php echo ''.$arr_1[8]['id'].'';?>">
		<div class="article-item">
			<img src="<?php echo ''.$arr_1[8]['pic'].'';?>" alt="">
			<h2><?php echo ''.$arr_1[8]['title'].'';?></h2>
			<p><?php echo ''.$arr_1[8]['text'].'';?></p>
		</div>
		</a>
		<a href="article_class.php?id=<?php echo ''.$arr_1[9]['id'].'';?>">
		<div class="article-item">
			<img src="<?php echo ''.$arr_1[9]['pic'].'';?>" alt="">
			<h2><?php echo ''.$arr_1[9]['title'].'';?></h2>
			<p><?php echo ''.$arr_1[9]['text'].'';?></p>
		</div>
		</a>
	</div>

	<?php
		include('page_header.php');
	?>
</body>
</html>
