﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<head>


<link rel="stylesheet" type="text/css" href="style.css" />

<link rel="stylesheet" type="text/css" href="js/jquery.autocomplete.css" />

<script type="text/javascript" src="js/jquery.js">
</script>
<script type="text/javascript" src="js/jquery.autocomplete.js"></script>



<title>Napalilima.sk!</title>

<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />

</head>

<script>



 $(document).ready(function(){
  $("#hladat").autocomplete("js/autocomplete.php", {
         selectFirst: false,
		 minLength:	2,
		 minChars: 2,
		 delay: 100
		 });
		 
	$('#error_box').hide;
 $('#close_error_box').click(function(){
 $('#error_box').slideUp("slow");})	
		 
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





<body> 
	<div id="container">
		 <div id="header">

			<a href="index.php"><img class="logo" src="images/napalilima_logo3.png" alt="Napalili ma Logo" height="70" /></a>
	<!--		<form action="hladat.php" method="post">
				<div class="search">
					<input name="hladat" type="text" id="hladat"   />&nbsp;<input class="src" name="search" type="submit" value="Hladať" />
				</div>
			</form> -->
		 </div>
     
        <p id="popis">Využite možnosť ventilovať svoj hnev a pomôžte iným vyhnúť sa problémom</p>
      
                 
		<div id="content">

          <?php
            session_start();
            include('db.php');
            include('errors.php');
            include('functions.php');
			include('val.php');

		echo'</div>';
		
				
												
		
		
		if(!isset($_GET['req']))
			{
				$_GET['req']="index";
			}
		
			switch($_GET['req']){
			
				case 'like':
					if(isset($_GET['id'])){
						$id_u=(int) $_GET['id'];
						$sql_u = "UPDATE claims SET _like=_like+1 WHERE id='$id_u'"; 
						$vys_u = mysql_query($sql_u);
						header ("Location:http://www.napalilima.sk");
					}
				break;
				
				case 'dislike':
					if(isset($_GET['id'])){
						$id_u=(int) $_GET['id'];
						$sql_u = "UPDATE claims SET dislike=dislike+1 WHERE id='$id_u'"; 
						$vys_u = mysql_query($sql_u);
						header ("Location:http://www.napalilima.sk");

					}
				break;
				
				case  'index':
				
				/// nadefinovanie premennych pred posielanim 
				/// po poslani formulara budeme ukladať tieto hodnoty aby user nemusel zadavať hodnoty jak jebo
				
			
				
				//	FORMULAR PRE NOVU STAZNOST.
				echo'<div id="nova_staznost">';
					echo '<form  method="post">
							Kto alebo čo ťa napálilio<br /><input type="text" name="who" /><br/>
							čím ťa napálili<br /><textarea name="claim" rows="5" cols="80" width="80"></textarea><br/><br/>
							Tvoj nick: <input type="text" name="nick" /> 
							Kedy sa to stalo: <input type="text" name="datum" />
							Tvoj mail: <input type="text" name="mail" />
							<br />
							<p align="center"><input type="submit" id="button" value="Vypusti to von" name="send" /></p>
						</form>';
				echo'</div>';
			

            if(isset($_POST['send'] )){
                 $message="";
				 include_once ('val.php');
				 include_once ('db.php');

				
         $who   = mysql_real_escape_string(trim($_POST['who']));
         $claim = mysql_real_escape_string(trim($_POST['claim']));
				 $nick  = mysql_real_escape_string(trim($_POST['nick']));
         $datum = mysql_real_escape_string(trim($_POST['datum']));
				 $mail  = mysql_real_escape_string(trim($_POST['mail']));
				 $ip    = getIpAddress();
				
				 $w = val_who($who);
				 $c = val_claim($claim);
				 $n = val_nick($nick);
				 $d = val_date($datum);
				 $m = val_mail($mail);
				
				if( ($w && $c && $d && $n && $m) === true ){
				
				 // ci existuje tento nick a potom mail
				 
				 $sql = "SELECT count(*) AS pocet_n FROM users WHERE nick='$nick'";
				 $vys = mysql_query($sql);
				 $poc = mysql_fetch_assoc($vys);
				 $poc_n = $poc['pocet_n'];
				 
				 $sql = $vys = $poc = "";
				 
				 $sql = "SELECT count(*) AS pocet_m FROM users WHERE mail='$mail'";
				 $vys = mysql_query($sql);
				 $poc = mysql_fetch_assoc($vys);
				 $poc_m = $poc['pocet_m'];

				 
					if( ($poc_n==0) && ($poc_m==0) ){
						$sql = $vys = "";
						$sql = "INSERT INTO users (nick, reg_date, mail, last_log) VALUES ('$nick', NOW(), '$mail', NOW())";
						$vys = mysql_query($sql);
						$id_u = mysql_insert_id();

						$sql = $vys = "";
						$sql = "INSERT INTO claims (`id_u`,`who`,`claim`,`date`,`_like`,`dislike`,`ip`,`sys_date`,`show`) VALUES ('$id_u','$who','$claim','$datum',0,0,'$ip',NOW(),0)";
						$vys = mysql_query($sql);
						
						$token = create_token();
						
						$sql = $vys = "";

						$sql = "INSERT INTO tokens (id_u,token,create_date,confirm) VALUES ('$id_u','$token', NOW(), 0)";
						$vys = mysql_query($sql);
						$token = 'http://www.napalilima.sk/confirm.php?tok='.$token;
						
						
						send_mail($mail, $token); 
						$message.="Bol ti odoslany potvrdzovací mail na adresu $mail";
					 //     echo '<a href ="'.$link.'">'.$link.'</a>';
						// header("Location:send.php");
						
					}
					else if( ($poc_n>0) && ($poc_m>0) ) { 
							$sql = $vys = "";
							$sql = "SELECT id FROM users WHERE nick='$nick' AND mail='$mail'";
							$vys = mysql_query($sql);
							$id  = mysql_fetch_assoc($vys);
							$id_u = $id['id'];

							$sql=$vys="";
							$sql= "INSERT INTO claims (`id_u`,`who`,`claim`,`date`,`_like`,`dislike`,`ip`,`sys_date`,`show`) VALUES ('$id_u','$who','$claim','$datum',0,0,'$ip',NOW(),1)";

							$vys = mysql_query($sql);
						
						} 
						else{
							$message.= $error[7];
							 
						}
							
            
				$claim = cenzura($claim);
				
				//$id_s = mysql_insert_id();
					
				}
				else
				{
					include_once ('errors.php');
					
					if (!$w) { $message.= $error[1];}
					if (!$c) { $message.= $error[2];}
					if (!$d) { $message.= $error[3];}
					if (!$n) { $message.= $error[4];}
					if (!$m) { $message.= $error[5];}

					
				}
				if($message!=""){
					echo '<div id="error_box"><div id="close_error_box">X</div>'.$message.'</div>';
				}
			}	

		if(isset($_POST['send_comment'])){
			$message="";
					
				$idecko=(isset($_POST['hid'])) ? $_POST['hid'] : "";			
			
         $comment = mysql_real_escape_string(trim($_POST['comment']));
				 $nick_c  = mysql_real_escape_string(trim($_POST['nick_c']));
				 $mail_c  = mysql_real_escape_string(trim($_POST['mail_c']));
				 $ip      = getIpAddress();
				 
				 $cc = val_comment($comment);
				 $nn = val_nick($nick_c);
				 $mm = val_mail($mail_c);
				 
				 if( ($cc && $nn && $mm) === true ){
					
					 $sql = "SELECT count(*) AS pocet_n FROM users WHERE nick='$nick_c'";
					 $vys = mysql_query($sql);

					 $poc = mysql_fetch_assoc($vys);
					 $poc_n = $poc['pocet_n'];
					 
					 $sql = $vys = $poc = "";
					 
					 $sql = "SELECT count(*) AS pocet_m FROM users WHERE mail='$mail_c'";
					 $vys = mysql_query($sql);
					 $poc = mysql_fetch_assoc($vys);
					 $poc_m = $poc['pocet_m'];
				
					if( ($poc_n==0) && ($poc_m==0) ){
              $message.= $error[8];
              echo '<div id="error_box"><div id="close_error_box">X</div>'.$message.'</div>'; 
					/* ked toto rozsirime o pouzivanie confirm mailu tak sa bude dat pridat comentar aj bez pridania staznosti ...zatial to tak ale nepojde
							$sql = $vys = "";
							$sql = "INSERT INTO users (nick, reg_date, mail, last_log) VALUES ('$nick_c', NOW(), '$mail_c', NOW())";
							$vys = mysql_query($sql);
							$id_u="";
							$id_u = mysql_insert_id();

							$sql = $vys = "";
							$sql = "INSERT INTO comments (id_u, id_c, comment, sys_date, ip) VALUES ('$id_u', '$idecko', '$comment', NOW(), '$ip')";
							$vys = mysql_query($sql);
						//	header("Location:send.php"); */
							
					}
					else if( ($poc_n>0) && ($poc_m>0) ) { 
								$sql = $vys = "";
								$sql = "SELECT id FROM users WHERE nick='$nick_c' AND mail='$mail_c'";
								$vys = mysql_query($sql);
								$id  = mysql_fetch_assoc($vys);
								$id_u = $id['id'];

								$sql = $vys="";
								$sql = "INSERT INTO comments (id_u, id_c, comment, sys_date, ip) VALUES ('$id_u', '$idecko', '$comment', NOW(), '$ip')";
								$vys = mysql_query($sql) or print("Došlo k chybě v dotazu: ".$sql."<br>".mysql_error());
;
							
					} 
					

					
				}	
				else
				{
					
					if (!$cc) { $message.= $error[2];}
					if (!$nn) { $message.= $error[4];}
					if (!$mm) { $message.= $error[5];}
					
				}
				 
		}				
					//index();
					echo'<p id="popis">Prečíťajte si najnovšie sťažnosti</p>';
      
          echo '<div id="pole_staznosti">';
		echo '<dl>';
		
		/* $sql = "SELECT * FROM claims as c
						INNER JOIN users as u
						ON c.id_u=u.id
						WHERE u.reg=1";
			
*/			
		  $sql="SELECT * FROM claims where `show`=1 ORDER BY id desc";
          $res=mysql_query($sql);
		  
          while($zaznam = mysql_fetch_assoc($res))
            {
				$user  	= $zaznam['id_u'];	

				$sql_1="SELECT nick FROM users WHERE id=".$user;
				$vys_1=mysql_query($sql_1);
				$user_name=mysql_fetch_assoc($vys_1);
				
				$nick=$user_name['nick'];
				$who   	= $zaznam['who'];
				$date  	= $zaznam['date'];
				$claim 	= $zaznam['claim'];
				$id     = $zaznam['id'];
				$like   = $zaznam['_like'];
				$dis    = $zaznam['dislike'];
				
				$sys_date = date("d.m.Y \o H:i",strtotime($zaznam['sys_date']));
					

				echo '<div id="hlavicka_staznosti">'; 
			
				echo '<b>Napálený: </b>'.$nick.' | <b>Napálili ma </b>'.$date.' | <b>Pridané </b>'.$sys_date;  echo" <a href='?req=like&id=".$id."'> LIKE </a> ".$like." | <a href='?req=dislike&id=".$id."'> DISLIKE </a>".$dis;
				echo '<p><b>Napálil/li/la ma </b>'.$who.'</p>';
				echo '<p id="staznost_a">'.$claim.'</p>';
       
					$s = "SELECT * FROM comments WHERE id_c='$id' ";
					$v = mysql_query($s);
				  $pocet_commentov = mysql_num_rows($v);
				 
          echo "<div id=\"popis\">Komentare ($pocet_commentov)</div>";
          echo "<br />";  
          echo"<dt id='odkaz''><a href='".$zaznam['id']."'>Pridaj komentár</a></dt>";
  				echo'<dd id="text_odkazu">';
			  	echo'<form method="post" >';
			  	echo '<br />';
			  	echo'Komentár:'; 
			  	echo '<br />';
					echo'<textarea name="comment" rows="2" cols="87" ></textarea>';
					echo '<br />';
					echo '<br />';

					echo' Nick: <input name="nick_c" type="text" />';
					echo' E-mail: <input name="mail_c" type="text" /> ';
			  	echo'<input name="send_comment" type="submit" value="Pridať komentár" />';
					echo '<br />';
					echo'<input name="hid" type="hidden" value="'.$id.'" />';
			  	echo"</form>";
			  	echo '<br />';
				
			  	echo"</dd>";
          
				  while($z=mysql_fetch_assoc($v)){
				  $sys_date = date("d.m.Y \o H:i",strtotime($z['sys_date']));
				  $pom = $z['id_u'];
				  $sql = "SELECT nick FROM users WHERE id=".$pom; 
				  $vys5 = mysql_query($sql);
				  $u = mysql_fetch_assoc($vys5);
	
					echo'<div id="comment_box">';
					echo "Pridal <strong>",$u['nick'],"</strong>&nbsp;",$sys_date,"&nbsp;<br /><br />",$z['comment'];
					echo"</div><br />";
				  }
				
				echo'</div>';
				echo"<br />";
			
			}
	
		echo"</dl>";
		   
         echo'</div>';
         $sql="SELECT * FROM claims where `show`=1";
         $res=mysql_query($sql);
		 $pocet=mysql_num_rows($res);
		 
         if($pocet>10) 
            {
        //     echo '<p><a href="vypis.php">Ďalej</a></p>';
            }
			
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