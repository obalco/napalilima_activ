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

                  
          $sql="SELECT * FROM claims order BY id DESC";
          $res=mysql_query($sql);
          $pocet=mysql_num_rows($res);
          
          echo '<div id="pole_staznosti">';
		echo '<dl>';
	 
          while($zaznam = mysql_fetch_assoc($res))
            {
              $user  	= $zaznam['id_u'];	
              $who   	= $zaznam['who'];
              $date  	= $zaznam['date'];
              $claim 	= $zaznam['claim'];
              $id       = $zaznam['id'];
              $sys_date = date("d.m.Y \o H:i",strtotime($zaznam['sys_date']));
           

				echo '<div id="hlavicka_staznosti">'; 
			
				echo '<b>Nick: </b>'.$user.' | <b>Sťažnosť na: </b>'.$who.' | <b>Sťažnosť kedy: </b>'.$date.' | <b>Dátum odoslania: </b>'.$sys_date;  echo" <a href='?req=like&id=".$id."'> LIKE </a>&nbsp; <a href='?req=dislike&id=".$id."'> DISLIKE </a>";
				echo '<p id="staznost_a">'.$claim.'</p>';
			  
				echo"<dt id='odkaz''><a href='".$zaznam['id']."'>Pridaj komentár</a></dt>";
				
  				echo'<dd id="text_odkazu">';
				echo '<br />';
				
				echo'<form method="post" >';
				echo'Komentár:';
				echo '<br />';

					echo'<textarea name="comment" rows="5" cols="87" ></textarea>';
					echo'<input name="send_comment" type="submit" value="Pridať komentár" />';
					echo'<input name="hid" type="hidden" value="'.$id.'" />';
				echo"</form>";
				
				echo"</dd>";
				echo '<br />';

				
				  $s = "SELECT * FROM comments WHERE id_c=".$id;
				  $v = mysql_query($s);
				  
				  while($z=mysql_fetch_assoc($v)){
					echo'<div id="comment_box">';
					echo " id comentaru ".$z['id_c']." komentar je ".$z['comment'];
					echo"</div>";
				  }
				echo'</div>';
				echo"<br />";
			
			}
	
		echo"</dl>";
		   
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