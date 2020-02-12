<?php
$conn_dtb=mysqli_connect($_SERVER['SERVER_ADDR'], "root", "", "Logistica");
if(!isset($_SESSION['dataMinf']))
	$_SESSION['dataMinf']="";
if(!isset($_SESSION['dataMaxf']))
	$_SESSION['dataMaxf']="";
if(!isset($_SESSION['tip_trf']))
	$_SESSION['tip_trf']="";
if(!isset($_SESSION['transf']))
	$_SESSION['transf']="";
if(!isset($_SESSION['clientf']))
	$_SESSION['clientf']="";
if(!isset($_SESSION['FILTRE']))
	$_SESSION['FILTRE']="";
if(!isset($_SESSION['isFiltered']))
	$_SESSION['isFiltered']=0;
$numefiltre= array("dataMinf", "dataMaxf", "tip_trf", "transf", "clientf");
if(isset($_GET['strgFiltre'])){
	for($i=0;$i<5;$i++)
		$_SESSION[$numefiltre[$i]]="";
	$_SESSION['isFiltered']=0;
}
else if(isset($_GET['isFiltered'])){
	for($i=0;$i<5;$i++)
		if(isset($_GET[$numefiltre[$i]])){
			$_SESSION[$numefiltre[$i]]=$_GET[$numefiltre[$i]];
			$_SESSION['isFiltered']=1;
		}
	if($_SESSION['dataMaxf']=="" AND $_SESSION['dataMinf']=="" AND $_SESSION['clientf']=="" AND $_SESSION['tip_trf']=="" AND $_SESSION['transf']=="")
		$_SESSION['isFiltered']=0;
}
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

</style>
</head>
<body>
<h2>Planuri de incarcare Intern &nbsp;</h2>
<a class="noprint" href="#Top" style="position: fixed; bottom: 10px; right: 10px; background: 0px;"><img src="img/go_top.png" style="width: 30px; height: 30px;"></a>
<center>
<!-- FILTRE -->
<form id="formFiltre" method="get" action="<?php echo $_SERVER['PHP_SELF'];?>" style="margin-bottom: 30px;">
<table cellpadding="2" cellspacing="0" border="0" style="margin: auto; border-collapse: collapse;">
<tr>
	<td style="text-align: right;"><b>Data: </b></td>
	<td><input type="date" name="dataMinf" <?php if($_SESSION['dataMinf']!="") echo "value='".$_SESSION['dataMinf']."'";?>> | 
		<input type="date" name="dataMaxf" <?php if($_SESSION['dataMaxf']!="") echo "value='".$_SESSION['dataMaxf']."'";?>>
	</td>
</tr>
<tr>
	<td style="text-align: right;"><b>Tip tr: </b></td>
	<td><select name="tip_trf">
		<option value="" <?php if($_SESSION['tip_trf']=="") echo "selected";?>>---</option>
		<option value="0" <?php if($_SESSION['tip_trf']=="0") echo "selected";?>>TIR</option>
		<option value="1" <?php if($_SESSION['tip_trf']==1) echo "selected";?>>EXPORT</option>
		<option value="2" <?php if($_SESSION['tip_trf']==2) echo "selected";?>>CAMION</option>
		<option value="3" <?php if($_SESSION['tip_trf']==3) echo "selected";?>>CLIENT</option>
		<option value="4" <?php if($_SESSION['tip_trf']==4) echo "selected";?>>GRUPAJ</option>
		<option value="5" <?php if($_SESSION['tip_trf']==5) echo "selected";?>>CURIER</option>
	</select></td>
</tr>
<tr>
	<td style="text-align: right;"><b>Transportator: </b></td>
	<td><select name="transf">
		<option value="" <?php if($_SESSION['transf']=="") echo "selected";?>>---</option>
		<?php
			$result=mysqli_query($conn_dtb, "SELECT id, den FROM trasport ORDER BY den");
			while($row=mysqli_fetch_row($result)){
				echo "<option value='".$row[0]."' ";
				if($_SESSION['transf']==$row[0]) echo "selected";
				echo ">".$row[1]."</option>";
			}
			mysqli_free_result($result);
		?>
	</select></td>
</tr>
<tr>
	<td style="text-align: right;"><b>Client: </b></td>
	<td><select name="clientf">
		<option value="">---</option>
		<?php
			$result=mysqli_query($conn_dtb, "SELECT DISTINCT client FROM plan ORDER BY client");
			while($row=mysqli_fetch_row($result)){
				echo "<option value='".$row[0]."' ";
				if($_SESSION['clientf']==$row[0]) echo "selected";
				echo ">".$row[0]."</option>";
			}
			mysqli_free_result($result)
		?>
	</select></td>
</tr>
<tr>
	<td align="center" colspan="2"><input type="submit" name="isFiltered" value="Filtreaza">     <input type="submit" name="strgFiltre" value="Sterge filtrele"></td>
</tr>
</table>
</form>

<table border="1" cellspacing="0" cellpadding="2" style="margin: auto;">
<tr style="font-size: 20px">
<th colspan="7">Doc. transport</th>
<th colspan="5">Doc. insotire marfa</th>
</tr>
<tr style="background-color: #f0f0f0">
<td align="center" width="70"><b>Data </b></td>
<td align="center" width="40"><b>Nr FI </b></td>
<td align="center" width="60"><b>TIP TR</b></td>
<td align="center" width="110"><b>Transportator</b></td>
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
<td align="center" width="25"><b>Valoare transport</b></td>
<!--
<td align="center" width="60"><b>Valuta</b></td>
-->
<td align="center" width="110"><b>Nume clienti</b></td>
<td align="center" width="100" style='border-right: 2px solid red'><b>Valoare RON</b></td>
<td align="center" width="60"><b>Nr. document</b></td>
<td align="center" width="20"><b>Seria</b></td>
<td align="center" width="60"><b>Data document</b></td>
<td align="center" width="110"><b>Client</b></td>
<td align="center" width="90"><b>Valoare document</b></td>
</tr>
<?php
$_SESSION['FILTRE']="";
if($_SESSION['dataMinf']!="" AND $_SESSION['dataMaxf']!="")
	$_SESSION['FILTRE']="AND ph.`data` BETWEEN '".$_SESSION['dataMinf']."' AND '".$_SESSION['dataMaxf']."' ";
else
	$_SESSION['FILTRE']="AND ph.`data` > '".date("Y-m-d", time()-3892000)."' ";
if($_SESSION['tip_trf']!="")
	$_SESSION['FILTRE'].="AND ph.TMOD='".$_SESSION['tip_trf']."' ";
if($_SESSION['transf']!="")
	$_SESSION['FILTRE'].="AND ph.tr_id='".$_SESSION['transf']."' ";
$res=mysqli_query($conn_dtb, "SELECT ph.`data`, ph.id, ph.TMOD, tr.den, if(ph.inchis = 1 AND ph.cursv > 1, ph.pret_km * ph.cursv, if(ph.inchis = 1, ph.pret_km * 4.6, ph.pret_km)), de.nr_doc, de.sn, de.data_doc, de.`client`, de.val_doc, ph.auto, ph.sofer, ph.tel FROM plan_hdr ph JOIN trasport tr ON ph.tr_id=tr.id LEFT OUTER JOIN doc_erp de ON ph.id=de.id_tr WHERE ph.inchis<>9 ".$_SESSION['FILTRE']." AND de.sn<>'FATW' ORDER BY ph.`data` DESC, ph.id, de.`client`") or die(mysql_error());
$valori=mysqli_fetch_all($res, MYSQLI_NUM);
mysqli_free_result($res);
$i=0;
$GLOBALS['last_fi']=0;
$GLOBALS['last_trans']="";
$OKdoc=$OKclienti=0;
while (isset($valori[$i][1])){
	if($_SESSION['clientf']=="")
		$result=mysqli_query($conn_dtb, "SELECT DISTINCT client, SUM(if(LOCATE('E', moneda)=1 AND plan_hdr.cursv > 1 ,cant * pret * plan_hdr.cursv, if(LOCATE('E', moneda)=1, cant * pret * 4.6, if(LOCATE('OFL', moneda)=1, cant * pret * 4.8, cant*pret)))) Suma FROM plan, plan_hdr WHERE pid='".$valori[$i][1]."' AND pid=plan_hdr.id GROUP BY client ORDER BY client");
	else
		$result=mysqli_query($conn_dtb, "SELECT DISTINCT client, SUM(if(LOCATE('E', moneda)=1 AND plan_hdr.cursv > 1 ,cant * pret * plan_hdr.cursv, if(LOCATE('E', moneda)=1, cant * pret * 4.6, if(LOCATE('OFL', moneda)=1, cant * pret * 4.8, cant*pret)))) Suma FROM plan, plan_hdr WHERE pid='".$valori[$i][1]."' AND pid=plan_hdr.id AND client='".$_SESSION['clientf']."' GROUP BY client ORDER BY client");
	   $row=mysqli_fetch_all($result);
	   $j=0;
	if($_SESSION['clientf']=="" OR $row[$j][0]){
		if($GLOBALS['last_fi']==$valori[$i][1]){
			$OKdoc=1;
			echo "<tr valign='top'>";
			echo "<td style='border-top: 0px; border-bottom: 0px;'> &nbsp </td>";
			echo "<td style='border-top: 0px; border-bottom: 0px;'> &nbsp </td>";
			echo "<td style='border-top: 0px; border-bottom: 0px;'> &nbsp </td>";
			echo "<td style='border-top: 0px; border-bottom: 0px;'> &nbsp </td>";
			echo "<td style='border-top: 0px; border-bottom: 0px;'> &nbsp </td>";
			echo "<td style='border-top: 0px; border-bottom: 0px;'> &nbsp </td>";
			echo "<td style='border-top: 0px; border-bottom: 0px; border-right: 2px solid red;'> &nbsp </td>";
			echo "<td align='right' width='70'>".$valori[$i][5]."</td>";
		   echo "<td align='left' width='30'>".$valori[$i][6]."/td>";
		   echo "<td align='left' width='70'>".$valori[$i][7]."</td>";
		   echo "<td align='left' width='110'>".$valori[$i][8]."</td>";
		   echo "<td align='right' width='60'>".number_format($valori[$i][9], 2)."</td></tr>";
		   if($valori[$i][9])
			   $sumDoc+=$valori[$i][9];
		}
		else{
			if($OKdoc OR $OKclienti){
				echo "<tr>";
				echo "<td style='border-top: 0px;'> &nbsp </td>";
				echo "<td style='border-top: 0px;'> &nbsp </td>";
				echo "<td style='border-top: 0px;'> &nbsp </td>";
				echo "<td style='border-top: 0px;'> &nbsp </td>";
				echo "<td style='border-top: 0px;'> &nbsp </td>";
				echo "<td align='right'><b>TOTAL: </b></td>";
				
					$lasutaclienti=($valori[$i-1][4]/$sumClienti)*100;
					echo "<td style='text-align: right; border-right: 2px solid red;'><b>".number_format($sumClienti, 2)." - ".number_format($lasutaclienti, 2)."%</b></td>";
				echo "<td style='border-top: 0px;'>&nbsp</td>";
				echo "<td style='border-top: 0px;'>&nbsp</td>";
				echo "<td style='border-top: 0px;'>&nbsp</td>";
				echo "<td align='right'><b>TOTAL: </b></td>";
				if($sumDoc!=0)
					$lasutadoc=($valori[$i-1][4]/$sumDoc)*100;
				else
					$lasutadoc=0;
					echo "<td style='text-align: right;'><b>".number_format($sumDoc, 2)." - ".number_format($lasutadoc, 2)."%</b></td>";
				echo "</tr>";
			}
			$GLOBALS['last_fi']=$valori[$i][1];
			$GLOBALS['last_trans']=$valori[$i][3];
			$sumClienti=$sumDoc=0;
			$OKclienti=$OKdoc=$notOK=0;
			for($verif1=$verif2=0; isset($valori[$i+$verif1][1]) AND $valori[$i+$verif1][1]==$GLOBALS['last_fi'] AND isset($row[$j+$verif2][0]); $verif2++){
//				while($valori[$i+$verif1][8][0] > $row[$j+$verif2][0][0])
//					$verif2++;
				if(strstr(str_replace(array("'", "S.R.L."), array("", "SRL"), $row[$j+$verif2][0]), str_replace(array("'", "S.R.L."), array("", "SRL"), $valori[$i+$verif1][8]))!=str_replace(array("'", "S.R.L."), array("", "SRL"), $row[$j+$verif2][0])){
					$notOK=1;
					break;
				}
				while(isset($valori[$i+$verif1][1]) AND $valori[$i+$verif1][1]==$GLOBALS['last_fi'] AND strstr(str_replace(array("'", "S.R.L."), array("", "SRL"), $row[$j+$verif2][0]), str_replace(array("'", "S.R.L."), array("", "SRL"), $valori[$i+$verif1][8]))==str_replace(array("'", "S.R.L."), array("", "SRL"), $row[$j+$verif2][0]))
					$verif1++;
			}
			if($notOK)
				echo "<tr valign='top' style='border-top: 2px solid black; background-color: red; color: white;'>";
			else
				echo "<tr valign='top' style='border-top: 2px solid black;'>";
		   echo "<td align='left' width='70' style='border-bottom: 0px; border-top: 2px solid black;'>".strftime("%d.%m.%Y", strtotime($valori[$i][0]))."</td>";
			  echo "<td align='left' width='40' style='border-bottom: 0px; border-top: 2px solid black;'>".$valori[$i][1]."</td>";
			if ($valori[$i][2] == 0)
		   echo "<td align='center' width='60' style='border-bottom: 0px; border-top: 2px solid black; padding: 0;'><img src='img/truck.jpg' style='height: 30px; width: 40px; margin: 0;' alt='TIR' title='TIR\n";
		  if ($valori[$i][2] == 1)
		   echo "<td align='center' width='60' style='border-bottom: 0px; border-top: 2px solid black; padding: 0;'><img src='img/export.png' style='height: 30px; width: 40px; margin: 0;' alt='EXPORT' title='EXPORT\n";
		if ($valori[$i][2] == 2)
		   echo "<td align='center' width='60' style='border-bottom: 0px; border-top: 2px solid black; padding: 0;'><img src='img/camion.png' style='height: 30px; width: 30px; margin: 0;' alt='CAMION' title='CAMION\n";
		  if ($valori[$i][2] == 3)
		   echo "<td align='center' width='60' style='border-bottom: 0px; border-top: 2px solid black; padding: 0;'><img src='img/client.png' style='height: 30px; width: 40px; margin: 0;' alt='CLIENT' title='CLIENT\n";
		  if ($valori[$i][2] == 4)
		   echo "<td align='center' width='60' style='border-bottom: 0px; border-top: 2px solid black; padding: 0;'><img src='img/schenker.png' style='height: 30px; width: 40px; margin: 0;' alt='GRUPAJ' title='GRUPAJ\n";
		  if ($valori[$i][2] == 5)
		   echo "<td align='center' width='60' style='border-bottom: 0px; border-top: 2px solid black; padding: 0;'><img src='img/fan_courier.png' style='height: 30px; width: 40px; margin: 0;' alt='CURIER' title='CURIER\n";
	     if ($valori[$i][2] == 6)
		   echo "<td align='center' width='60' style='border-bottom: 0px; border-top: 2px solid black; padding: 0;'><img src='img/import.png' style='height: 30px; width: 40px; margin: 0;' alt='IMPORT' title='CURIER\n";
			echo "AUTO: ".$valori[$i][10]."\n";
			echo "SOFER: ".$valori[$i][11]."\n";
			echo "TEL: ".$valori[$i][12]."\n";
			echo "'></td>";
		   echo "<td align='left' width='110' style='border-bottom: 0px; border-top: 2px solid black; color: blue;'><b>".$valori[$i][3]."</b></td>";
		   echo "<td align='right' style='border-bottom: 0px; border-top: 2px solid black;' width='25'>".number_format($valori[$i][4], '2')."</td>";
			echo "<td width='110' style='border-top: 2px solid black; border-bottom: 0px;'>".$row[$j][0]."</td>";
			$x=0;
			while(isset($valori[$i+$x][1]) AND (isset($row[$x][0]) OR $GLOBALS['last_fi']==$valori[$i+$x][1]))
				$x++;
			if($x==1){
				if ($row[$j][1]<>0)
				   $lasutaclienti=0;
				else   
				   $lasutaclienti=($valori[$i][4]/$row[$j][1])*100;
				echo "<td align='right' width='60' style='border-right: 2px solid red; border-top: 2px solid black; border-bottom: 0px;'>".number_format($row[$j][1], 2)." - ".number_format($lasutaclienti, '2')."%</td>";
				if($row[$j][1])
				$sumClienti+=$row[$j][1];
			   echo "<td align='right' width='70' style='border-top: 2px solid black;'>".$valori[$i][5]."</td>";
			   echo "<td align='left' width='70' style='border-top: 2px solid black;'>".$valori[$i][6]."</td>";
			   echo "<td align='left' width='70' style='border-top: 2px solid black;'>".$valori[$i][7]."</td>";
			   echo "<td align='left' width='110' style='border-top: 2px solid black;'>".$valori[$i][8]."</td>";
			   $lasutadoc=($valori[$i][4]/$valori[$i][9])*100;
				echo "<td align='right' width='60' style='border-top: 2px solid black;'>".number_format($valori[$i][9],2)." - ".number_format($lasutadoc, '2')."%</td>";
				if($valori[$i][9])
			   $sumDoc+=$valori[$i][9];
			}
			else{
				echo "<td align='right' width='60' style='border-right: 2px solid red; border-top: 2px solid black; border-bottom: 0px;'>".number_format($row[$j][1], 2)."</td>";
				if($row[$j][1])
				$sumClienti+=$row[$j][1];
				if(strstr(str_replace(array("'", "S.R.L."), array("", "SRL"), $row[$j][0]), str_replace(array("'", "S.R.L."), array("", "SRL"), $valori[$i][8]))==str_replace(array("'", "S.R.L."), array("", "SRL"), $row[$j][0])){
				   echo "<td align='right' width='70' style='border-top: 2px solid black;'>".$valori[$i][5]."</td>";
				   echo "<td align='left' width='70' style='border-top: 2px solid black;'>".$valori[$i][6]."</td>";
				   echo "<td align='left' width='70' style='border-top: 2px solid black;'>".$valori[$i][7]."</td>";
				   echo "<td align='left' width='110' style='border-top: 2px solid black;'>".$valori[$i][8]."</td>";
				   echo "<td align='right' width='60' style='border-top: 2px solid black;'>".number_format($valori[$i][9],2)."</td>";
					if($valori[$i][9])
				   $sumDoc+=$valori[$i][9];
				}
				else{
					echo "<td>&nbsp</td>"; 
					echo "<td>&nbsp</td>"; 
					echo "<td>&nbsp</td>"; 
					echo "<td>&nbsp</td>"; 
					echo "<td>&nbsp</td>"; 
					$i--;
				}
			}
			
		   while(isset($valori[$i+1][1]) AND $valori[$i+1][1]==$GLOBALS['last_fi'] AND strstr(str_replace(array("'", "S.R.L."), array("", "SRL"), $row[$j][0]), str_replace(array("'", "S.R.L."), array("", "SRL"), $valori[$i+1][8]))==str_replace(array("'", "S.R.L."), array("", "SRL"), $row[$j][0])){
						$OKdoc=1;
						echo "<tr valign='top'>";
						echo "<td style='border-top: 0px; border-bottom: 0px;'> &nbsp </td>";
						echo "<td style='border-top: 0px; border-bottom: 0px;'> &nbsp </td>";
						echo "<td style='border-top: 0px; border-bottom: 0px;'> &nbsp </td>";
						echo "<td style='border-top: 0px; border-bottom: 0px;'> &nbsp </td>";
						echo "<td style='border-top: 0px; border-bottom: 0px;'> &nbsp </td>";
						echo "<td style='border-top: 0px; border-bottom: 0px;'> &nbsp </td>";
						echo "<td style='border-top: 0px; border-bottom: 0px; border-right: 2px solid red;'> &nbsp </td>";
						echo "<td align='right' width='70'>".$valori[$i+1][5]."</td>";
					   echo "<td align='left' width='30'>".$valori[$i+1][6]."</td>";
					   echo "<td align='left' width='70'>".$valori[$i+1][7]."</td>";
					   echo "<td align='left' width='110'>".$valori[$i+1][8]."</td>";
					   echo "<td align='right' width='60'>".number_format($valori[$i+1][9], 2)."</td></tr>";
					   if($valori[$i+1][9])
						$sumDoc+=$valori[$i+1][9];
					   $i++;
			}
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
		   $j++;
		   while(isset($row[$j][0])){
				$OKclienti=1;
				echo "<tr valign='top'>";
				echo "<td style='border-top: 0px; border-bottom: 0px;'> &nbsp </td>";
				echo "<td style='border-top: 0px; border-bottom: 0px;'> &nbsp </td>";
				echo "<td style='border-top: 0px; border-bottom: 0px;'> &nbsp </td>";
				echo "<td style='border-top: 0px; border-bottom: 0px;'> &nbsp </td>";
				echo "<td style='border-top: 0px; border-bottom: 0px;'> &nbsp </td>";
				echo "<td style='border-bottom: 0px;'>".$row[$j][0]."</td>";
				echo "<td align='right' style='border-right: 2px solid red; border-bottom: 0px;'>".number_format($row[$j][1], 2)."</td>";
				if($row[$j][1])
					$sumClienti+=$row[$j][1];
				if($valori[$i+1][1]==$GLOBALS['last_fi']){
					$OKdoc=1;
					if(strstr(str_replace(array("'", "S.R.L."), array("", "SRL"), $row[$j][0]), str_replace(array("'", "S.R.L."), array("", "SRL"), $valori[$i+1][8]))==str_replace(array("'", "S.R.L."), array("", "SRL"), $row[$j][0])){
						echo "<td align='right' width='70'>".$valori[$i+1][5]."</td>";
					   echo "<td align='left' width='30'>".$valori[$i+1][6]."</td>";
					   echo "<td align='left' width='70'>".$valori[$i+1][7]."</td>";
					   echo "<td align='left' width='110'>".$valori[$i+1][8]."</td>";
					   echo "<td align='right' width='60'>".number_format($valori[$i+1][9], 2)."</td></tr>";
					   if($valori[$i+1][9])
						$sumDoc+=$valori[$i+1][9];
					   $i++;
					}
					else{
						echo "<td align='right' width='70'>&nbsp</td>";
					   echo "<td align='left' width='30'>&nbsp</td>";
					   echo "<td align='left' width='70'>&nbsp</td>";
					   echo "<td align='left' width='110'>&nbsp</td>";
					   echo "<td align='right' width='60'>&nbsp</td></tr>";
					}
					while(isset($valori[$i+1][1]) AND $valori[$i+1][1]==$GLOBALS['last_fi'] AND strstr(str_replace(array("'", "S.R.L."), array("", "SRL"), $row[$j][0]), str_replace(array("'", "S.R.L."), array("", "SRL"), $valori[$i+1][8]))==str_replace(array("'", "S.R.L."), array("", "SRL"), $row[$j][0])){
						$OKdoc=1;
						echo "<tr valign='top'>";
						echo "<td style='border-top: 0px; border-bottom: 0px;'> &nbsp </td>";
						echo "<td style='border-top: 0px; border-bottom: 0px;'> &nbsp </td>";
						echo "<td style='border-top: 0px; border-bottom: 0px;'> &nbsp </td>";
						echo "<td style='border-top: 0px; border-bottom: 0px;'> &nbsp </td>";
						echo "<td style='border-top: 0px; border-bottom: 0px;'> &nbsp </td>";
						echo "<td style='border-top: 0px; border-bottom: 0px;'> &nbsp </td>";
						echo "<td style='border-top: 0px; border-bottom: 0px; border-right: 2px solid red;'> &nbsp </td>";
						echo "<td align='right' width='70'>".$valori[$i+1][5]."</td>";
					   echo "<td align='left' width='30'>".$valori[$i+1][6]."</td>";
					   echo "<td align='left' width='70'>".$valori[$i+1][7]."</td>";
					   echo "<td align='left' width='110'>".$valori[$i+1][8]."</td>";
					   echo "<td align='right' width='60'>".number_format($valori[$i+1][9], 2)."</td></tr>";
					   if($valori[$i+1][9])
						$sumDoc+=$valori[$i+1][9];
					   $i++;
					}
				}
				else{
					$GLOBALS['last_fi']=$valori[$i][1];
					$GLOBALS['last_trans']=$valori[$i][3];
					echo "<td> &nbsp </td>";
					echo "<td> &nbsp </td>";
					echo "<td> &nbsp </td>";
					echo "<td> &nbsp </td>";
					echo "<td> &nbsp </td>";
					echo "<tr>";
				}
				$j++;
		   }
		}
	}
	$i++;
}

?>
</table>
</center>
</body></html>

