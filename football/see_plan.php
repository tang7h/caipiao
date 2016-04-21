<?php
include_once("../config.php");
$username = $_SESSION['member'];//获取当前用户名；
$sql = "SELECT * FROM `user_plan` WHERE username = '$username'  ORDER BY id DESC LIMIT 0,1";
$result = mysql_query($sql);
while ($row = mysql_fetch_array($result)) {
	$data = $row;
}
// echo "<pre>";
// print_r($data);
// echo $data['username'];//调用用户名
// echo $data['football'];//调用数据
// echo "<pre>";
$plan = json_decode($data['football']);
// echo $plan->id,"<br>";
// echo $plan->time,"<br>";
$plan_lottery = $plan->nLottery * 2;
// echo $plan->nGames,"<br>";
$data = $plan->data;
// print_r($data->gameId);


?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<div class="ticketing">
	<div class="ticketing-info">
		<span class="ticketing-summary">
			<?php
			echo "一共","$plan->nGames","场比赛，","$plan->nLottery","注，共","$plan_lottery","元";
			?>
		</span>
		<span class="ticketing-id">#<?php echo "$plan->id"; ?></span>
	</div>
	<div class="tickets">
		<?php
		foreach ($data as $key => $value) {
			//print_r($value->selection);
			//echo "<td>$value->gameId</td>";
			//print_r($value->gameId);
			$sql = "SELECT official_num,match_name,home_team,away_team,weekday,handicap FROM jczq WHERE id = $value->gameId";
			$result = mysql_query($sql);
			while ($r = mysql_fetch_array($result)) {
				$row = $r;
			}
			//print_r($row);
			?>
			<div class="ticket">
				<div class="ticket-cell game">
					<div class="row game-head">
						<div class="game-info">
							<span class="game-num"> <?php echo $row['official_num']?> </span>
							<span class="game-name"> <?php echo $row['match_name']?> </span>
						</div>
						<div class="game-time">
							<?php echo $row['weekday']?>
						</div>
					</div>
					<div class="row teams">
						<div class="team-home"><?php echo $row['home_team']?></div>
						<div class="team-vs">VS</div>
						<div class="team-away"><?php echo $row['away_team']?></div>
					</div>
				</div>

				<div class="ticket-cell score"><?php echo "比分";?>
				</div>

				<div class="ticket-cell selection">
					<?php
					if ($value->selection['0']==0) {
						echo "";
					}else{
						echo "胜 ";
					}
					if ($value->selection['1']==0) {
						echo "";
					}else{
						echo "平 ";
					}
					if ($value->selection['2']==0) {
						echo "";
					}else{
						echo "负 ";
					}
					if ($value->selection['3']==0) {
						echo "";
					}else{
						echo "(",$row['handicap'],")让胜 ";
					}
					if ($value->selection['4']==0) {
						echo "";
					}else{
						echo "(",$row['handicap'],")让平 ";
					}
					if ($value->selection['5']==0) {
						echo "";
					}else{
						echo "(",$row['handicap'],")让负";
					}
					?>
				</div>
		</div>
		<?php
	}
	?>
	</div>
	<!-- tickets end -->
	<div class="dialog-btns">
		<button class="md-btn dialog-btn-cancel">取消</button>
		<button class="md-btn">出票</button>
	</div>
</div>
<div class="dialog-mask"></div>

<script>
	$('.dialog-mask').on(touchEv, closeDialogue)
	$('.dialog-btn-cancel').on(touchEv, closeDialogue)
	function closeDialogue() {
		$('#stage-dialog').removeClass('show').html('');
	}
</script>
</body>
</html>
