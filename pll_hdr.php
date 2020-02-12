<?php
mysql_connect("localhost","root","");
mysql_select_db("Logistica");

if (isset($_POST["BA"])) {
   header("Location: planuri.php");
   exit;
}

if (isset($_POST["BS"])) {
   $dt=substr($_POST["DT"], 6, 4)."-".substr($_POST["DT"], 3, 2)."-".substr($_POST["DT"], 0, 2);
   if ($_POST["ID"] == 0) {
      $qpr="INSERT INTO plan_hdr VALUES ('','".$dt."',".$_POST["TRANS"].",'".$_POST["AUTO"]."', '".$_POST["SOFER"]."','".$_POST["TEL"]."',".$_POST["KM"].",".$_POST["PRET"].",".$_POST["CURS"].",'".$_POST["FACT"]."',".$_POST["FIN"].")";
      mysql_query($qpr) or die(mysql_error());
      $lid=mysql_insert_id();
   } else {
      if ($_POST["FIN"] == 1 && $_POST["FACT"]=="") {
         echo "<center><h2>Eroare nu puteti inchide factura fara a avea factura de transport !...</h2></center>";
      } else {
         $qpr="UPDATE plan_hdr SET tr_id=".$_POST["TRANS"].", auto='".$_POST["AUTO"]."', sofer='".$_POST["SOFER"]."', tel='".$_POST["TEL"]."', km=".$_POST["KM"].", pret_km=".$_POST["PRET"].", cursv=".$_POST["CURS"].", factura='".$_POST["FACT"]."' WHERE id=".$_POST["ID"];
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
<script language="JavaScript" type="text/javascript" src="http://sami-server/js_lib/dtpick.js"></script>
<script type='text/javascript'>

function DispAuto() {
   var durl="lauto.php?id="+document.plhed.TRANS.value;
   mywin=window.open (durl, "", "location=0,status=1,scrollbars=1,width=300,height=400");
   return true;
}

function DispSof() {
   var durl="lsofer.php?id="+document.plhed.TRANS.value;
   mywin=window.open (durl, "", "location=0,status=1,scrollbars=1,width=300,height=400");
   return true;
}


</script>
</head>
<body background="../sami_bkw.jpg">
<center>
<p><font size='4' color='#a00000' face='Verdana'><b>Plan de incarcare Intern</b></font></p>
<hr />
<form name="plhed" method="post">
<?php
echo "<input type='hidden' name='ID' value='".$_GET["id"]."' />";
?>
<table width="520" cellpadding="2" cellspacing="2">
<tr valign="top" align="left">
<td width="150"><b>Data</b></td>
<td width="370"><input type="text" name="DT" size="10" >
<a href='#' OnClick="javascript:show_calendar('document.plhed.DT', document.plhed.DT.value);"><img src='http://sami-server/js_lib/cal.gif' width=16 height=16 border=0 alt='Selecteaza data' /></a>
</td></tr>
<tr valign="top" align="left">
<td width="150"><b>Transportator</b></td>
<td width="370">
<?php
echo "<select name='TRANS' size='1'>";
$result = mysql_query("SELECT * FROM trasport WHERE tip=0 ORDER BY den") or die(mysql_error());
while ($row=mysql_fetch_row($result)) {
   echo "<option value='".$row[0]."'>".$row[3]."</option>";
}
echo "</select>\r\n";
?>
</td></tr>
<tr valign="top" align="left">
<td width="150"><b>Auto nr.</b></td>
<td width="370"><input type="text" name="AUTO" size="14" /> <a href='#' class='mic' Onclick='javascript:DispAuto();return true;'>[ ? ]</a></td>
</tr>
<tr valign="top" align="left">
<td width="150"><b>Sofer</b></td>
<td width="370"><input name="SOFER" size="40" type="text" /> <a href='#' class='mic' Onclick='javascript:DispSof();return true;'>[ ? ]</a></td>
</tr>
<tr valign="top" align="left">
<td width="150"><b>TEL</b></td>
<td width="370"><input type="text" name="TEL" size="16" /></td>
</tr>
<tr valign="top" align="left">
<td width="150"><b>KM</b></td>
<td width="370"><input type="text" name="KM" size="10" /></td>
</tr>
<tr valign="top" align="left">
<td width="150"><b>PRET/KM</b></td>
<td width="370"><input type="text" name="PRET" size="12" /></td>
</tr>
<tr valign="top" align="left">
<td width="150"><b>Curs valutar</b></td>
<td width="370"><input type="text" name="CURS" size="12" /></td>
</tr>
<tr valign="top" align="left">
<td width="150"><b>Factura/data</b></td>
<td width="370"><input type="text" name="FACT" size="24" /></td>
</tr>
<tr valign="top" align="left">
<td width="150"><b>Finalizata</b></td>
<td width="370"><select name="FIN" size="1"><option value='0' selected>NU</option><option value='1'>DA</option></select></td>
</tr>
</table>
<hr />
<input type="submit" name="BS" value="Salveaza" />&nbsp;&nbsp;&nbsp;<input type="submit" name="BA" value="Anuleaza" />
</form>
<?php
if ($_GET["id"] != 0) {
   $res=mysql_query("SELECT * FROM plan_hdr WHERE id=".$_GET["id"]) or die(mysql_error());
   $row=mysql_fetch_row($res);
   echo "<script type='text/javascript'>\r\n";
   echo "document.plhed.DT.value='".strftime("%d.%m.%Y", strtotime($row[1]))."';\r\n";
   echo "document.plhed.DT.readOnly='1';\r\n";
   echo "document.plhed.TRANS.value='".$row[2]."';\r\n";
   echo "document.plhed.TRANS.readOnly='1';\r\n";
   echo "document.plhed.AUTO.value='".$row[3]."';\r\n";
   echo "document.plhed.SOFER.value='".$row[4]."';\r\n";
   echo "document.plhed.TEL.value='".$row[5]."';\r\n";
   echo "document.plhed.KM.value='".$row[6]."';\r\n";
   echo "document.plhed.PRET.value='".$row[7]."';\r\n";
   echo "document.plhed.CURS.value='".$row[8]."';\r\n";
   echo "document.plhed.FACT.value='".$row[9]."';\r\n";
   echo "</script>\r\n";
}
?>
</center>
</body></html>

