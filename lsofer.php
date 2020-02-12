<html><head>
<title>Lista Soferi</title>
<link rel="stylesheet" type="text/css" href="master.css">

<script type="text/javascript">

function SelSof( vs, vt) {
   window.opener.plhed.SOFER.value=vs;
   window.opener.plhed.TEL.value=vt;
   window.close();
   window.opener.blur();
}

</script>

</head>
<body bgcolor="#F0F0FF">
<center>
<p><font size='3' color='#a0000'><b>Transportator :<br />
<?php
mysql_connect("localhost","root","");
mysql_select_db("logistica");
$res=mysql_query("SELECT * FROM trasport WHERE id=".$_GET["id"]) or die(mysql_error());
$row=mysql_fetch_row($res);
echo $row[3]."</b></font></p>";
?>
<table border="1" cellspacing="1">
<tr bgcolor="#f0f0f0"><td width="260" align="center"><b>Sofer</b></td><td width="80"><b>Tel</b></tr>
<?php
$result = mysql_query("SELECT * FROM trans_s ORDER BY sofer") or die(mysql_error());
while($row = mysql_fetch_row($result)) { 
   echo "<tr><td width='240' align='left'><a href='#' onclick=\"javascript: SelSof('".$row[2]."', '".$row[3]."');return true;\" class='mic'>".$row[2]."</a></td><td width='80'>".$row[3]."</tr>\r\n";
}
?>
</table>
<center>
</body></html>
