<?php
$conn_dtb=mysqli_connect($_SERVER['SERVER_ADDR'], "root", "", "Logistica");
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
<tr style="font-size: 20px">
<th colspan="7">Doc. transport</th>
<th colspan="5">Doc. insotire marfa</th>
</tr>
<tr style="background-color: #f0f0f0">
<td align="center" width="70"><b>Data </b></td>
<td align="center" width="40"><b>Nr FI </b></td>
<td align="center" width="60"><b>TIP TR</b></td>
<td align="center" width="220"><b>Transportator</b></td>
<!--
<td align="center" width="70"><b>Auto</b></td>
<td align="center" width="140"><b>Sofer</b></td>
<td align="center" width="80"><b>Tel</b></td>
<td align="center" width="180"><b>Destinatie</b></td>

-->
<!--
<td align="center" width="70"><b>Km</b></td>
<td align="center" width="70"><b>Pret/km</b></td>
<td align="center" width="70"><b>Curs V.</b></td>
<td align="center" width="140"><b>Factura</b></td>
-->
<td align="center" width="50"><b>Valoare transport</b></td>
<!--
<td align="center" width="60"><b>Valuta</b></td>
-->
<td align="center" width="40"><b>Nr. clienti</b></td>
<td align="center" width="90" style='border-right: 2px solid red;'><b>Valoare totala RON</b></td>
<td align="center" width="60"><b>Nr. document</b></td>
<td align="center" width="30"><b>Seria</b></td>
<td align="center" width="60"><b>Data document</b></td>
<td align="center" width="60"><b>Client</b></td>
<td align="center" width="90"><b>Valoare document</b></td>
</tr>
<?php
$res=mysqli_query($conn_dtb, "SELECT ph.`data`, ph.id, ph.TMOD, tr.den, ph.pret_km, de.nr_doc, de.sn, de.data_doc, de.`client`, de.val_doc, cursv FROM plan_hdr ph JOIN trasport tr ON ph.tr_id=tr.id LEFT OUTER JOIN doc_erp de ON ph.id=de.id_tr WHERE ph.inchis<>9 ORDER BY ph.`data` DESC, ph.id") or die(mysql_error());
$valori=mysqli_fetch_all($res, MYSQLI_NUM);
mysqli_free_result($res);
$i=0;
$GLOBALS['last_fi']=0;
while (isset($valori[$i][1])){
	if($GLOBALS['last_fi']==$valori[$i][1]){
		echo "<tr>";
		echo "<td style='border-top: 0px; border-bottom: 0px;'> &nbsp </td>";
		echo "<td style='border-top: 0px; border-bottom: 0px;'> &nbsp </td>";
		echo "<td style='border-top: 0px; border-bottom: 0px;'> &nbsp </td>";
		echo "<td style='border-top: 0px; border-bottom: 0px;'> &nbsp </td>";
		echo "<td style='border-top: 0px; border-bottom: 0px;'> &nbsp </td>";
		echo "<td style='border-top: 0px; border-bottom: 0px;'> &nbsp </td>";
		echo "<td style='border-top: 0px; border-bottom: 0px; border-right: 2px solid red;'> &nbsp </td>";
		echo "<td align='right' width='70'>".$valori[$i][5]."</td>";
	   echo "<td align='left' width='70'>".$valori[$i][6]."</td>";
	   echo "<td align='left' width='70'>".$valori[$i][7]."</td>";
	   echo "<td align='left' width='180'>".$valori[$i][8]."</td>";
	   echo "<td align='right' width='60'>".$valori[$i][9]."</td></tr>";
	}
	else{	
		$GLOBALS['last_fi']=$valori[$i][1];
	   $dd=strtotime($valori[$i][0]);
	   $dt=strtotime("+15 day", $dd);
	   if ($dt <= strtotime(date("d.m.Y")) ) {
		  echo "<tr valign='top' bgcolor='#FFE0E0'>";
	   } else {
		  echo "<tr valign='top'>";
	   }

	   echo "<td align='left' width='70' style='border-bottom: 0px; border-top: 2px solid black; '>".strftime("%d.%m.%Y", $dd )."</td>";
		  echo "<td align='left' width='40' style='border-bottom: 0px; border-top: 2px solid black;'>".$valori[$i][1]."</td>";
		if ($valori[$i][2] == 0)
	   echo "<td align='center' width='60' style='border-bottom: 0px; border-top: 2px solid black;'>".'TIR'."</td>";
	  if ($valori[$i][2] == 1)
	   echo "<td align='center' width='60' style='border-bottom: 0px; border-top: 2px solid black;'>".'EXPORT'."</td>";
	if ($valori[$i][2] == 2)
	   echo "<td align='center' width='60' style='border-bottom: 0px; border-top: 2px solid black;'>".'CAMION'."</td>";
	  if ($valori[$i][2] == 3)
	   echo "<td align='center' width='60' style='border-bottom: 0px; border-top: 2px solid black;'>".'CLIENT'."</td>";
	  if ($valori[$i][2] == 4)
	   echo "<td align='center' width='60' style='border-bottom: 0px; border-top: 2px solid black;'>".'GRUPAJ'."</td>";
	  if ($valori[$i][2] == 5)
	   echo "<td align='center' width='60' style='border-bottom: 0px; border-top: 2px solid black;'>".'CURIER'."</td>";
	   echo "<td align='left' width='220' style='border-bottom: 0px; border-top: 2px solid black;'><a href='pl_hdr.php?id=".$valori[$i][1]."' class='sml'>".$valori[$i][3]."</a></td>";
	   echo "<td align='right' style='border-bottom: 0px; border-top: 2px solid black;' width='70'>".$valori[$i][4]."</td>";
	   $result=mysqli_query($conn_dtb, "SELECT COUNT(DISTINCT `client`), SUM(if(LOCATE('E', moneda)=1 ,cant * pret * plan_hdr.cursv, cant * pret)) Suma FROM plan, plan_hdr WHERE pid='".$valori[$i][1]."' AND plan.pid=plan_hdr.id GROUP BY pid");
	   $row=mysqli_fetch_row($result);
		echo "<td align='right' width='60' style='border-bottom: 0px; border-top: 2px solid black;'>".$row[0]."</td>";
		echo "<td align='right' width='60' style='border-bottom: 0px; border-top: 2px solid black; border-right: 2px solid red;'>".number_format($row[1], 2)."</td>";
	   mysqli_free_result($result);
	   echo "<td align='right' width='70' style='border-top: 2px solid black;'>".$valori[$i][5]."</td>";
	   echo "<td align='left' width='70' style='border-top: 2px solid black;'>".$valori[$i][6]."</td>";
	   echo "<td align='left' width='70' style='border-top: 2px solid black;'>".$valori[$i][7]."</td>";
	   echo "<td align='left' width='180' style='border-top: 2px solid black;'>".$valori[$i][8]."</td>";
	   echo "<td align='right' width='60' style='border-top: 2px solid black;'>".$valori[$i][9]."</td>";
	/*
	   echo "<td align='left' width='80'>".$row[6]."</td>";
	   echo "<td align='left' width='70'>".$row[7]."</td>";
	   echo "<td align='left' width='70'>".$row[8]."</td>";
	   echo "<td align='right' width='140'>".$row[9]."</td>";
	*/ 
	/*   if ($row[10] == 0)
	   echo "<td align='center' width='60'>".'LEI'."</td>";
	  if ($row[10] == 1)
	   echo "<td align='center' width='60'>".'EURO'."</td>";
	  if ($row[10] == 2)
	   echo "<td align='center' width='60'>".'USD'."</td>";
	  if ($row[10] == 3)
	   echo "<td align='center' width='60'>".'LEI'."</td>";
	  if ($row[10] == 4)
	   echo "<td align='center' width='60'>".'LEI'."</td>";
	*/
	   echo "</tr>\r\n";
	}
	$i++;
}
?>
</table>
</center>
</body></html>

