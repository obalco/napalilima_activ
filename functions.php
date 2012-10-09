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
	$vulgar = Array ("pica","pièa", "kokot","kokotisko", "jebo","jeb","jebak","kurva"); // Sem dopln slova ktore ta napadnu :D
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

?>


