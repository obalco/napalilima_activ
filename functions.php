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


function index (){
	
     
        echo'<p id="popis">PreËÌùajte si najnovöie sùaûnosti</p>';
      
          echo '<div id="pole_staznosti">';
		echo '<dl>';
		
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
			
				echo '<b>Nick: </b>'.$nick.' | <b>Sùaûnosù na: </b>'.$who.' | <b>Sùaûnosù kedy: </b>'.$date.' | <b>D·tum odoslania: </b>'.$sys_date;  echo" <a href='?req=like&id=".$id."'> LIKE </a> ".$like." | <a href='?req=dislike&id=".$id."'> DISLIKE </a>".$dis;
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
         $sql="SELECT * FROM claims where `show`=1";
         $res=mysql_query($sql);
		 $pocet=mysql_num_rows($res);
		 
         if($pocet>10) 
            {
             echo '<p><a href="vypis.php">œalej</a></p>';
            }
}


function send_mail($mail,$token){
			$to=$mail;
			$re='WWW.NAPALILIMA.SK';
			$head="Content-Type: text/html; charset=utf-8\n";
			$head.="Od:admin@".substr($_SERVER["SERVER_NAME"],4)."\n";
			$head.="Reply-To: admin@".substr($_SERVER["SERVER_NAME"],4)."\n";
			$mess='Pr·ve ste pridali svoju prv˙ sùaûnosù/koment·r na str·nka <a href="http://www.napalilima.sk>www.napalilima.sk</a>".
				 Pre zobrazenie vaöej sùaûnosti/koment·ru je potrebnÈ aby ste klikli na tento odkaz. ';
			$mess.=$token;
			mail($to,$re,$mess,$head);
}


function create_token() {     
    $token = '';
    $uid = uniqid("", true);
	$data='';
    
    $data .= $_SERVER['REQUEST_TIME'];
    $data .= $_SERVER['HTTP_USER_AGENT'];
    $data .= $_SERVER['REMOTE_ADDR'];
    $data .= $_SERVER['REMOTE_PORT'];
    $hash = strtoupper(hash('ripemd128', $uid . $token . md5($data)));
    $token =   
            substr($hash,  0,  8) . 
            '' .
            substr($hash,  8,  4) .
            '' .
            substr($hash, 12,  4) .
            '' .
            substr($hash, 16,  4) .
            '' .
            substr($hash, 20, 12);
			
    return $token;
  }
  



  
?>


	