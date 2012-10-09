

<?php
include('/../db.php');
 $q=strtolower($_GET['q']);
 $my_data=mysql_real_escape_string($q);

 $sql="SELECT who FROM claims WHERE who LIKE '%$my_data%'";
 $result = mysql_query($sql);
 $poc=mysql_num_rows($result);
 

	 if($poc>0){
		  while($row=mysql_fetch_array($result)){
		   echo $row['who']."\n";
		  }
	 }

?>

