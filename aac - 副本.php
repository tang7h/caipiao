<?php
header("Content-Type:text/html;charset=utf-8");
include ('config.php');

?>
<!DOCTYPE html>
<head>
	<title></title>
	<!-- 声明文档使用的字符编码 -->
	<meta charset='utf-8'>
	<meta name="viewport" content="initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0"/>
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="Keywords" content="彩票,体育彩票,足球彩票,手机彩票,wap彩票,手机预定彩票"/>
	<link rel="stylesheet" type="text/css" href="css/caipiao.css">

</head>
<body>
	<?php  
	$sql="SELECT * FROM `jczq` ORDER BY official_date,id ASC";
			  //执行查询 得到查询结果数据集
	$result = mysql_query($sql,$conn);
	while($row = mysql_fetch_array($result)){ 
		echo '<div class="range_match">
		<div class="match_id">
			<ul>
				<li class="match_num"><p>'.$row['official_num'].'</p></li><!--official_date-->
				<li class="match_name"><p>'.$row['match_name'].'</p></li><!--match_name-->
				<li class="match_date" style="float:right;"><p>截期时间：'.$row['official_date'].'</p></li><!--match_date-->

			</ul>
		</div>
		<div class="match_vs">
			<div class="match_vs_or">
				<div class="home_team"><p><b>'.$row['home_team'].'</b></p></div><!--home_team-->
				<div class="vs_team"><p><b>VS</b></p></div>
				<div class="away_team"><p><b>'.$row['away_team'].'</b></p></div><!--away_team-->
			</div>
		</div>
		<div class="match_on">
			<div class="match_handicap">
				<div class="handicap_no">
					<p>非让球</p>
				</div>
				<div class="handicap_yes">
					<p>让球</p>
				</div>
			</div>
			<form action="" method="post">
				<div class="changci_header">
					<ul>
						<li class="handicap_li">
							<div class="upload_checkbox">
								<label>
									<input type="checkbox" class="hidden-input" />
									<span class="your style about checkbox">
										<ul>
											<li><p>胜</p></li>
											<li><p>'.$row['current3'].'</p></li><!--current3-->
										</ul>
									</span>
								</label>
							</div>
						</li>
						<li class="handicap_li">
							<div class="upload_checkbox">
								<label>
									<input type="checkbox" class="hidden-input" />
									<span class="your style about checkbox">
										<ul>
											<li><p>平</p></li>
											<li><p>'.$row['current1'].'</p></li><!--current1-->
										</ul>
									</span>
								</label>
							</div>
						</li>
						<li class="handicap_li">
							<div class="upload_checkbox">
								<label>
									<input type="checkbox" class="hidden-input" />
									<span class="your style about checkbox">
										<ul>
											<li><p>负</p></li>
											<li><p>'.$row['current1'].'</p></li><!--current0-->
										</ul>
									</span>
								</label>
							</div>
						</li>

						<!--让球 Star-->
						<li class="handicap_li">
							<div class="upload_checkbox">
								<label>
									<input type="checkbox" class="hidden-input" />
									<span class="your style about checkbox">
										<ul>
											<li><p>让胜</p></li>
											<li><p>'.$row['current_rqspf3'].'</p></li><!--current_rqspf 数组-->
									</span>
								</label>
							</div>
						</li>
						<li class="handicap_li">
							<div class="upload_checkbox">
								<label>
									<input type="checkbox" class="hidden-input" />
									<span class="your style about checkbox">
										<ul>
											<li><p>让胜</p></li>
											<li><p>'.$row['current_rqspf1'].'</p></li><!--current_rqspf 数组-->
									</span>
								</label>
							</div>
						</li>
						<li class="handicap_li">
							<div class="upload_checkbox">
								<label>
									<input type="checkbox" class="hidden-input" />
									<span class="your style about checkbox">
										<ul>
											<li><p>让负</p></li>
											<li><p>'.$row['current_rqspf0'].'</p></li><!--current_rqspf 数组-->
									</span>
								</label>
							</div>
						</li>

					</ul>
					
				</div>


			</form>
			<div class="match_odds">
				<a href="#openModal">更多</a>
				<div id="openModal" class="match_modalDialog">
				<div>
					<a href="#close" title="Close" class="match_close">X</a>
					<h2>Modal Box</h2>
					<p>This is a sample modal box created purely in HTML and CSS.</p>
					<p>There are many use cases for this modal box.</p>
				</div>
				</div>
			</div>
		</div>
	</div>';
	}

	?>
	
	
</body>
</html>