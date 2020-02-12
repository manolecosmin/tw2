<?php
mysql_connect("localhost","root","");
mysql_select_db("Logistica");
if (isset($_POST["BA"])) {
   header("location:locatii.php");
   exit;
}
if (isset($_POST["BS"])) {
   if ($_POST["LCID"] == 0) {
      $qpr="INSERT INTO locatii VALUES('','".strtoupper($_POST["DEN"])."','".$_POST["ADR"]."')";
   } else {
      $qpr="UPDATE locatii SET denumire='".strtoupper($_POST["DEN"])."', adresa='".$_POST["ADR"]."' WHERE id=".$_POST["LCID"];
   }
   mysql_query($qpr) or die(mysql_error());
   header("location:locatii.php");
   exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html><head>
<title>Locatie incarcare/descarcare</title>
<link rel="stylesheet" type="text/css" href="master.css">
</head>
<body background="../sami_bkw.jpg">
<center>
<p><font size='5' color='#a00000' face='Verdana'><b>Comanda transport extern</b></font></p>
<hr />
<form name="LCED" method="post">
<?php
echo "<input type='hidden' name='LCID' value='".$_GET["id"]."' />";
?>
<table width="520" cellpadding="2" bordercolor="#000000" cellspacing="2">
<tr valign="top" align="left">
<td width="150"><b>Locul incarcarii</b></td>
<td width="330"><input type='text' name='DEN' size='40' /></td></tr>
<tr valign="top" align="left">
<td width="150"><b>Adresa</b></td>
<td width="330"><textarea name='ADR' rows='3' cols='40'></textarea></td></tr>
</table>
<hr />
<input type="submit" name="BS" value="Salveaza" />&nbsp;&nbsp;&nbsp;<input type="submit" name="BA" value="Anuleaza" />
</form>

<?php
if ($_GET["id"] != 0) {
   $result = mysql_query("SELECT * FROM locatii WHERE id=".$_GET["id"]) or die(mysql_error());
   $row=mysql_fetch_row($result);
   echo "<script type='text/javascript'>\r\n document.LCED.DEN.value='".$row[1]."';\r\n";
   echo "document.LCED.ADR.value='".$row[2]."';\r\n</script>";
}
?>
</center>
</body></html>

