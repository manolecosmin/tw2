<?php
mysql_connect("localhost", "root", "");
mysql_select_db("logistica");


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
<style>
@media print{
	.noprint{
		display: none;
	}
}

</style>
</head>
<body>
<a class="noprint" href="#Top" style="position: fixed; bottom: 10px; right: 10px; background: 0px;"><img src="img/go_top.png" style="width: 30px; height: 30px;"></a>
<h2>Planuri de incarcare Intern &nbsp;<a href="imp-livrari.php" class="btn">Importa date</a> | <a href='pl_hdr.php?id=0' class='btn'>Adaugare</a></h2>
<center>
<table border="1" cellspacing="0" cellpadding="2">
<tr style="background-color: #f0f0f0">
<td align="center" width="110"><b>Status Masina</b></td>
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
<td align="center" width="40"><b>Repart</b></td>
<td align="center" width="40"><b>Validare</b></td>
<td align="center" width="40"><b>Del</b></td>
</tr>
<?php

if(isset($_GET['id']))
{
	
	if($_GET['status'] === "66"){
		header('Location: 192.168.1.251/L091234568767/planuri.php');
	}
	
	if(isset($_GET['status'])&& $_GET['status'] == 3 && !is_null($_GET['message']) && !trim($_GET['message']) !== ""){
		$query = "INSERT INTO denial_reason(id_transport, mesaj) VALUES(".$_GET['id'].",'".$_GET['message']."' )";
		
		$state = mysql_query($query);
	}
	
	mysql_query("UPDATE plan_hdr SET validare=".$_GET['status']." WHERE id=".$_GET['id'].";");
}
$res=mysql_query("SELECT plan_hdr.*, trasport.den FROM plan_hdr LEFT JOIN trasport ON plan_hdr.tr_id = trasport.id WHERE plan_hdr.inchis<>9 ORDER BY plan_hdr.data DESC") or die(mysql_error());
while ($row=mysql_fetch_row($res)) {
   $dd=strtotime($row[1]);
   $dt=strtotime("+15 day", $dd);
   
   
   if ($dt <= strtotime(date("d.m.Y")) ) {
      echo "<tr valign='top' bgcolor='#FFE0E0'>";
   } else {
	  if ($row[17] == 2) {
		echo "<tr valign='top' class='green-background'>";
	  } else {
		echo "<tr valign='top'>";
	  }
	  
   }
  if ($row[16]==2)   {
      echo "<tr valign='top' bgcolor='#FA58F4'>";
   } else {
	   if ($row[17] == 2) {
		echo "<tr valign='top' class='green-background'>";
	  }  else {
      echo "<tr valign='top'>";
	  }
   }
if ($row[17] == 1)
      echo "<td valign='middle' align='Center' width='110'>Schita incarcare</td>"; 
if ($row[17] == 2)
      echo "<td valign='middle' align='Center' width='110' body style='background:linear-gradient(to bottom, #66ff66 0%, #ffffff 60%)'>Pentru Validare</td>"; 
if ($row[17] == 3)
      echo "<td valign='middle' align='Center' width='110'>Comanda la transportator</td>"; 
if ($row[17] == 4)
      echo "<td valign='middle' align='Center' width='110'>Transport confirmat</td>"; 
if ($row[17] == 5)
      echo "<td valign='middle' align='Center' width='110'>Masina Confirmata</td>"; 
if ($row[17] == 6)
      echo "<td valign='middle' align='Center' width='110'>Transport Livrat</td>"; 
   echo "<td align='left' width='70'>".strftime("%d.%m.%Y", $dd )."</td>";
   echo "<td align='left' width='40'>".$row[0]."</td>";
    if ($row[15] == 0)
   echo "<td align='center' width='60'><img src='img/truck.jpg' style='height: 30px; width: 40px; margin: 0;' alt='TIR'></td>";
  if ($row[15] == 1)
   echo "<td align='center' width='60'><img src='img/export.png' style='height: 30px; width: 40px; margin: 0;' alt='EXPORT'></td>";
if ($row[15] == 2)
   echo "<td align='center' width='60'><img src='img/camion.png' style='height: 30px; width: 30px; margin: 0;' alt='CAMION'></td>";
  if ($row[15] == 3)
   echo "<td align='center' width='60'><img src='img/client.png' style='height: 30px; width: 40px; margin: 0;' alt='CLIENT'></td>";
  if ($row[15] == 4)
   echo "<td align='center' width='60'><img src='img/schenker.png' style='height: 30px; width: 40px; margin: 0;' alt='GRUPAJ'></td>";
  if ($row[15] == 5)
   echo "<td align='center' width='60'><img src='img/fan_courier.png' style='height: 30px; width: 40px; margin: 0;' alt='CURIER'></td>";
 if ($row[15] == 6)
   echo "<td align='center' width='60'><img src='img/import.png' style='height: 30px; width: 40px; margin: 0;' alt='CURIER'></td>";
   echo "<td align='left' width='220'><a href='pl_hdr.php?id=".$row[0]."' class='sml'>".$row[21]."</a></td>";
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
if ($row[19] == 0)
   echo "<td align='center' valign='middle' width='40'><a href='repart_edit.php?id=".$row[0]."' class='sml'><img src='img/sutan.png' style='height: 20px; width: 20px; margin: 0;' alt='Repartizare'></td>";
else
   echo "<td align='center' valign='middle' width='40'><a href='repart_edit.php?id=".$row[0]."' class='sml'><img src='img/sutac.png' style='height: 20px; width: 20px; margin: 0;' alt='Repartizare'></td>";
if ($row[20] == 0)
   echo "<td align='center' valign='middle' width='40'><a href='laura.php?id=".$row[0]."' class='sml checkmark fade-green'><img src='img/validn.png' style='height: 20px; width: 20px; margin: 0;' alt='Validare'></td>";
if ($row[20] == 1)
   echo "<td align='center' valign='middle' width='40'><a href='laura.php?id=".$row[0]."' class='sml'><img src='img/validc.png' style='height: 20px; width: 20px; margin: 0;' alt='Validare'></td>";
if ($row[20] == 2)
   echo "<td align='center' valign='middle' width='40'><a href='laura.php?id=".$row[0]."' class='sml'><img src='img/respins.png' style='height: 20px; width: 20px; margin: 0;' alt='Validare'>";
if ($row[20] == 3)
   echo "<td align='center' valign='middle' width='40'><a href='laura.php?id=".$row[0]."' class='sml'><img src='img/validn.png' style='height: 20px; width: 20px; margin: 0;' alt='Validare'></td>";

   echo "<td valign='middle' align='center' width='30'><a href='#' onclick='javascript:ConfDel(".$row[0].");' class='sml'> <img src='img/st.png' style='height: 15px; width: 15px; margin: 0;' alt='Sterge'></a></td>";
   
   echo "</tr>\r\n";
}
?>
</table>
</center>
</body></html>

