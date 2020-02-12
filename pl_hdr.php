<?php
mysql_connect($_SERVER['SERVER_ADDR'],"root","");
mysql_select_db("Logistica");

if (isset($_POST["BA"])) {
   header("Location: planuri.php");
   exit;
}
if (isset($_POST["BS"])) {
   $dt=substr($_POST["DT"], 6, 4)."-".substr($_POST["DT"], 3, 2)."-".substr($_POST["DT"], 0, 2);
   if ($_POST["ID"] == 0) {
      $qpr="INSERT INTO plan_hdr VALUES ('','".$dt."','".$_POST["TRANS"]."','".$_POST["AUTO"]."', '".$_POST["SOFER"]."','".$_POST["TEL"]."','".$_POST["KM"]."','".$_POST["PRET"]."','".$_POST["CURS"]."','".$_POST["FACT"]."','".$_POST["FIN"]."', '".$_POST["DEST"]."', '".$_POST["OPG"]."','".$_POST["OSS"]."','".$_POST["OPL"]."','".$_POST["TR_MOD"]."', '".$_POST['ST_MASINA']."', '".$_POST['ST_TRANS']."', '".$_POST['ECHIPA']."',0,0)";
      mysql_query($qpr) or die(mysql_error());
      $lid=mysql_insert_id();
   } else {
      if ($_POST["FIN"]==9 && $_POST["FACT"]=="") {
         echo "<center><h2>Eroare nu puteti inchide factura fara a avea factura de transport !...</h2></center>";
      } else {
		  $result=mysql_query("SELECT data FROM plan_hdr WHERE id='".$_POST['ID']."' LIMIT 1");
		  $row=mysql_fetch_row($result);
		  mysql_free_result($result);
		  if($row[0]!=$dt)
			  mysql_query("INSERT INTO log_schimbari_data VALUES ('', '".$_POST['ID']."', CURRENT_TIMESTAMP(), '".$row[0]."', '".$dt."')");
         $qpr="UPDATE plan_hdr SET data='".$dt."', tr_id=".$_POST["TRANS"].", auto='".$_POST["AUTO"]."', sofer='".$_POST["SOFER"]."', tel='".$_POST["TEL"]."', km=".$_POST["KM"].", pret_km=".$_POST["PRET"].", cursv=".$_POST["CURS"].", factura='".$_POST["FACT"]."', inchis=".$_POST["FIN"].", cmd_tr='".$_POST["DEST"]."',ora_prog='".$_POST["OPG"]."', ora_sos='".$_POST["OSS"]."', ora_plec='".$_POST["OPL"]."', TMOD='".$_POST["TR_MOD"]."', status_masina='".$_POST['ST_MASINA']."', status_trans='".$_POST['ST_TRANS']."', echipa='".$_POST['ECHIPA']."' WHERE id=".$_POST["ID"];
      }
      mysql_query($qpr) or die(mysql_error());
      $lid = $_POST["ID"];
   }
   mysql_query("FLUSH TABLE plan_hdr");
   header("Location: plan.php?id=".$lid);
   exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<title>Plan incarcare intern</title>
<link rel="stylesheet" type="text/css" href="master.css">
<script language="JavaScript" type="text/javascript" src="/js_lib/dtpick.js"></script>
</head>
<body>
<h2>Plan de incarcare Intern</h2>
<hr class="dRed" />
<center>
<form name="plhed" method="post" action="#">
<input type="hidden" name="ID" value="<?php echo $_GET["id"];?> " />
<table width="520" cellpadding="2" cellspacing="2">
<tr valign="top" align="left">
<td width="150"><b>Data</b></td>
<td width="230"><input type="text" name="DT" size="10"/>
<a href="#" OnClick="javascript:show_calendar('document.plhed.DT', document.plhed.DT.value);"><img src="/js_lib/cal.gif" width="16" height="16" border="0" alt='Selecteaza data' /></a>
<?php if($_GET['id']!=0) echo "&nbsp;&nbsp;&nbsp;&nbsp;<button type='button' onclick='window.open(\"reprogram.php?id=".$_GET['id']."\", \"_self\")'>Reprogrameaza</button>";?>
<tr valign="top" align="left">
<td width="150"><b>Transportator</b></td>
<td width="230">
<select name='TRANS' size='1'>
<?php
$result = mysql_query("SELECT * FROM trasport WHERE tip=0 ORDER BY den") or die(mysql_error());
while ($row=mysql_fetch_row($result)) {
   echo "<option value='".$row[0]."'>".$row[3]."</option>";
}
?>
</select>
</td></tr>
<tr valign="top" align="left">
<td width="150"><b>Tip Transport : </b></td>
<td width="230">
<select name="TR_MOD" size="1">
<option value="0">TIR</option>
<option value="1">EXPORT</option>
<option value="6">IMPORT</option>
<option value="2">CAMION</option>
<option value="3">CLIENT</option>
<option value="4">GRUPAJ</option>
<option value="5">CURIER</option>

</tr>
<tr valign="top" align="left">
<td width="150"><b>Auto nr.</b></td>
<td width="230"><input type="text" name="AUTO" size="14" style="text-transform: uppercase" /></td>
</tr>
<tr valign="top" align="left">
<td width="150"><b>Sofer</b></td>
<td width="230"><input name="SOFER" size="40" type="text" style="text-transform: uppercase" /></td>
</tr>
<tr valign="top" align="left">
<td width="150"><b>TEL</b></td>
<td width="230"><input type="text" name="TEL" size="16" /></td>
</tr>
<tr valign="top" align="left">
<td width="150"><b>Destinatie</b></td>
<td width="230"><input type="text" name="DEST" size="24" /></td>
</tr>
<tr valign="top" align="left">
<td width="150"><b>KM</b></td>
<td width="230"><input type="text" name="KM" size="10" /></td>
</tr>
<tr valign="top" align="left">
<td width="150"><b>Valoare transport</b></td>
<td width="230"><input type="text" name="PRET" size="12" /></td>
</tr>

<tr valign="top" align="left">
<td width="150"><b>Valuta : </b></td>
<td width="230">
<select name="FIN" size="1">
<!-- <option value='0' selected>NU</option><option value='1'>DA</option></select></td> -->
<option value="0">LEI</option>
<option value="1">EURO</option>
<option value="2">USD</option>
</tr>
<tr valign="top" align="left">
<td width="150"><b>Curs valutar</b></td>
<td width="230"><input type="text" name="CURS" size="12" /></td>
</tr>
<tr valign="top" align="left">
<td width="150"><b>Numar AWB CURIER</b></td>
<td width="230"><input type="text" name="FACT" size="24" /></td>
</tr>
<tr valign="top" align="left">
<td width="150"><b>Echipa</b></td>
<td width="230"><input type="text" name="ECHIPA" size="40" /></td>
</tr>
<tr valign="top" align="left">
<td width="150"><b>Status masina</b></td>
<td width="230"><select name="ST_MASINA" style="width: 90%;">
<option value="1">Masina completa</option>
<option value="2">Masina incompleta</option>
</select></td>
</tr>
<tr valign="top" align="left">
<td width="150"><b>Status plan incarcare</b></td>
<td width="230"><select name="ST_TRANS" style="width: 90%;">
<option value="1">Schita incarcare</option>
<option value="2">Pentru Validare</option>
<option value="3">Comanda la transportator</option>
<option value="4">Transport confirmat</option>
<option value="5">Masina Confirmata</option>
<option value="6">Transport Livrat</option>
</select></td>
</tr>
<tr valign="top" align="left">
<td width="150"><b>Ora programata : </b></td>
<td width="230"><input type="text" name="OPG" size="12" value="00:00:00" /></td>
</tr>
<tr valign="top" align="left">
<td width="150"><b>Ora Inceput : </b></td>
<td width="230"><input type="text" name="OSS" size="12" value="00:00:00" /></td>
</tr>
<tr valign="top" align="left">
<td width="150"><b>Ora Terminat : </b></td>
<td width="230"><input type="text" name="OPL" size="12" value="00:00:00" /></td>
</tr>
</table>
<hr class="dRed" />
<p style="text-align: center"><input type="submit" name="BS" value="Salveaza" />&nbsp;&nbsp;&nbsp;<input type="submit" name="BA" value="Anuleaza" /></p>
</form>
<?php
if ($_GET["id"] != 0){
   $res=mysql_query("SELECT * FROM plan_hdr WHERE id=".$_GET["id"]) or die(mysql_error());
   $row=mysql_fetch_row($res);
   echo "<script type='text/javascript'>\r\n";
   echo "document.plhed.DT.value='".strftime("%d.%m.%Y", strtotime($row[1]))."';\r\n";
   //echo "document.plhed.DT.readOnly='1';\r\n";
   echo "document.plhed.TRANS.value='".$row[2]."';\r\n";
   echo "document.plhed.TRANS.readOnly='1';\r\n";
   echo "document.plhed.AUTO.value='".$row[3]."';\r\n";
   echo "document.plhed.SOFER.value='".$row[4]."';\r\n";
   echo "document.plhed.TEL.value='".$row[5]."';\r\n";
   echo "document.plhed.KM.value='".$row[6]."';\r\n";
   echo "document.plhed.PRET.value='".$row[7]."';\r\n";
   echo "document.plhed.CURS.value='".$row[8]."';\r\n";
   echo "document.plhed.FIN.value='".$row[10]."';\r\n";
   echo "document.plhed.FACT.value='".$row[9]."';\r\n";
   echo "document.plhed.DEST.value='".$row[11]."';\r\n";
   echo "document.plhed.OPG.value='".$row[12]."';\r\n";
   echo "document.plhed.OSS.value='".$row[13]."';\r\n";
   echo "document.plhed.OPL.value='".$row[14]."';\r\n";
   echo "document.plhed.TR_MOD.value='".$row[15]."';\r\n";
   echo "document.plhed.ST_MASINA.value='".$row[16]."';\r\n";
   echo "document.plhed.ST_TRANS.value='".$row[17]."';\r\n";
   
   echo "</script>\r\n";
}
?>
</center>
</body></html>

