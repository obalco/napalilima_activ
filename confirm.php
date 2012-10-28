<?php

$tok = $_GET['tok'];
include_once('db.php');

$sql="SELECT `token` FROM `tokens` WHERE `token`='$tok'";

$vys = mysql_query($sql) or print("Došlo k chybì v dotazu: ".$sql."<br>".mysql_error());
$poc = mysql_num_rows ($vys);

	if($poc==1){
		$sql = $vys = "";
		$sql = "UPDATE tokens SET confirm=1 WHERE token='$tok'";
		$vys = mysql_query($sql) or print("Došlo k chybì v dotazu: ".$sql."<br>".mysql_error());
		
		$sql = $vys = "";
		$sql = "SELECT id_u FROM tokens WHERE token='$tok'";
		$vys = mysql_query($sql)or print("Došlo k chybì v dotazu: ".$sql."<br>".mysql_error());
		$id = mysql_fetch_assoc($vys);
		
		$id = $id['id_u'];
		
		$sql = $vys = "";

		$sql = "UPDATE users SET reg=1 WHERE id='$id'";
		$vys = mysql_query($sql) or print("Došlo k chybì v dotazu: ".$sql."<br>".mysql_error());
		

		$sql = $vys = "";

		$sql = "UPDATE claims SET `show`=1 WHERE id_u='$id'";
		$vys = mysql_query($sql) or print("Došlo k chybì v dotazu: ".$sql."<br>".mysql_error());


		header("Location: http://www.napalilima.sk");


	} 

?>