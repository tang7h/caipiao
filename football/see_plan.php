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
	<link rel="stylesheet" href="/css/caipiao.css" >
</head>
<body>
<div class="ticketing">
	<?php
	echo "订单号：","$plan->id","号，","一共","$plan->nGames","场比赛，","$plan->nLottery","注，共","$plan_lottery","元";
	?>
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
				<div class="ticket-cell">
					<div class="row">
						<div class="game-info">
							<?php echo $row['official_num']?>
							<?php echo $row['match_name']?>
						</div>
						<div class="game-time">
							<?php echo $row['weekday']?>
						</div>
					</div>
					<div class="row">
						<div class="team"><?php echo $row['home_team']?></div>
						<div class="tem">VS</div>
						<div class="team"><?php echo $row['away_team']?></div>
					</div>
				</div>

				<div class="ticket-cell"><?php echo "比分";?>
				</div>

				<div class="ticket-cell">
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
</div>

</body>
</html>
