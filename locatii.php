<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html><head>
<title>Locatii incarcare/descarcare</title>
<link rel="stylesheet" type="text/css" href="master.css">

<script type="text/javascript">

function ConfDel(vid) {
if (confirm("Stergeti inregistrarea curenta ?")) {
   self.location = "locdel.php?id="+vid;
   return true;
} else 
   return false;
}

function TaskNou() {
self.location = "loc_edit.php?id=0";
}

</script>
</head>
<body background="/sami_bkw.jpg">
<center>
<p style="margin:4px;"><font size='5' color='#a00000' face='Verdana'><b>Locatii incarcare/descarcare</b></font>
&nbsp;<a href='loc_edit.php?id=0' class='btn'>Locatie noua</a>&nbsp;</p>
<hr />
<?php
echo "<table border='1' cellspacing='0'>";
echo "<tr bgcolor='#F0F0F0'><td width='240' align='center'><b>Denumire</b></td>";
echo "<td width='340' align='center'><b>Adresa</b></td>";
echo "<td width='30' align='center'><b>Del</b></td></tr>";
mysql_connect("localhost","root","");
mysql_select_db("Logistica");
$result = mysql_query("SELECT * FROM locatii ORDER BY denumire") or die(mysql_error());
while($row = mysql_fetch_row($result)) { 
   echo "<tr><td width='240' align='left'><a href='loc_edit.php?id=".$row[0]."' class='sml'>".$row[1]."</a></td>";
   echo "<td width='320' align='left'>".$row[2]."</td>";
   echo "<td width='30' align='center'><a href='#' OnClick='ConfDel(".$row[0].")' class='sml'>x</a></td></tr>\r\n";
}
echo "</table>";
?>
</center></body></html>
