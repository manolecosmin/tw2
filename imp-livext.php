<?php
mysql_connect("localhost","root","");
mysql_select_db("logistica");

if (isset($_POST["LIMP"])) {
   $fpl=str_replace(chr(92), chr(92).chr(92), $_FILES['LFILE']['tmp_name']);
   mysql_query("TRUNCATE TABLE livrari") or die(mysql_error());
   mysql_query("LOAD DATA INFILE '".$fpl."' INTO TABLE livrari_ext FIELDS TERMINATED BY ',' LINES TERMINATED BY '\r\n' (client, produs, cantitate, @vdata, @vterm, pret, moneda) SET data_cmd=STR_TO_DATE(@vdata, '%d.%m.%Y'), termen=STR_TO_DATE(@vterm, '%d.%m.%Y')") or die(mysql_error());
   header("Location: planext.php");
   exit;
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html><head>
<title>Import date</title>
<meta http-equiv="Content-Type" CONTENT="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="master.css" />
</head>
<body background="/sami_bkw.jpg">
<center>
<h2 style="border-top: 3px solid #f0f0f0; border-botom: 1px solid #ff0000; margin-top: 60px">Import date</h2><hr />
<form method="POST" enctype="multipart/form-data"> 
<p align="center"><b>Fisier Livrari :</b>&nbsp;<input type="file" name="LFILE" accept="text/plain" />
&nbsp;<input type="submit" name="LIMP" value="Importa" /></p>
</p><hr />
</form>
</center>
</body></html>

