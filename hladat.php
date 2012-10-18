<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml" lang="sk">

<html>
<head>
	<title>Napalil ma!</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1250" >
	<link rel="stylesheet" type="text/css" href="style.css" />
		<link rel="stylesheet" type="text/css" href="js/jquery.autocomplete.css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
<script>
 $(document).ready(function(){
  $("#staznost").autocomplete("js/autocomplete.php", {
         selectFirst: false,
		 minLength:	2,
		 minChars: 2,
		 delay: 100
		 });
	
	$('dd').hide();
		
		$('dt').click(function(){
			
				var	rodic = $(this).parent(),
					 text = $(this).next();
	
					 	rodic.find('dd').slideUp();
						text.not(':visible').slideDown();
					
					return false;
					})	
 });
</script>
</head>
<body>
<form method="post" action="">
<br /> Pri vyhľadávaní nemáte možnosť komentovať príspevky.
<br /><br />
				Hladať <input name="hladat" type="text"/><input class="src" name="search" type="submit" value="Hladať" />
</form>
<?php
	if(isset($_POST['search'])){
		include('db.php');
		$claim =mysql_real_escape_string($_POST['hladat']);

		$sql="SELECT * FROM claims WHERE who='$claim'";
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
	
		mysql_close();
	}
	
?>
</table>
</body>

