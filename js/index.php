<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.autocomplete.js"></script>
<script>
 $(document).ready(function(){
  $("#priez").autocomplete("autocomplete.php", {
         selectFirst: false,
		 minLength:2,
		 minChars:2,
  });
 });
</script>
</head>
<body>
<label>Tag:</label>
<input name="tag" type="text" id="priez" size="20" width="200"/>
</body>
</html>