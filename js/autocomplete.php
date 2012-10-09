

<?php
include('/../db.php');
 $q=strtolower($_GET['q']);
 $my_data=mysql_real_escape_string($q);

 $sql="SELECT staznost_na FROM staznosti WHERE staznost_na LIKE '%$my_data%'";
 $result = mysql_query($sql);
 $poc=mysql_num_rows($result);
 

	 if($poc>0){
		  while($row=mysql_fetch_array($result)){
		   echo $row['staznost_na']."\n";
		  }
	 }

?>

