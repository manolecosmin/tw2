<?php
mysql_connect("localhost", "root", "");
mysql_select_db("Logistica");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<title>Plan incarcare intern</title>
<link rel="stylesheet" type="text/css" href="master.css">
<script language="JavaScript" type="text/javascript" src="/js_lib/dtpick.js"></script>
<script type="text/javascript">

function ConfDel(vid, vpid) {
if (confirm("Stergeti inregistrarea curenta ?\r\nAtentie! Operatie ireversibila !...")) {
   self.location="pl_del.php?id="+vid;
   return true;
} else 
   return false;
}
</script>
</head>
<body>
<h2>Planuri de incarcare Intern &nbsp;<a href="imp-livrari.php" class="btn">Importa date</a> | <a href='pl_hdr.php?id=0' class='btn'>Adaugare</a></h2>
<center>
<table border="1" cellspacing="0" cellpadding="2">
<tr style="background-color: #f0f0f0">
<td align="center" width="70"><b>Data </b></td>
<td align="center" width="40"><b>Nr FI </b></td>
<td align="center" width="60"><b>TIP TR</b></td>
<td align="center" width="220"><b>Transportator</b></td>
<td align="center" width="70"><b>Auto</b></td>
<td align="center" width="140"><b>Sofer</b></td>
<td align="center" width="80"><b>Tel</b></td>
<td align="center" width="180"><b>Destinatie</b></td>
<!--
<td align="center" width="70"><b>Km</b></td>
<td align="center" width="70"><b>Pret/km</b></td>
<td align="center" width="70"><b>Curs V.</b></td>
<td align="center" width="140"><b>Factura</b></td>
-->
<td align="center" width="60"><b>Valoare</b></td>
<td align="center" width="60"><b>Valuta</b></td>
<td align="center" width="40"><b>Del</b></td>
</tr>
<?php
$res=mysql_query("SELECT plan_hdr.*, trasport.den FROM plan_hdr LEFT JOIN trasport ON plan_hdr.tr_id = trasport.id WHERE plan_hdr.inchis<>9 ORDER BY plan_hdr.data DESC") or die(mysql_error());
while ($row=mysql_fetch_row($res)) {
   $dd=strtotime($row[1]);
   $dt=strtotime("+15 day", $dd);
   if ($dt <= strtotime(date("d.m.Y")) ) {
      echo "<tr valign='top' bgcolor='#FFE0E0'>";
   } else {
      echo "<tr valign='top'>";
   }

   echo "<td align='left' width='70'>".strftime("%d.%m.%Y", $dd )."</td>";
      echo "<td align='left' width='40'>".$row[0]."</td>";
    if ($row[15] == 0)
   echo "<td align='center' width='60'>".'TIR'."</td>";
  if ($row[15] == 1)
   echo "<td align='center' width='60'>".'EXPORT'."</td>";
if ($row[15] == 2)
   echo "<td align='center' width='60'>".'CAMION'."</td>";
  if ($row[15] == 3)
   echo "<td align='center' width='60'>".'CLIENT'."</td>";
  if ($row[15] == 4)
   echo "<td align='center' width='60'>".'GRUPAJ'."</td>";
  if ($row[15] == 5)
   echo "<td align='center' width='60'>".'CURIER'."</td>";
   echo "<td align='left' width='220'><a href='pl_hdr.php?id=".$row[0]."' class='sml'>".$row[16]."</a></td>";
   echo "<td align='left' width='70'>".$row[3]."</td>";
   echo "<td align='left' width='140'>".$row[4]."</td>";
   echo "<td align='left' width='80'>".$row[5]."</td>";
   echo "<td align='left' width='180'>".$row[11]."</td>";
   echo "<td align='left' width='60'>".$row[7]."</td>";
/*
   echo "<td align='left' width='80'>".$row[6]."</td>";
   echo "<td align='left' width='70'>".$row[7]."</td>";
   echo "<td align='left' width='70'>".$row[8]."</td>";
   echo "<td align='right' width='140'>".$row[9]."</td>";
*/ 
   if ($row[10] == 0)
   echo "<td align='center' width='60'>".'LEI'."</td>";
  if ($row[10] == 1)
   echo "<td align='center' width='60'>".'EURO'."</td>";
  if ($row[10] == 2)
   echo "<td align='center' width='60'>".'USD'."</td>";
  if ($row[10] == 3)
   echo "<td align='center' width='60'>".'LEI'."</td>";
  if ($row[10] == 4)
   echo "<td align='center' width='60'>".'LEI'."</td>";
   echo "<td align='center' width='30'><a href='#' onclick='javascript:ConfDel(".$row[0].");' class='sml'> x </a></td>";
   echo "</tr>\r\n";
}
?>
</table>
</center>
</body></html>

