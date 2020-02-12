<html><head>
<title>Lista Nr.Auto</title>
<link rel="stylesheet" type="text/css" href="master.css" />

<script type="text/javascript">

function CliDel(vtrid, vid) {
if (confirm("Stergeti inregistrarea curenta ?")) {
   self.location = "tra_del.php?trid="+vtrid+"&id="+vid;
   return true;
} else 
   return false;
}

</script>

</head>
<body background="../sami_bkw.jpg">
<center>
<p><font size='4' color='#a0000'><b>Lista auto | Transportator : <i>
<?php
mysql_connect("localhost","root","");
mysql_select_db("logistica");
$res=mysql_query("SELECT * FROM trasport WHERE id=".$_GET["id"]) or die(mysql_error());
$row=mysql_fetch_row($res);
echo $row[3]."</i></b></font>&nbsp;<a href='tra_edit.php?trid=".$_GET["id"]."&aid=0' class='btn'>Adauga Auto</a></p>";
echo "<table border='1' cellspacing='0' cellpadding='2' >\r\n";
echo "<tr bgcolor='#f0f0f0'><td width='260' align='center'><b>Nr.Auto</b></td><td width='30'><b>Del</b></td></tr>\r\n";
$result = mysql_query("SELECT * FROM trans_a ORDER BY nr_auto") or die(mysql_error());
while($row = mysql_fetch_row($result)) { 
   echo "<tr><td width='240' align='left'><a href='tra_edit.php?trid=".$_GET["id"]."&aid=".$row[0]."' class='mic'>".$row[2]."</a></td><td><a href='#' onclick='CliDel(".$_GET["id"].", ".$row[0].");'>x</a></td></tr>\r\n";
}
?>
</table>
<center>
</body></html>
