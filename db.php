<?php 
	if($_SERVER['REQUEST_URI'] != "/db.php"){
		
	DEFINE('DB_UZIVATEL','vypalovac');
	DEFINE('DB_HESLO','012345napalilima');
	DEFINE('DB_HOSTITEL','localhost:/tmp/mysql51.sock');
	DEFINE('DB_DATABAZA','data_napalilima');

	if(mysql_connect(DB_HOSTITEL,DB_UZIVATEL,DB_HESLO)) {
		if(!mysql_select_db(DB_DATABAZA)) {
			echo'Webovy server je nedostupný!';
			exit();
		}				
		}else {
			echo'Nepodarilo sa pripojit k databaze.';
			exit();
		}
	}
	else{header("Location: index.php");}

?>
