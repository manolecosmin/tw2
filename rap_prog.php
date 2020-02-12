<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<title>Plan incarcare intern</title>
<link rel="stylesheet" type="text/css" href="master.css">
<style type="text/css">

.tMark {
   display:inline;
   font-family : Tahoma, Arial, sans-serif;
   font-size: 10pt;
   font-color: #00F000;
   font-weight: bold;
}

@media print{
	.noprint{
		display: none;
	}
}

</style>
<script language="JavaScript" type="text/javascript" src="/js_lib/dtpick.js"></script>
</head>
<body>
<a class="noprint" href="#Top" style="position: fixed; bottom: 10px; right: 10px; background: 0px;"><img src="img/go_top.png" style="width: 30px; height: 30px;"></a>
<center>
<p align="center" style="margin: 2px; padding: 2px;"><font size='4' color='#a00000' face='Verdana'><b>Raport Programari Transporturi</b></font></p>
<form name="LI" method="post" action="#">
<p align="center"><b>Perioada : </b>
<input type='text' name='DT1' size='10' /><a href="#" onclick="javascript:show_calendar('document.LI.DT1', document.LI.DT1.value);"><img src="/js_lib/cal.gif" width="16" height="16" border="0" alt='Selecteaza data' /></a>&nbsp;&nbsp;&divide;
<input type='text' name='DT2' size='10' /><a href="#" onclick="javascript:show_calendar('document.LI.DT2', document.LI.DT2.value);"><img src="/js_lib/cal.gif" width="16" height="16" border="0" alt='Selecteaza data' /></a>&nbsp;&nbsp;<input type='submit' name='F3' value='Filtreaza' />
<p>
<script type="text/javascript">document.LI.DT1.value="<?php echo date("d.m.Y");?>";</script>
<script type="text/javascript">document.LI.DT2.value="<?php echo (date("d.m.Y"));?>";</script>
</form>
<table border="1" cellspacing="0" cellpadding="2">
<tr bgcolor="#F0F0e0">
<td align="center" width="80"><b>Data</b></td>
<td align="center" width="80"><b>Tip</b></td>
<td align="center" width="80"><b>Nr. livrari</b></td>
<td align="center" width="130"><b>Val. incarcare</b></td>
<td align="center" width="130"><b>Val. transport</b></td>
<td align="center" width="40"><b>Incidenta</b></td>
</tr>
<?php
	if (isset($_POST["F3"])){
		$dti=substr($_POST["DT1"], 6, 4)."-".substr($_POST["DT1"], 3, 2)."-".substr($_POST["DT1"], 0, 2);
	    $dts=substr($_POST["DT2"], 6, 4)."-".substr($_POST["DT2"], 3, 2)."-".substr($_POST["DT2"], 0, 2);
	}else{
		$dti=date("Y-m-d");
		$dts=date("Y-m-d");
	} 	
   $conn_dtb=mysqli_connect("localhost","root","", "logistica");
   $res=mysqli_query($conn_dtb, "SELECT ph.data, ph.TMOD, COUNT(ph.TMOD), SUM(if(ph.inchis = 1 AND ph.cursv > 1, ph.pret_km * ph.cursv, if(ph.inchis = 1, ph.pret_km * 4.6, ph.pret_km))) FROM plan_hdr ph WHERE (ph.data BETWEEN '".$dti."' AND '".$dts."') AND ph.inchis <> 9 GROUP BY ph.data,ph.TMOD ORDER BY ph.data,ph.TMOD") or die(mysql_error());
   $row=mysqli_fetch_all($res);
   mysqli_free_result($res);
    $i=0;
   $tlivr=$tvalinc=$tvaltrans=0;
   while (isset($row[$i][0])){
      echo "<tr>\n";
      echo "<td align='center'>".$row[$i][0]."</td>";
      if ($row[$i][1] == 0)
		  echo "<td align='center' width='60' style='padding: 0;'><img src='img/truck.jpg' style='height: 30px; width: 40px; margin: 0;' alt='TIR'>";
		if ($row[$i][1] == 1)
		  echo "<td align='center' width='60' style='padding: 0;'><img src='img/export.png' style='height: 30px; width: 40px; margin: 0;' alt='EXPORT'>";
		if ($row[$i][1] == 2)
		  echo "<td align='center' width='60' style='padding: 0;'><img src='img/camion.png' style='height: 30px; width: 30px; margin: 0;' alt='CAMION'>";
		 if ($row[$i][1] == 3)
		  echo "<td align='center' width='60' style='padding: 0;'><img src='img/client.png' style='height: 30px; width: 40px; margin: 0;' alt='CLIENT'>";
		 if ($row[$i][1] == 4)
		  echo "<td align='center' width='60' style='padding: 0;'><img src='img/schenker.png' style='height: 30px; width: 40px; margin: 0;' alt='GRUPAJ'>";
		 if ($row[$i][1] == 5)
		  echo "<td align='center' width='60' style='padding: 0;'><img src='img/fan_courier.png' style='height: 30px; width: 40px; margin: 0;' alt='CURIER'>";
		 if ($row[$i][1] == 6)
		  echo "<td align='center' width='60' style='padding: 0;'><img src='img/import.png' style='height: 30px; width: 40px; margin: 0;' alt='CURIER'>";	  
      echo "<td align='right'>".$row[$i][2]."</td>";
	  $tlivr+=$row[$i][2];
	  $res=mysqli_query($conn_dtb, "SELECT SUM(if(LOCATE('E', moneda)=1 AND cursv > 1 ,cant * pret * cursv, if(LOCATE('E', moneda)=1, cant * pret * 4.8, if(LOCATE('OFL', moneda)=1, cant * pret * 4.8, cant * pret)))) FROM plan, plan_hdr WHERE plan_hdr.id=pid AND plan_hdr.TMOD = '".$row[$i][1]."' AND plan_hdr.data= '".$row[$i][0]."' AND plan_hdr.inchis <> 9");
	  $row2=mysqli_fetch_row($res);
      echo "<td align='right'>".number_format($row2[0], '2', '.', ',')." LEI</td>";
	  $tvalinc+=$row2[0];
      echo "<td align='right'>".number_format($row[$i][3], '2', '.', ',')." LEI</td>";
	  $tvaltrans+=$row[$i][3];
	  $lasuta=($row[$i][3]/$row2[0])*100;
      echo "<td align='right'>".number_format($lasuta, '2')."%</td>";
      echo "</tr>\n";
	  $i++;
	  mysqli_free_result($res);
   }
   $lasuta=($tvaltrans/$tvalinc)*100;
   echo "<tr><td colspan='2' align='center'><b>TOTAL: </b></td><td align='right'><b>".$tlivr."</b></td><td align='right'><b>".number_format($tvalinc, '2')." LEI</b></td><td align='right'><b>".number_format($tvaltrans, '2')." LEI</b></td><td align='right'><b>".number_format($lasuta, '2')."%</b></td></tr>";
   echo "</table>\r\n";
   if(isset($_POST['F3'])){
	echo "<script type='text/javascript'>document.LI.DT1.value='".$_POST["DT1"]."';</script>\r\n";
    echo "<script type='text/javascript'>document.LI.DT2.value='".$_POST["DT2"]."';</script>\r\n";
   }
?>
<table style="margin-top: 30px" border="1" cellspacing="0" cellpadding="2">
<tr style="background-color: #F0F0e0">
<td align="center" width="70"><b>Data </b></td>
<td align="center" width="40"><b>Nr FI </b></td>
<td align="center" width="60"><b>TIP TR</b></td>
<td align="center" width="220"><b>Transportator</b></td>
<td align="center" width="70"><b>Auto</b></td>
<td align="center" width="100"><b>Sofer</b></td>
<td align="center" width="80"><b>Tel</b></td>
<td align="center" width="140"><b>Destinatie</b></td>
<td align="center" width="140"><b>Status Plan Incarcare</b></td>

</tr>
<?php
   $res=mysqli_query($conn_dtb, "SELECT plan_hdr.*, trasport.den FROM plan_hdr LEFT JOIN trasport ON plan_hdr.tr_id = trasport.id WHERE plan_hdr.inchis<>9 AND (plan_hdr.data BETWEEN '".$dti."' AND '".$dts."') ORDER BY plan_hdr.data,plan_hdr.TMOD, plan_hdr.tr_id") or die(mysql_error());
   while ($row=mysqli_fetch_row($res)) {
     echo "<td align='left' width='70'>".$row[1]."</td>";
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
	   echo "<td align='left' width='220'>".$row[19]."</a></td>";
	   echo "<td align='left' width='70'>".$row[3]."</td>";
	   echo "<td align='left' width='140'>".$row[4]."</td>";
	   echo "<td align='left' width='80'>".$row[5]."</td>";
	   echo "<td align='left' width='180'>".$row[11]."</td>";
	   
	if ($row[17] == 0)
		echo "<td align='center' width='60'>".'Schita incarcare'."</td>";
	if ($row[17] == 1)
		echo "<td align='center' width='60'>".'Schita incarcare'."</td>";
	if ($row[17] == 2)
		echo "<td align='center' width='60'>".'Comanda la transportator'."</td>";
	if ($row[17] == 3)
		echo "<td align='center' width='60'>".'Transport confirmat'."</td>";
	if ($row[17] == 4)
	   echo "<td align='center' width='60'>".'Masina Confirmata'."</td>";
   if ($row[17] == 5)
	   echo "<td align='center' width='60'>".'Marfa livrata'."</td>";
	   echo "</tr>\r\n";
   }
?>
</table>
</center>
</body></html>

