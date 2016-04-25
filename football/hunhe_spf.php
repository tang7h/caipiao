<?php
header("Content-Type:text/html;charset=utf-8");
include ('../config.php');
?>
<!DOCTYPE html>
<html ng-app="universe" ng-controller="universeCtrl">
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
	<script src="../js/jquery-2.2.2.min.js"></script>
	<script src="../js/angular.js"></script>
	<!-- <script src="js/moment.js"></script> -->
	<script type="text/javascript" src="http://momentjs.cn/downloads/moment-with-locales.min.js"></script>
	<script src="../js/caipiaoCtrl.js"></script>
	<script src="../js/buy.js"></script>
</head>
<body>
	<form action="" method="post" class="stage-games">
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
			<div class="range_match" data-game-id="<?php echo $row['id'];?>">
				<div class="match_id">
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
							<div class="cell" ng-click="countGames()">
								<p>胜</p>
								<p><?php echo  $row['current3']?></p>
							</div>
							<div class="cell" ng-click="countGames()">
								<p>平</p>
								<p><?php echo  $row['current1']?></p>
							</div>
							<div class="cell" ng-click="countGames()">
								<p>负</p>
								<p><?php echo  $row['current0']?></p>
							</div>
						</div>
						<div class="row">
							<div class="cell" ng-click="countGames()">
								<p>让胜</p>
								<p><?php echo  $current_rqspf['2']?><span>(<?php echo  $row['handicap']?>)</span></p>
							</div>
							<div class="cell" ng-click="countGames()">
								<p>让平</p>
								<p><?php echo  $current_rqspf['1']?><span>(<?php echo  $row['handicap']?>)</span></p>
							</div>
							<div class="cell" ng-click="countGames()">
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

	<!-- 底部导航和 floating action button -->
	  <div class="section-bottom">
	    <!-- 底部导航 -->
	    <div class="nav-bottom">
	      <!-- <div class="nav-bottom-item {{i.show}}" ng-repeat="i in pages" ng-click="turn($index)" data-stage="{{i.name}}"> -->
	      <div class="nav-bottom-item {{i.show}}" ng-repeat="i in pages" ng-click="goto('http://positemall.cn/'+i.address)" data-stage="{{i.name}}">
	        <i class="material-icons">{{i.icon}}</i>
	        <span class="nav-bottom-text">{{i.tag}}</span>
	      </div>
	    </div>
	    <!-- 底部工具栏 -->
	  	<section id="toolbar-buy" ng-show="tools.show">
	  		<i class="material-icons" id="btn-trolly-clean">delete</i>
				<!-- 选择串法 -->
	      <!-- <select id="select-rule" ng-model="mxnSelection" ng-options="i.name for i in mxns | filter: nGames+'串'">
					<option value="">串法</option>
	      </select> -->
	      <select id="select-rule">
					<option value="">串法</option>
	      </select>
				<!-- 选择倍数 -->
	      <div class="">
	        <input type="number" id="input-multiple" name="" value="1" min="1" max="1000" step="1">倍
	      </div>
				<!-- 提示信息 -->
	  		<div class="desc">
	  			<span id="lotteries-count"></span>
	  		</div>
				<!-- 选择串法测试 -->
				<span>{{mxnSelection.name}}</span>
				<!-- 确认按钮 -->
	  		<button type="button" name="button" class="md-btn md-btn-primary" id="btn-buy" disabled>选好了</button>
	  	</section>
	    <div class="snackbar" ng-show="tools.show">
	      <p>最多选择8场比赛</p>
	    </div>
	    <div class="toast" ng-show="tools.show">
	      <p class="toast-message"></p>
	      <span class="md-btn" id="toast-recall">恢复</span>
	    </div>

	  </div>

	  <div id="stage-dialog"></div>
</body>
</html>
