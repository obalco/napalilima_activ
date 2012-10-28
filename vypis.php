<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml" lang="sk">

<html>
<head>
	<title>Napalil ma|Vypis!</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1250" >
	<link rel="stylesheet" type="text/css" href="style.css" />
	<link rel="stylesheet" type="text/css" href="js/jquery.autocomplete.css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
<script>
 $(document).ready(function(){
  $("#hladat").autocomplete("js/autocomplete.php", {
         selectFirst: false,
		 minLength:	2,
		 minChars: 2,
		 delay: 100
		 });
 });
</script>
</head>
<body>
<table class="main_table"  align="center">
  <tbody>
    <tr>
      <td class="hlavicka">
        <a href="index.php"><img class="logo" src="images/napalilima_logo.png" alt="Napalili ma Logo" height="70" /></a>
      </td>
      <td align="right">
        <form action="hladat.php" method="post">
          <input name="hladat" type="text" id="hladat" size="20"  />&nbsp;<input name="search" type="submit" value="Hladať" />
        </form>
      </td>
    <tr/>
  <tr>
    <?php
		include('db.php');
		include('functions.php');

		$sql="SELECT * FROM staznosti ORDER BY ID DESC";
		$res=mysql_query($sql);
		$pocet=mysql_num_rows($res);

		
		$i=0;
		echo '<div id="pole_staznosti">';
		
		while($zaznam = mysql_fetch_assoc($res))
		{
			$nick 		   = $zaznam['nick'];	
			$staznost_na   = $zaznam['staznost_na'];
			$staznost_kedy = $zaznam['staznost_kedy'];
			$staznost 	   = $zaznam['staznost'];
			$email		   = $zaznam['email'];
			$datum         = date("d.m.Y \o H:i",strtotime($zaznam['datum_staznost']));
			$i++;

			 echo '<tr><td colspan="2" align="center"><div id="hlavicka_staznosti">';
              echo '<b>Nick: </b>'.$nick.' | <b>Sťažnosť na: </b>'.$staznost_na.' | <b>Sťažnosť kedy: </b>'.$staznost_kedy.' | <b>E-mail: </b>'.$email.' | <b>Dátum odoslania: </b>'.$datum;
              echo '<p id="staznost_a">'.$staznost.'</p>';
              echo'</div>';
		
		}
	echo'</div>';
	
	//Strankovanie
	$limit = 2;
		$page = (isset($_GET['page'])? $_GET['page'] : 1);
		$neighbors = 3;

        $sql = mysql_query("
			SELECT SQL_CALC_FOUNDS_ROWS * 
			FROM staznosti
			LIMIT $limit OFFSET ".(($page - 1) * $limit));
        $rows = mysql_result(mysql_query("SELECT FOUND_ROWS()") , 0);
		 
		$maxPage = ceil($rows / $limit);
		echo getPageLink(1, $page);
		if( $page > $neighbors){
			echo " ...";
		}
		$to = min($maxPage, $page + $neighbors);
		for($i= max(2, $page - $neighbors + 1 );  $i < $to; $i++){
			echo getPageLink($i ,$page);
		}
		if($page + $neighbors < $maxPage){
			echo " ...";
		}
		if($maxPage > 1){
			echo getPageLink($maxPage, $page);
		}
		mysql_close();
    ?>
<p align="center" class="pata">Code and Design by <a href="www.am.6f.sk" target="_blank"><img src="images/am_logo.png"  height="15" alt="AM PAGE Andrej Majik Logo"></a>
      and <a href="www.obalco.sk" target="_blank"><img src="images/obalco.png" height="15" alt="OBALCO logo"></a></p>
    </td>
  </tr>
</tbody>
</table>
</body>