<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml" lang="sk">

<html>
<head>
	<title>Vyhladavanie!</title>
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
	<div id="container">
		 <div id="header">

			<a href="index.php"><img class="logo" src="images/napalilima_logo.png" alt="Napalili ma Logo" height="70" /></a>
			<form action="hladat.php" method="post">
				<div class="search">
					<input name="hladat" type="text" id="hladat"   />&nbsp;<input class="src" name="search" type="submit" value="Hladať" />
				</div>
			</form>
		 </div>
     
        <p id="popis">Využite možnosť ventilovať svoj hnev a pomôžte iným vyhnúť sa problémom</p>
      
                 
		<div id="content">

          <?php
            session_start();
            include('db.php');
            include('errors.php');
            include('functions.php');
			
			

		echo'</div>';
					
		

			
		
		
			
		
			
		
		if(isset($_POST['send_comment'])){
					
			$idecko=(isset($_POST['hid'])) ? $_POST['hid'] : "";
			$comment = mysql_real_escape_string($_POST['comment']);
			$ip = getIpAddress();  			
			$sql = "INSERT INTO comments (id_u, id_c, comment, sys_date, ip) VALUES ( 1, '$idecko', '$comment', NOW(),'$ip' )";
			$vys = mysql_query($sql);
			header("Location: index.php");
												
		}
		
		
		if(!isset($_GET['req']))
			{
				$_GET['req']="index";
			}
		
		switch($_GET['req']){
		
			case 'like':
				if(isset($_GET['id'])){
					$id_u=(int) $_GET['id'];
					$sql_u = "UPDATE claims SET _like=_like+1 WHERE id=".$id_u.""; 
					$vys_u = mysql_query($sql_u);
				}
			break;
			
			case 'dislike':
				if(isset($_GET['id'])){
					$id_u=(int) $_GET['id'];
					$sql_u = "UPDATE claims SET dislike=dislike+1 WHERE id=".$id_u.""; 
					$vys_u = mysql_query($sql_u);
				}
			break;
			
			case 'index':
				index();
			break;
			
			default:
				echo'<img src="images/f.svg"></a>';
			break;
			}
		?>
		</div> <!--K contetnu-->
		<div id="footer">
			<p align="center" class="pata">Code and Design by <a href="http://www.am.6f.sk" target="_blank"><img src="images/am_logo.png"  height="15" alt="AM PAGE Andrej Majik Logo"></a>
			and <a href="http://www.obalco.sk" target="_blank"><img src="images/obalco.png" height="15" alt="OBALCO logo"></a></p>
		</div>
	</div><!--K Containeru-->
</body>
</html>