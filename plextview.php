<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<title>Plan incarcare Fitinguri</title>
<link rel="stylesheet" type="text/css" href="master.css">
<style type="text/css">
	<!--
		@page { size: 29.70cm 21.00cm; margin-left: 0.1cm; margin-right: 0.5cm; margin-top: 0.40cm; margin-bottom: 1.4cm }
	-->
</style>

<script language="JavaScript" type="text/javascript" src="http://sami-server/js_lib/dtpick.js"></script>
<script tyle="text/javascript">
function ConfDel(vid, vpid) {
if (confirm("Stergeti inregistrarea curenta ?")) {
   self.location="plan_del.php?id="+vid+"&pid="+vpid;
   return true;
} else 
   return false;
}
</script>

</head>
<body>
<center>
<p style="margin: 2px; padding: 2px;"><font size='4' color='#a00000' face='Verdana'><b>Plan de incarcare Intern</b></font></p>
<hr style="margin: 1px 1px 1px 1px;" />
<?php
mysql_connect("localhost","root","");
mysql_select_db("Logistica");
echo "<input type='hidden' name='ID' value='".$_GET["id"]."' />";
$res=mysql_query("SELECT * FROM plan_hdr_ext WHERE id=".$_GET["id"]) or die(mysql_error());
$row=mysql_fetch_row($res);
echo "<p style='margin: 2px; padding: 2px;'><b>Data : </b>".$row[1]." <b>Transportator : </b>";
$result = mysql_query("SELECT * FROM trasport WHERE id=".$row[2]) or die(mysql_error());
$rw=mysql_fetch_row($result);
echo "<b><i>".$rw[3]."</i> Auto nr. </b>".$row[3]." <b>Sofer : </b>".$row[4]." <b>Tel. </b>".$row[5]."<br />";
echo "<b>Km : </b>".$row[6]." <b>Pret/Km : </b>".$row[7]." RON "." - <b>Valoare Transport : <b>";
$valtr=$row[7]*$row[6];
$cursv=$row[8];
echo $valtr." RON</p><hr/>";
mysql_free_result($result);
mysql_free_result($res);
?>
<table border="1" cellspacing="0" cellpadding="2" width="1100" style>
<tr bgcolor="#F0F0F0">
<td align="center" width="180"><b>Client : </b></td>
<td align="center" width="220"><b>Produs</b></td>
<td align="center" width="60"><b>Cantitate</b></td>
<td align="center" width="30"><b>Desc.</b></td>
<td align="center" width="160"><b>Livrare la</b></td>
<td align="center" width="64"><b>Data livrarii</b></td>
<td align="center" width="64"><b>Data cmd.</b></td>
<td align="center" width="30"><b>MON</b></td>
<td align="center" width="64"><b>P.U.</b></td>
<td align="center" width="64"><b>Val.RON</b></td>
<td align="center" width="80"><b>Doc.</b></td>
</tr>
<?php
$tval=0;
$res=mysql_query("SELECT * FROM plan_ext WHERE pid=".$_GET["id"]." ORDER BY dord DESC") or die(mysql_error());
while ($row=mysql_fetch_row($res)) {
   echo "<tr valign='top'>";
   echo "<td align='left' width='180'><a href='plan_ext_edit.php?pid=".$_GET["id"]."&id=".$row[0]."' class='sml'>".$row[2]."</a></td>";
   echo "<td align='left' width='220'>".$row[3]."</td>";
   echo "<td align='right' width='60'>".$row[4]."</td>";
   echo "<td align='center' width='30'>".$row[5]."</td>";
   echo "<td align='left' width='160'>".$row[6]."</td>";
   echo "<td align='center' width='64'>".strftime("%d.%m.%Y", strtotime($row[7]))."</td>";
   echo "<td align='center' width='64'>".strftime("%d.%m.%Y", strtotime($row[9]))."</td>";
   echo "<td align='center' width='30'>".$row[8]."</td>";
   echo "<td align='right' width='64'>".$row[10]."</td>";
   if ($row[8] == "EUR") {
      $val=$row[4] * $row[10] * $cursv;
   } else {
      $val=$row[4] * $row[10];
   }
   $tval+=$val;
   echo "<td align='right' width='64'>".round($val,2)."</td>";
   echo "<td align='right' width='80'>".$row[12]."</td>";
   echo "</tr>\r\n";
}
echo "</table>\r\n";
echo "<p><b> Valoare totala : </b>".Round($tval,2)." RON (".round($valtr/($tval/100),2)." %).</p>";
?>
</center>
<p style="margin-left : 2cm; font-family: Arial; font-size: 10pt; font-weight: bold;"><br />
<b>Responsabil Comercial : _____________________________________________________ <br/>
<b>Responsabil Logistica : _____________________________________________________ <br/>
<b>Responsabil Recuperare Credite :_____________________________________________ <br/>
</p>
</body></html>

