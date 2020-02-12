<?php
mysql_connect("localhost","root","");
mysql_select_db("logistica");
//
if (isset($_POST["B2"])) {
   header("Location: trans_s.php?id=".$_POST["TRID"]);
   exit;
}
if (isset($_POST["B1"])) {
   if ($_POST["SID"] == 0)
      $qpr="INSERT INTO trans_s VALUES('', ".$_POST["TRID"].", '".$_POST["SF"]."', '".$_POST["TL"]."')";
   else
      $qpr="UPDATE trans_s SET sofer='".strtoupper($_POST["SF"])."', tel='".$_POST["TL"]."' WHERE id=".$_POST["SID"];
   mysql_query($qpr) or die(mysql_error());
   header("Location: trans_s.php?id=".$_POST["TRID"]);
   exit;
}
?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Client</title>
</head>
<body background="paper_bg.jpg">
<center><form method="post">
<?php
echo "<input type='hidden' name='TRID' VALUE='".$_GET["trid"]."' />";
echo "<input type='hidden' name='SID' VALUE='".$_GET["sid"]."' />";
$res=mysql_query("SELECT * FROM trasport WHERE id=".$_GET["trid"]) or die(mysql_error());
$row=mysql_fetch_row($res);
if ($_GET["sid"] == 0) {
   echo "<p style='margin-left:10px'><b>Sofer nou la ".$row[3]."</b><br />\r\n";
   echo "<b>Numele :</b> <input type='text' size='32' name='SF'>&nbsp;<b>Tel.</b> <input type='text' size='14' name='TL'></p>";
} else {
   echo "<p style='margin-left: 10px'><b> Sofer la ".$row[3]."</b><br />\r\n";
   $res=mysql_query("SELECT * FROM trans_s WHERE id=".$_GET["sid"]) or die(mysql_error());
   $row=mysql_fetch_row($res);
   echo "<b>Numele :</b> <input type='text' size='32' name='SF' value='".$row[2]."' />&nbsp;<b>Tel.</b> <input type='text' size='14' name='TL' value='".$row[3]."' /></p>";
}
?>
<hr /> 
<input type="submit" name="B1" value="Salvez" />&nbsp;<input type="submit" name="B2" value="Anulez" />
</form></center>
</body></html>
