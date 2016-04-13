<?php
header("Content-Type:text/html;charset=utf-8");
include ('../config.php');
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
	<link rel="stylesheet" type="text/css" href="../css/caipiao.css">
	<script type="text/javascript" src="../js/jquery-2.2.2.min.js"></script>
	<!-- <script src="../js/angular.min.js"></script> -->
	<script src="../js/buy.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('.cell').click(function(){
			$(this).toggleClass('selected');
		})
	})

	</script>
</head>
<body ng-app="buyApp">
	<form action="" method="post">
	<?php
	$sql="SELECT * FROM `jczq` ORDER BY official_date,id ASC";
			  //执行查询 得到查询结果数据集
	$result = mysql_query($sql,$conn);
	while($row = mysql_fetch_array($result)){
		$current_rqspf = explode("|", $row['current_rqspf']);
		foreach ($current_rqspf as $value) {
		}
		//$row['current_rqspf'] = explode('|', $row['current_rqspf']);
		//print_r($current_rqspf); die;
		?>
		<div class="range_match">
	<div class="match_id">
		<span class="id" style="display:none;"><?php echo $row['id'];?></span><!--id-->
		<span class="match_num"><?php echo $row['official_num'];?></span><!--official_date-->
		<span class="match_name"><?php echo $row['match_name']?></span><!--match_name-->
		<span class="match_date">截期时间：<?php  echo $row['official_date']?></span><!--match_date-->
	</div>
	<div class="match_vs">
		<span class="home_team"><?php echo  $row['home_team']?></span><!--home_team-->
		<span class="vs_team">VS</span>
		<span class="away_team"><?php echo  $row['away_team']?></span><!--away_team-->
	</div>
	<div class="match_on">
		<div class="match_handicap">
			<div class="handicap_no">非让球</div>
			<div class="handicap_yes">让球</div>
		</div>

		<div class="changci_header">
			<div class="row">
						<div class="cell">
							<p>胜</p>
							<p><?php echo  $row['current3']?></p>
						</div>
						<div class="cell">
							<p>平</p>
							<p><?php echo  $row['current1']?></p>
						</div>
						<div class="cell">
							<p>负</p>
							<p><?php echo  $row['current0']?></p>
						</div>
			</div>
			<div class="row">
						<div class="cell">
							<p>让胜</p>
							<p><?php echo  $current_rqspf['2']?><span>(<?php echo  $row['handicap']?>)</span></p>
						</div>
						<div class="cell">
							<p>让平</p>
							<p><?php echo  $current_rqspf['1']?><span>(<?php echo  $row['handicap']?>)</span></p>
						</div>
						<div class="cell">
							<p>让负</p>
							<p><?php echo  $current_rqspf['0']?><span>(<?php echo  $row['handicap']?>)</span></p>
						</div>
			</div>
		</div>
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
</div>
<?php
	}

	?>
	</form>


</body>
</html>
