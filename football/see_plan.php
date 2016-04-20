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
<style type="text/css">
	td{
		border: 1px #000 solid;
	}
</style>
<div>
	<?php
	echo "订单号：","$plan->id","号，","一共","$plan->nGames","场比赛，","$plan->nLottery","注，共","$plan_lottery","元";
	?>
<table>
	<?php
	foreach ($data as $key => $value) {
		//print_r($value->selection);
	echo "<tr>";
	//echo "<td>$value->gameId</td>";
	echo "</tr>";
	echo "<tr>";
	//print_r($value->gameId);
	$sql = "SELECT official_num,match_name,home_team,away_team,weekday,handicap FROM jczq WHERE id = $value->gameId";
	$result = mysql_query($sql);
	while ($r = mysql_fetch_array($result)) {
		$row = $r;
	}
	//print_r($row);
	?>
	<td><?php echo $row['official_num'],$row['match_name'],$row['home_team'],$row['away_team'],$row['weekday']?>
	</td>
	<?php
	print_r($row['official_num']);
	?>
	<td><?php echo "比分";?>
	</td>
	</td>
	<td>
	<?php
	if ($value->selection['0']==0) {
		echo "";
	}else{
		echo "胜";
	}
	if ($value->selection['1']==0) {
		echo "";
	}else{
		echo "平";
	}
	if ($value->selection['2']==0) {
		echo "";
	}else{
		echo "负";
	}
	if ($value->selection['3']==0) {
		echo "";
	}else{
		echo "(",$row['handicap'],")让胜";
	}
	if ($value->selection['4']==0) {
		echo "";
	}else{
		echo "(",$row['handicap'],")让平";
	}
	if ($value->selection['5']==0) {
		echo "";
	}else{
		echo "(",$row['handicap'],")让负";
	}

	?>
	</td>

	</tr>
<?php

	}
	?>
</table>
</div>

</body>
</html>
