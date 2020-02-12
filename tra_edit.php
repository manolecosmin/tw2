<?php
mysql_connect("localhost","root","");
mysql_select_db("logistica");
//
if (isset($_POST["B2"])) {
   header("Location: trans_a.php?id=".$_POST["TRID"]);
   exit;
}
if (isset($_POST["B1"])) {
   if ($_POST["AID"] == 0)
      $qpr="INSERT INTO trans_a VALUES('', ".$_POST["TRID"].", '".$_POST["AT"]."')";
   else
      $qpr="UPDATE trans_a SET nr_auto='".strtoupper($_POST["AT"])."' WHERE id=".$_POST["AID"];
   mysql_query($qpr) or die(mysql_error());
   header("Location: trans_a.php?id=".$_POST["TRID"]);
   exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html><head>
<meta http-equiv="content-type" content="text/html; charset=windows-1252" />
<link rel="stylesheet" ref="master.css" />
<title>Client</title>
</head>
<body>
<center><form method="post">
<?php
echo "<input type='hidden' name='TRID' VALUE='".$_GET["trid"]."' />";
echo "<input type='hidden' name='AID' VALUE='".$_GET["aid"]."' />";
$res=mysql_query("SELECT * FROM trasport WHERE id=".$_GET["trid"]) or die(mysql_error());
$row=mysql_fetch_row($res);
if ($_GET["aid"] == 0) {
   echo "<p style='margin-left:10px'><b> Auto nou la ".$row[3]."</b><br />\r\n";
   echo "<b>Auto nr.  :</b> <input type='text' size='10' name='AT'></p>";
} else {
   echo "<p style='margin-left: 10px'><b> Auto la ".$row[3]."</b><br />\r\n";
   $res=mysql_query("SELECT * FROM trans_a WHERE id=".$_GET["aid"]) or die(mysql_error());
   $row=mysql_fetch_row($res);
   echo "<b>Auto nr.  :</b> <input type='text' size='10' name='AT' value='".$row[2]."'></p>";
}
?>
<hr /> 
<input type="submit" name="B1" value="Salvez" />&nbsp;<input type="submit" name="B2" value="Anulez" />
</form></center>
</body></html>
