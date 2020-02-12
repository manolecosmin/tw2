<?php
mysql_connect("localhost","root","");
mysql_select_db("Logistica");

if (isset($_POST["BA"])) {
   header("Location: planext.php");
   exit;
}

if (isset($_POST["BS"])) {
   $dt=substr($_POST["DT"], 6, 4)."-".substr($_POST["DT"], 3, 2)."-".substr($_POST["DT"], 0, 2);
   if ($_POST["ID"] == 0) {
      $qpr="INSERT INTO plan_hdr_ext VALUES ('','".$dt."',".$_POST["TRANS"].",'".$_POST["AUTO"]."', '".$_POST["SOFER"]."','".$_POST["TEL"]."', '', 0, '', '".strtoupper($_POST["DESC"])."', ".$_POST["FIN"].",'')";
      mysql_query($qpr) or die(mysql_error());
      $lid=mysql_insert_id();
   } else {
      $qpr="UPDATE plan_hdr_ext SET data='".$dt."', tr_id=".$_POST["TRANS"].", auto='".$_POST["AUTO"]."', sofer='".$_POST["SOFER"]."', tel='".$_POST["TEL"]."', descarcare='".$_POST["DESC"]."', inchis=".$_POST["FIN"]." WHERE id=".$_POST["ID"];
      mysql_query($qpr) or die(mysql_error());
      $lid = $_POST["ID"];
   }
   mysql_query("FLUSH TABLE plan_hdr_ext");
   header("Location: pl_ext.php?id=".$lid);
   exit;
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<title>Plan incarcare Extern</title>
<link rel="stylesheet" type="text/css" href="master.css" />
<script language="JavaScript" type="text/javascript" src="/js_lib/dtpick.js"></script>

</head>
<body>
<center>
<p><font size='4' color='#a00000' face='Verdana'><b>Plan de incarcare Fitinguri</b></font></p>
<hr />
<form name="PLHED" method="post">
<?php
echo "<input type='hidden' name='ID' value='".$_GET["id"]."' />";
?>
<table width="520" cellpadding="2" cellspacing="2">
<tr valign="top" align="left">
<td width="150"><b>Data</b></td>
<td width="230"><input type="text" name="DT" size="10" />
<a href='#' OnClick="javascript:show_calendar('document.PLHED.DT', document.PLHED.DT.value);"><img src='/js_lib/cal.gif' width='16' height='16' border='0' alt='Selecteaza data' /></a>
</td></tr>
<tr valign="top" align="left">
<td width="150"><b>Transportator</b></td>
<td width="230">
<select name="TRANS" size="1">
<?php
$result = mysql_query("SELECT * FROM trasport WHERE tip=0 ORDER BY den") or die(mysql_error());
while ($row=mysql_fetch_row($result)) {
   echo "<option value='".$row[0]."'>".$row[3]."</option>";
}
?>
</select>
</td></tr>
<tr valign="top" align="left">
<td width="150"><b>Auto nr.</b></td>
<td width="230"><input type="text" name="AUTO" size="24" /></td>
</tr>
<tr valign="top" align="left">
<td width="150"><b>Sofer</b></td>
<td width="230"><input name="SOFER" size="40" type="text" /></td>
</tr>
<tr valign="top" align="left">
<td width="150"><b>TEL</b></td>
<td width="230"><input type="text" name="TEL" size="16" /></td>
</tr>
<tr valign="top" align="left">
<td width="150"><b>Descarcare</b></td>
<td width="230"><input type="text" name="DESC" size="40" /></td>
</tr>
<tr valign="top" align="left">
<td width="150"><b>Finalizata</b></td>
<td width="230"><select name="FIN" size="1"><option value='0' selected>NU</option><option value='1'>DA</option></select></td>
</tr>
</table>
<hr />
<input type="submit" name="BS" value="Salveaza" />&nbsp;&nbsp;&nbsp;<input type="submit" name="BA" value="Anuleaza" />
</form>
<?php
if ($_GET["id"] != 0) {
   $res=mysql_query("SELECT * FROM plan_hdr_ext WHERE id=".$_GET["id"]) or die(mysql_error());
   $row=mysql_fetch_row($res);
   echo "<script type='text/javascript'>\r\n";
   echo "document.PLHED.DT.value='".strftime("%d.%m.%Y", strtotime($row[1]))."';\r\n";
   //echo "document.PLHED.DT.readOnly='1';\r\n";
   echo "document.PLHED.TRANS.value='".$row[2]."';\r\n";
   echo "document.PLHED.TRANS.readOnly='1';\r\n";
   echo "document.PLHED.AUTO.value='".$row[3]."';\r\n";
   echo "document.PLHED.SOFER.value='".$row[4]."';\r\n";
   echo "document.PLHED.TEL.value='".$row[5]."';\r\n";
   echo "document.PLHED.TARA.value='".$row[6]."';\r\n";
   echo "document.PLHED.PRET.value='".$row[7]."';\r\n";
   echo "document.PLHED.LOCA.value='".$row[8]."';\r\n";
   echo "document.PLHED.DESC.value='".$row[9]."';\r\n";
   echo "</script>\r\n";
}
?>
</center>
</body></html>

