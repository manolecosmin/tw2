<?php
mysql_connect("localhost","root","");
mysql_select_db("logistica");

if (isset($_POST["LIMP"])) {
   $fpl=str_replace(chr(92), chr(92).chr(92), $_FILES['LFILE']['tmp_name']);
   if ($fpl != "") {
      mysql_query("TRUNCATE TABLE livrari") or die(mysql_error());
      mysql_query("LOAD DATA INFILE '".$fpl."' INTO TABLE livrari FIELDS TERMINATED BY '\t' LINES TERMINATED BY '\r\n' (@vclient, @vjud, produs, cantitate, @vdata, localit, judet, @vterm, moneda, pret, obs, confirmat, serienr, stoc, @linie,codmarfa,codgrupa,codag,agent) SET client=CONCAT(@vclient,\" - \",@vjud), data_cmd=STR_TO_DATE(@vdata, '%d.%m.%Y'), termen=STR_TO_DATE(@vterm, '%d.%m.%Y'), data_linie=STR_TO_DATE(@linie, '%d.%m.%Y')") or die("Import livrari : ".mysql_error());
	  mysql_query("UPDATE livrari set termen=data_linie where data_linie != '0000-00-00'") or die("Modificare date".mysql_error()); 
   }
   header("Location: planuri.php");
   exit;
}

if (isset($_POST["SIMP"])) {
   $fpl=str_replace(chr(92), chr(92).chr(92), $_FILES['SFILE']['tmp_name']);
   if ($fpl != "") {
      mysql_query("TRUNCATE TABLE stoc") or die(mysql_error());
      mysql_query("LOAD DATA INFILE '".$fpl."' INTO TABLE stoc FIELDS TERMINATED BY '\t' LINES TERMINATED BY '\r\n' (articol, um, stoc)") or die(mysql_error());
   }
   header("Location: planuri.php");
   exit;
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html><head>
<title>Import date</title>
<meta http-equiv="Content-Type" CONTENT="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="master.css" />
</head>
<body background="paper_bg.jpg">
<center>
<h2 style="margin-top: 60px">Import date</h2>
<hr class="dRed" />
<form method="POST" enctype="multipart/form-data" action="#"> 
<p style="display: block; margin-left: auto; margin-right: auto; width:420px; text-align: justify">
<b>Fisier Livrari :</b>&nbsp;<input type="file" name="LFILE" accept="text/plain" />
&nbsp;<input type="submit" name="LIMP" value="Importa" />
<br /><br />
<b>Fisier stoc :</b>&nbsp;<input type="file" name="SFILE" accept="text/plain" />
&nbsp;<input type="submit" name="SIMP" value="Importa" />
</p>
</form>
<hr class="dRed" />
</center>
</body></html>

