<?php
mysql_connect("localhost","root","");
mysql_select_db("Logistica");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<title>Planuri incarcare Fitinguri</title>
<link rel="stylesheet" type="text/css" href="master.css" />
<script language="JavaScript" type="text/javascript" src="/js_lib/dtpick.js"></script>
<script type="text/javascript">

function ConfDel(vid, vpid) {
if (confirm("Stergeti inregistrarea curenta ?\r\nAtentie! Operatie ireversibila !...")) {
   self.location="plext_del.php?id="+vid;
   return true;
} else 
   return false;
}
</script>

</head>
<body>
<center>

<p align='center' style="margin: 4px 4px 4px 4px; padding: 4px;"><font size='4' color='#a00000' face='Verdana'><b>Planuri de incarcare Fitinguri</b></font>&nbsp;&nbsp;<a href='plext_hdr.php?id=0' class='btn'>Adaugare</a></p>
<!--
<form method="post" name="PLEXT" action="planext.php">
<p><b>Filtre | Tara : </b><input type='text' name='TR' size='24' />&nbsp;<input type='submit' name='F1' value='Cauta' /></p>
</form>
-->
<table border="1" cellspacing="0" cellpadding="2">
<tr bgcolor="#F0F0F0">
<td align="center" width="70"><b>Data </b></td>
<td align="center" width="220"><b>Transportator</b></td>
<td align="center" width="70"><b>Auto</b></td>
<td align="center" width="140"><b>Sofer</b></td>
<td align="center" width="80"><b>Tel</b></td>
<td align="center" width="70"><b>Pret</b></td>
<!--
<td align="center" width="120"><b>Tara<br />Locatia</b></td>
<td align="center" width="120"><b>Descarcare</b></td>
-->
<td align="center" width="40"><b>Del</b></td>
</tr>
<?php
$qpr="SELECT plan_hdr_ext.*, trasport.den FROM plan_hdr_ext LEFT JOIN trasport ON plan_hdr_ext.tr_id = trasport.id WHERE plan_hdr_ext.inchis=0 ORDER BY plan_hdr_ext.data DESC"; 
if (isset($_POST["F1"])) {
   $qpr="SELECT plan_hdr_ext.*, trasport.den FROM plan_hdr_ext LEFT JOIN trasport ON plan_hdr_ext.tr_id = trasport.id WHERE plan_hdr_ext.inchis=0 AND plan_hdr_ext.tara LIKE '".$_POST["TR"]."%' ORDER BY plan_hdr_ext.data DESC";
}
$res=mysql_query($qpr) or die(mysql_error());
while ($row=mysql_fetch_row($res)) {
   echo "<tr valign='top'>";
   echo "<td align='left' width='70'>".strftime("%d.%m.%Y", strtotime($row[1]) )."</td>";
   echo "<td align='left' width='220'><a href='plext_hdr.php?id=".$row[0]."' class='sml'>".$row[12]."</a></td>";
   echo "<td align='left' width='70'>".$row[3]."</td>";
   echo "<td align='left' width='140'>".$row[4]."</td>";
   echo "<td align='left' width='80'>".$row[5]."</td>";
   echo "<td align='right' width='70'>".$row[7]." &euro;</td>";
   /*
   echo "<td align='left' width='120'>".$row[6]."<br />".$row[8]."</td>";
   echo "<td align='left' width='120'>".$row[9]."</td>";
   */
   echo "<td align='center' width='30'><a href='#' onclick='javascript:ConfDel(".$row[0].");' class='sml'> x </a></td>";
   echo "</tr>\r\n";
}
?>
</table>
</center>
</body></html>

