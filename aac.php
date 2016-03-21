<?php
include ('config.php');
$sql="INSERT into jczq(id,match_name,) values ".$aaca.",".$aacb."";
mysql_query($sql);
$sql= "SELECT * from jczq";
$query = mysql_query($sql);
while ($row=mysql_fetch_array($query)) {
    $array[$row['id']]=.$row['match_name'];
}
?>