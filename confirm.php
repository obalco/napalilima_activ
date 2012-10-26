<?php

$tok = $_GET['tok'];

$sql="SELECT token FROM tokens WHERE token='$tok'";
$vys = mysql_query($vys);
$poc = mysql_num_rows ($vys);

	if($poc==1){
		$sql = $vys = "";
		
		$sql="UPDATE tokens SET confirm=1 where token='$tok'";
		$vys = mysql_query($vys);
		$poc = mysql_num_rows ($vys);
	} 

?>