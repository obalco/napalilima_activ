<?php
/*
@premenne 
	$input 	 = premenná, ktorú chceme validova udávaná v string
	$min_len = minimálna dåka reazca udávaná v integer
	$max_len = maximnálna dåka reazca udávaná v integer
	$check   = názov èo ideme validova ('pass','nick','mail'), udávaná v string

*/
function val_mail($input, $min='10', $max='50'){
	
	$ok=false;

		if(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $input)){
			$ok = true;
		} 
		else 
		{
			$ok = false;
		}
	return $ok;
}

function val_pass($input, $min='6', $max='18'){

	$ok=false;

		if(preg_match("/^[a-z0-9_-]{".$min.",".$max."}$/", $input)){
			$ok = true;
		}
		else
		{
			$ok = false;
		}
	return $ok;

}

function val_nick($input, $min='3', $max='20'){

	$ok=false;

		if(preg_match("/^[a-zA-Z0-9_-]{".$min.",".$max."}$/", $input)){
			$ok = true;
		}
		else
		{
			$ok = false;
		}
	return $ok;

}

function val_claim($input, $min='3', $max='1000'){

	$ok=false;

		if((strlen($input)>$min) && (strlen($input)<$max)){
			$ok = true;					
		}
		else 
		{
			$ok = false;
		}
	return $ok;
}

function val_comment($input, $min='3', $max='1000'){

	$ok=false;

		if((strlen($input)>$min) && (strlen($input)<$max)){
			$ok = true;					
		}
		else 
		{
			$ok = false;
		}
	return $ok;
}

function val_who($input, $min='3', $max='100'){

	$ok=false;

		if((strlen($input)>=$min) && (strlen($input)<=$max)){
			$ok = true;					
		}
		else 
		{
			$ok = false;
		}
	return $ok;
}


function val_date($input){

	$ok=false;

		if (preg_match('/^\d{1,2}\.\d{1,2}\.\d{4}$/', $input)) { 
			$ok = true;					
		}
		else 
		{
			$ok = false;
		}
	return $ok;
}
 
		

?>