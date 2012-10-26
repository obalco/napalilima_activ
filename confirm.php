<?php

$tok = $_GET['tok'];
include_once('db.php');

$sql="SELECT `token` FROM `tokens` WHERE `token`='$tok'";

$vys = mysql_query($sql) or print("Došlo k chybì v dotazu: ".$sql."<br>".mysql_error());
$poc = mysql_num_rows ($vys);

	if($poc==1){
		$sql = $vys = "";
		
		$sql = "UPDATE tokens SET confirm=1 WHERE token='$tok'";
		$vys = mysql_query($sql) or print("Došlo k chybì v dotazu: ".$sql."<br>".mysql_error());;
	} 

?>