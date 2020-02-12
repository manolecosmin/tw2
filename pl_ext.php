<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<title>Plan incarcare Fitinguri</title>
<link rel="stylesheet" type="text/css" href="master.css" />
<script language="JavaScript" type="text/javascript" src="/js_lib/dtpick.js"></script>
<script tyle="text/javascript">

function ConfDel(vid, vpid) {
if (confirm("Stergeti inregistrarea curenta ?")) {
   self.location="pl_ext_del.php?id="+vid+"&pid="+vpid;
   return true;
} else 
   return false;
}
</script>

</head>
<body background="/sami_bkw.jpg">
<center>
<p style="margin: 2px; padding: 2px;"><font size='4' color='#a00000' face='Verdana'><b>Plan de incarcare Fitinguri</b></font></p>
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
echo "<b>Tara : </b>".$row[6]." <b>Pret : </b>".$row[7]." &euro; "."  <b>Locatie : <b>".$row[8]."<br />";
echo "<b>Descarcare la : </b>".$row[9]."</p><hr />";
$valtr=$row[7];
mysql_free_result($result);
mysql_free_result($res);
?>
<table border="1" cellspacing="0" cellpading="2" width="1100">
<tr bgcolor="#F0F0F0">
<td align="center" width="180"><b>Furnizor</b></td>
<td align="center" width="220"><b>Produs</b></td>
<td align="center" width="60"><b>Cantitate</b></td>
<td align="center" width="64"><b>Data cmd.</b></td>
<td align="center" width="64"><b>Termen</b></td>
<td align="center" width="64"><b>P.U.</b></td>
<td align="center" width="64"><b>Valoare</b></td>
<td align="center" width="24"><b>Del</b></td>
</tr>
<?php
$tval=0;
$res=mysql_query("SELECT * FROM plan_ext WHERE pid=".$_GET["id"]) or die(mysql_error());
while ($row=mysql_fetch_row($res)) {
   echo "<tr valign='top'>";
   echo "<td align='left' width='180'><a href='plan_edit.php?pid=".$_GET["id"]."&id=".$row[0]."' class='sml'>".$row[2]."</a></td>";
   echo "<td align='left' width='220'>".$row[3]."</td>";
   echo "<td align='right' width='60'>".$row[4]."</td>";
   echo "<td align='center' width='64'>".strftime("%d.%m.%Y", strtotime($row[5]))."</td>";
   echo "<td align='center' width='64'>".strftime("%d.%m.%Y", strtotime($row[6]))."</td>";
   echo "<td align='right' width='64'>".$row[7]."</td>";
   $val=$row[4] * $row[7];
   $tval+=$val;
   echo "<td align='right' width='64'>".round($val,2)."</td>";
   echo "<td align='center' width='24'><a href='#' onclick='javascript:ConfDel(".$row[0].", ".$row[1].");' class='sml'> x </a></td>";
   echo "</tr>\r\n";
}
echo "</table>\r\n";
echo "<p><b>Valoare totala : </b>".Round($tval,2)." &euro; (".round($valtr/($tval/100),2)." %)&nbsp;&nbsp;&nbsp;<a href='sel_liv_ext.php?id=".$_GET["id"]."' class='btn'>Adaugare</a>&nbsp;&nbsp;&nbsp;<a href='plextview.php?id=".$_GET["id"]."' class='btn' target='_blank'>Previzualizare</a>&nbsp;&nbsp;&nbsp;<a href='fisa_ext.php?id=".$_GET["id"]."' class='btn' target='_blank'>Fisa incarcare</a><br /><br /></p>";
?>
</center>
</body></html>

