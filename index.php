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
<!-- Tabulky ma uz zas bavia -->
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
      <td colspan="2">
        <p id="popis">Využite možnosť ventilovať svoj hnev a pomôžte iným vyhnúť sa problémom</p>
      </td>
    </tr>
    <tr>
      <td colspan="2" align="center">
        <div id="nova_staznost">
          <?php
            session_start();
            include('db.php');
            include('errors.php');
            include('functions.php');
      
            echo '<form  method="post">
                    Co/Kto:<br /><textarea cols="100" rows="1" name="who"></textarea><br/>
                    Ako/Cim:<br /><textarea name="claim" rows="5" cols="100"></textarea><br/><br/>
                    Nick: <input type="text" name="nick" cols="35"> 
                    Kedy: <input type="text" name="date" cols="35">
                    E-mail: <input type="text" name="email" cols="35"><br/>
                    <p align="center"><input type="submit" id="button" value="Odoslať sťažnosť" name="send"></p>
                  </form></div>';
                
            if(isset($_POST['send'] ))
              {
                $message="";
                $who   = mysql_real_escape_string(trim($_POST['who']));
                $claim = mysql_real_escape_string(trim($_POST['claim']));
                $date  = mysql_real_escape_string(trim($_POST['date']));
                $nick  = mysql_real_escape_string(trim($_POST['nick']));
                //$email 		   = mysql_real_escape_string(trim($_POST['email']));
                //$ip			   = getIpAddress();
				//$sys_date = mysql_real_escape_string(trim($_POST['sys_date']));
          
               // $id_u =     1;
				// slovo ln spojene s premennou bude oznacovat dlzku retazca premennej
				// slovo ok budeme spajat s premenou a bude typu boolean
				$ln_who   = strlen($who);
				$ln_claim = strlen($claim);

				if($ln_who >3 && $ln_who < 50) {$ok_who = true; } 		   else {$ok_who = false;$message.=$error[6];}
				if($ln_claim >5 && $ln_claim < 200) {$ok_claim = true; }   else {$ok_claim = false; $message.=$error[7];}
			
				// blo by fajn keby nick a mail sa dava do session :) teda pri logovaní :)
				
            
            if ($ok_who === true && $ok_claim === true)
                  {
					$claim = cenzura($claim);
                    $sql  = "INSERT INTO claims ( who, claim, date, ip, sys_date) 
										VALUES ('$who','$claim', '$date', '$ip', NOW())";
                    $res  = mysql_query($sql);
                    $id_s = mysql_insert_id(); // funkcia mysql_insert_id dostava poslednu autoinkrementovanu hodnotu primarneho kluca u nas to je id 
                   
				   // $vys  = mysql_query($sql); kua naco tu je toto? vykona to druhy krat insert :D
                    header("Location:index.php");
                  }
                else
                  {
                    echo $message;
                  }
              } 
          ?>
      </td>
    </tr>
    <tr>
      <td>
        <p id="popis">Prečíťajte si najnovšie sťažnosti</p>
      </td>
    </tr>
        <?php
         
                  
          $sql="SELECT * FROM claims order BY id DESC LIMIT 10 ";
          $res=mysql_query($sql);
          $pocet=mysql_num_rows($res);
          
          $i=0;
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
              $i++;




              echo '<tr><td colspan="2" align="center"><div id="hlavicka_staznosti">'; 
			
              echo '<b>Nick: </b>'.$user.' | <b>Sťažnosť na: </b>'.$who.' | <b>Sťažnosť kedy: </b>'.$date.' | <b>Dátum odoslania: </b>'.$sys_date;  echo' <a href=""> LIKE </a>&nbsp; <a href=""> DISLIKE </a>';
              echo '<p id="staznost_a">'.$claim.'</p>';
			  
				echo"<dt id='odkaz''><a href='".$zaznam['id']."'>Pridaj komentár</a></dt>";
  				echo'<dd id="text_odkazu">';
				echo '<br />';
				 echo'<form method="post" >';
					echo'comment'.'<input type="text" name="comment" />';
					echo'<input name="send_comment" type="submit" value="Pridať komentár" />';
					echo'<input name="hid" type="hidden" value="'.$id.'" />';
					
				echo"</form>";	
				echo"</dd>";
				
				
			  $s = "SELECT * FROM comments WHERE id_c=".$id;
			  $v = mysql_query($s);
			  
			  while($z=mysql_fetch_assoc($v)){
			  
				echo"<br />";
				echo"<hr>";
				echo " id comentaru ".$z['id_c']." comentar ".$z['comment'];
			  }
			  
              echo'</div>';
			  echo"<br />";
			  
			  
           }
	
		   echo"</dl>";
		   
         echo'</div>';
         
         $sql="SELECT * FROM claims ";
         $res=mysql_query($sql);
         $pocet=mysql_num_rows($res);
         
         if($pocet>10) 
            {
             echo '<p><a href="vypis.php">Ďalej</a></p>';
            }
			
		

			
		/*
			if(!isset($_GET['req']))
		{
				$_GET['req']="index";
		}
			
			switch ($_GET['req'])  
			{
				case 'vypis':
				break;
				
				case 'vypis':
				break;
				
			
			}
		*/	
		
		if(isset($_POST['send_comment'])){
					
					$idecko=(isset($_POST['hid'])) ? $_POST['hid'] : "";

						//$comment = mysql_real_escape_string(trim($_POST['comment']));
						 

						$ip = getIpAddress();  
						
							$sql = "INSERT INTO comments (id_u, id_c, comment, sys_date, ip) VALUES ( 1, '$idecko', 'comment', NOW(),'$ip' )";
							$vys = mysql_query($sql);
												
					}
		
		
		?>
      <p align="center" class="pata">Code and Design by <a href="http://www.am.6f.sk" target="_blank"><img src="images/am_logo.png"  height="15" alt="AM PAGE Andrej Majik Logo"></a>
      and <a href="http://www.obalco.sk" target="_blank"><img src="images/obalco.png" height="15" alt="OBALCO logo"></a></p>
    </td>
  </tr>
</tbody>
</table>

</body>
</html>