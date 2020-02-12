<?php
mysql_connect("localhost","root","");
mysql_select_db("Logistica");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<title>Urmarire Comenzi</title>
<link rel="stylesheet" type="text/css" href="master.css" />
</head>
<body>
<center>
<form name="TDD" method="POST">
<p align="center"><font size="4" color="#A00000"><b>Urmarire Comenzi</b></font><br />
<b> Client : </b><select name="cli" size="1">
<?php
$res=mysql_query("SELECT DISTINCT client FROM livrari") or die(mysql_error());
while ($row=mysql_fetch_row($res)) {
   echo "<option value='".$row[0]."'>".htmlspecialchars($row[0])."</option>\r\n";
}
?>
</select>&nbsp;<input type="submit" name="F1" Value="Filtreaza" /><br />
<b> Produs : </b><input type="text" name="PDS" size="40" />
&nbsp;<input type="submit" name="F2" Value="Filtreaza" /></p>
</form>
<table border='1' cellpadding='4' cellspacing='0'>
<tr bgcolor="#F0F0F0">
<td align="center" width="160"><b>Client : </b></td>
<td align="center" width="220"><b>Produs</b></td>
<td align="center" width="70"><b>Cantitate</b></td>
<td align="center" width="160"><b>Livrare la</b></td>
<td align="center" width="70"><b>Data cmd.</b></td>
<td align="center" width="70"><b>Data livrarii</b></td>
<td align="center" width="40"><b>Moneda</b></td>
<td align="center" width="70"><b>P.U.</b></td>
<td align="center" width="70"><b>Valoare</b></td>
<td align="center" width="70"><b>Stoc</b></td>
<td align="center" width="70"><b>Confirmat</b></td>
</tr>
<?php
$qpr="SELECT livrari.*,stoc.stoc  FROM livrari LEFT JOIN stoc ON stoc.articol=livrari.produs";
if (isset($_POST["F1"])) {
   $qpr="SELECT livrari.*, stoc.stoc FROM livrari LEFT JOIN stoc ON stoc.articol=livrari.produs WHERE livrari.client='".$_POST["cli"]."'";
}
if (isset($_POST["F2"])) {
   $qpr="SELECT livrari.*, stoc.stoc FROM livrari LEFT JOIN stoc ON stoc.articol=livrari.produs WHERE livrari.produs like '".$_POST["PDS"]."%'";
}
$res=mysql_query($qpr) or die(mysql_error());
while ($row = mysql_fetch_row($res)) {
   echo "<tr><td align='left' width='160'>".htmlspecialchars($row[1])."</td>";
   echo "<td align='left' width='220'>".$row[2]."</td>";
   echo "<td align='right' width='70'>".$row[3]."</td>";
   echo "<td align='left' width='160'>".$row[5]."</td>";
   echo "<td align='center' width='70'>".strftime("%d.%m.%Y", strtotime($row[4]))."</td>";
   echo "<td align='center' width='70'>".strftime("%d.%m.%Y", strtotime($row[6]))."</td>";
   echo "<td align='center' width='40'>".$row[7]."</td>";
   echo "<td align='right' width='70'>".sprintf("%10.2f", $row[8])."</td>";
   echo "<td align='right' width='70'>".sprintf("%10.2f", $row[8] * $row[3])."</td>";
   echo "<td align='right' width='70'>".$row[10]."</td>";
   echo "<td align='right' width='70'>".$row[9]."</td>";
   echo "</tr>\r\n";
}
?>
</table>
</center>
</body></html>
