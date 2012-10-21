<?php
function getIpAddress()
{
   $basicIP = getenv("REMOTE_ADDR");
   $realIP = getenv("HTTP_X_FORWARDED_FOR");
   
   if(empty($realIP)) { $realIP = getenv("HTTP_X_FORWARDED"); }
   if(empty($realIP)) { $realIP = getenv("HTTP_FORWARDED_FOR"); }
   if(empty($realIP)) { $realIP = getenv("HTTP_FORWARDED"); }
   
   $proxyFlag = empty($realIP) ? 0 : 1;
   
   if(!$proxyFlag) {
      $realIP = getenv("HTTP_VIA");
      if(empty($realIP)) { $realIP = getenv("HTTP_X_COMING_FROM"); }
      if(empty($realIP)) { $realIP = getenv("HTTP_COMING_FROM"); }
      if(!empty($realIP)) { $proxyFlag = 2; }
   }
   
   if($realIP==$basicIP) { $proxyFlag = 0; }
   
   switch($proxyFlag) {
      case '0':
         $ipadr = $basicIP;
         break;
      case '1':
         $tmp = ereg("^([0-9]{1,3}\.){3,3}[0-9]{1,3}", $realIP, $zhoda);
         if($tmp && (count($zhoda)>0)) {
            $ipadr = $zhoda[0];
         } else {
            $ipadr = $basicIP;
         }
         break;
      case '2':
         $ipadr = $basicIP;
   }
   
   return $ipadr;
}



function cenzura($text){
	$text.=" ";
	$str = "";
	$slova=array();
	$znak= "";
	$vulgar = Array ("pica","piËa", "kokot","kokotisko", "jebo","jeb","jebak","kurva"); // Sem dopln slova ktore ta napadnu :D
	$oddelovace = Array(","," ",".","",PHP_EOL);
	$uprava = "";

		for($i=0; $i<strlen($text);$i++){
			$str .= $text[$i];
			if(in_array($text[$i],$oddelovace)){
				$znak = $text[$i]; 
				$kontr_slovo = substr($str,0,-1);
				$kontr_slovo = strtolower($kontr_slovo);
					if(in_array($kontr_slovo,$vulgar)){
						for($j=0; $j<strlen($kontr_slovo); $j++ ){
							$uprava.='*';	
						}
						$slova[]=$uprava;
						$slova[]=$znak;
						$uprava="";
						$str="";
						$znak="";
					}
					else{
						$slova[]=$str;
						$str="";
					}

			}

		}
	return $veta = implode("",$slova);
}

function getPageLink($i, $page){
	if($i==$page){
		return " $i";
	}
	return "<a href='" . ( $i !=1 ? "?page=$i" : " . ") . "'> $i </a>";
}

function index (){
 include ('errors.php');
	echo'<div id="nova_staznost">';
				echo '<form  method="post">
						Co/Kto:<br /><input type="text" name="who" /><br/>
						Ako/Cim:<br /><textarea name="claim" rows="5" cols="95"></textarea><br/><br/>
						Nick: <input type="text" name="nick" /> 
						Kedy: <input type="text" name="date" />
						E-mail: <input type="text" name="email" /><br/>
						<p align="center"><input type="submit" id="button" value="Odoslaù sùaûnosù" name="send" /></p>
					  </form>';
			echo'</div>';
			
                
            if(isset($_POST['send'] ))
              {
                $message="";
				 include_once ('errors.php');

                $who   = mysql_real_escape_string(trim($_POST['who']));
                $claim = mysql_real_escape_string(trim($_POST['claim']));
                $date  = mysql_real_escape_string(trim($_POST['date']));
                $nick  = mysql_real_escape_string(trim($_POST['nick']));
               
				$ln_who   = strlen($who);
				$ln_claim = strlen($claim);

				if($ln_who >3 && $ln_who < 50) {$ok_who = true; } 		   else {$ok_who = false;$message.=$error[1];}
				if($ln_claim >5 && $ln_claim < 200) {$ok_claim = true; }   else {$ok_claim = false; $message.=$error[2];}
			
				// blo by fajn keby nick a mail sa dava do session :) teda pri logovanÌ :)
				
            
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
     
        <p id="popis">PreËÌùajte si najnovöie sùaûnosti</p>
      

        <?php
                  
          $sql="SELECT * FROM claims order BY id DESC LIMIT 10 ";
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
			
				echo '<b>Nick: </b>'.$user.' | <b>Sùaûnosù na: </b>'.$who.' | <b>Sùaûnosù kedy: </b>'.$date.' | <b>D·tum odoslania: </b>'.$sys_date;  echo" <a href='?req=like&id=".$id."'> LIKE </a>&nbsp; <a href='?req=dislike&id=".$id."'> DISLIKE </a>";
				echo '<p id="staznost_a">'.$claim.'</p>';
			  
				echo"<dt id='odkaz''><a href='".$zaznam['id']."'>Pridaj koment·r</a></dt>";
				
  				echo'<dd id="text_odkazu">';
				echo '<br />';
				
				echo'<form method="post" >';
				echo'Koment·r:';
				echo '<br />';

					echo'<textarea name="comment" rows="5" cols="87" ></textarea>';
					echo'<input name="send_comment" type="submit" value="Pridaù koment·r" />';
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
         
         $sql="SELECT * FROM claims ";
         $res=mysql_query($sql);
         $pocet=mysql_num_rows($res);
         
         if($pocet>10) 
            {
             echo '<p><a href="vypis.php">œalej</a></p>';
            }
}

?>


