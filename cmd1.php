<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<title>Comanda transport extern</title>
<link rel="stylesheet" type="text/css" href="master.css">
</head>
<body background="../sami_bkw.jpg">
<center>
<p><font size='5' color='#a00000' face='Verdana'><b>Comanda transport extern</b></font></p>
<hr />
<form name="cmded" method="post" action="cmd_tr_ext.php" target="_blank">
<?php
echo "<input type='hidden' name='TRID' value='".$_GET["id"]."' />";
?>
<table width="520" cellpadding="2" cellspacing="2">
<tr valign="top" align="left">
<td colspan="2"><textarea name="ANT" rows="4" cols="60">
Prin prezenta va comandam ferm o masina pentru transport marfa 22 tone, cu platforma dreapta cu lungimea minima de 13.6 m, inaltimea de 2.7 metri, latimea de 2.46 m, prevazut cu chingi(min.6) si scanduri pt. asigurarea marfii, in urmatoarele conditii :</textarea></td></tr>
<tr valign="top" align="left">
<td width="150"><b>Locul incarcarii</b></td>
<td width="230">
<?php
mysql_connect("localhost","root","");
mysql_select_db("Logistica");
echo "<select name='DEST1' size='1'>";
echo "<option value='0'>-----</option>";
$result = mysql_query("SELECT * FROM locatii ORDER BY denumire") or die(mysql_error());
while ($row=mysql_fetch_row($result)) {
   echo "<option value='".$row[0]."'>".$row[1]."</option>";
}
echo "</select>\r\n";
echo "<select name='DEST2' size='1'>";
echo "<option value='0'>-----</option>";
$result = mysql_query("SELECT * FROM locatii ORDER BY denumire") or die(mysql_error());
while ($row=mysql_fetch_row($result)) {
   echo "<option value='".$row[0]."'>".$row[1]."</option>";
}
echo "</select>\r\n";
echo "<select name='DEST3' size='1'>";
echo "<option value='0'>-----</option>";
$result = mysql_query("SELECT * FROM locatii ORDER BY denumire") or die(mysql_error());
while ($row=mysql_fetch_row($result)) {
   echo "<option value='".$row[0]."'>".$row[1]."</option>";
}
echo "</select>\r\n";
echo "<select name='DEST4' size='1'>";
echo "<option value='0'>-----</option>";
$result = mysql_query("SELECT * FROM locatii ORDER BY denumire") or die(mysql_error());
while ($row=mysql_fetch_row($result)) {
   echo "<option value='".$row[0]."'>".$row[1]."</option>";
}
echo "</select>\r\n";
?>
</td>
</tr>
<tr valign="top" align="left">
<td width="150"><b>Data/Ora incarcarii</b></td>
<td width="230"><input type="text" name="DT" size="10" />&nbsp;<input type="text" name="OT" size="10" /></td>
</tr>
<tr valign="top" align="left">
<td width="150"><b>Marfa</b></td>
<td width="230"><input name="MARFA" size="40" type="text" /></td>
</tr>
<tr valign="top" align="left">
<td width="150"><b>Tarif</b></td>
<td width="230"><input type="text" name="TR" size="10" /></td>
</tr>
<tr valign="top" align="left">
<td width="150"><b>Mod de plata</b></td>
<td width="230"><input type="text" name="MP" size="40" /></td>
</tr>
<tr valign="top" align="left">
<td width="150"><b>Nr.camion</b></td>
<td width="230"><input type="text" name="CM" size="20" /></td>
</tr>
</table>
<hr />
<input type="submit" name="BS" value="Genereaza" OnClick="javascript:self.location='transp.php'" />&nbsp;&nbsp;&nbsp;<input type="submit" name="BA" value="Anuleaza" OnClick="javascript:self.location='transp.php'" />
</form>
</center>
</body></html>

