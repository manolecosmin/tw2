<html><head>
<title>Lista Soferi</title>
<link rel="stylesheet" type="text/css" href="master.css">

<script type="text/javascript">

function CliDel(vtrid, vid) {
if (confirm("Stergeti inregistrarea curenta ?")) {
   self.location = "trs_del.php?trid="+vtrid+"&id="+vid;
   return true;
} else 
   return false;
}
</script>

</head>
<body background="paper_bg.jpg">
<center>
<p><font size='4' color='#a0000'><b>Lista soferi | Transportator : <i>
<?php
mysql_connect("localhost","root","");
mysql_select_db("logistica");
$res=mysql_query("SELECT * FROM trasport WHERE id=".$_GET["id"]) or die(mysql_error());
$row=mysql_fetch_row($res);
echo $row[3]."</i></b></font>&nbsp;<a href='trs_edit.php?trid=".$_GET["id"]."&sid=0' class='btn'>Adauga Sofer</a></p>";
echo "<table border='1' cellspacing='0' cellpadding='2'>\r\n";
echo "<tr bgcolor='#f0f0f0'><td width='260' align='center'><b>Sofer</b></td><td width='80'><b>Tel</b></td><td width='30'><b>Del</b></td></tr>\r\n";
$result = mysql_query("SELECT * FROM trans_s ORDER BY sofer") or die(mysql_error());
while($row = mysql_fetch_row($result)) { 
   echo "<tr><td width='240' align='left'><a href='trs_edit.php?trid=".$_GET["id"]."&sid=".$row[0]."' class='mic'>".$row[2]."</a></td><td width='80'>".$row[3]."</td><td><a href='#' onclick='CliDel(".$_GET["id"].", ".$row[0].");'>x</a></td></tr>\r\n";
}
?>
</table>
<center>
</body></html>
