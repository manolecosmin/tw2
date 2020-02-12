<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html><head>
<title>Lista Nr.Auto</title>
<link rel="stylesheet" type="text/css" href="master.css" />

<script type="text/javascript">

function SelAuto( vid) {
   window.opener.plhed.AUTO.value=vid;
   window.close();
   window.opener.blur();
}

</script>

</head>
<body bgcolor="#F0F0FF">
<center>
<p><font size='4' color='#a0000'><b>Transportator :
<?php
mysql_connect("localhost","root","");
mysql_select_db("logistica");
$res=mysql_query("SELECT * FROM trasport WHERE id=".$_GET["id"]) or die(mysql_error());
$row=mysql_fetch_row($res);
echo $row[3];
?>
</b></font></p>
<table border='1' cellspacing='0'>
<tr bgcolor='#f0f0f0'><td width='260' align='center'><b>Nr.Auto</b></td></tr>
<?php
$result = mysql_query("SELECT * FROM trans_a ORDER BY nr_auto") or die(mysql_error());
while($row = mysql_fetch_row($result)) { 
   echo "<tr><td width='240' align='left'><a href='#' onclick=\"javascript: SelAuto('".$row[2]."');return true;\" class='mic'>".$row[2]."</a></td></tr>\r\n";
}
?>
</table>
<center>
</body></html>
