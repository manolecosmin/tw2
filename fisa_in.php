<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<title>Fisa incarcare intern</title>
<link rel="stylesheet" type="text/css" href="master.css" />
<style type="text/css">
@media print {
	@page { size: 21.00cm 29.70cm; margin-left: 0.1cm; margin-right: 0.5cm; margin-top: 0.40cm; margin-bottom: 1.2cm }
}
   td { 
   border: 1px solid #000000;
   font-family: verdana, arial, sans-serif;
   font-size: 9pt;
   }

   td.bfill { 
      background-color : #E0E0E0;
   }

</style>

</head>
<body bgcolor='#FFFFFF'>
<p style="text-align: center; margin: 2px; padding: 2px;"><font size='4' color='#a00000' face='Verdana'><b>Fisa de incarcare # : <?php echo $_GET["id"];?></b><br /></font></p>
<?php
mysql_connect("localhost","root","");
mysql_select_db("Logistica");
$res=mysql_query("SELECT * FROM plan_hdr WHERE id=".$_GET["id"]) or die(mysql_error());
$row=mysql_fetch_row($res);
echo "<p style='margin: 2px; padding: 2px;'><b>Data : </b>".$row[1]." <b>Transportator : </b>";
$result = mysql_query("SELECT * FROM trasport WHERE id=".$row[2]) or die(mysql_error());
$rw=mysql_fetch_row($result);
echo "<b><i>".$rw[3]."</i> Auto nr. </b>".$row[3]." <b>Sofer : </b>".$row[4]." <b>Tel : </b>".$row[5]."<br /></p>";
mysql_free_result($result);
mysql_free_result($res);
?>
<table border="1" cellspacing="0" cellpadding="4">
<tr bgcolor="#F0F0F0">
<td align="center" width="160"><b>Client</b></td>
<td align="center" width="30"><b>MON</b></td>
<td align="center" width="40"><b>Serie Nr</b></td>
<td align="center" width="220"><b>Produs</b></td>
<td align="center" width="40"><b>Cant<br />de liv</b></td>
<td align="center" width="160"><b>Mod livrare</b></td>
<td align="center" width="30"><b>Ord<br />des</b></td>
<td align="center" width="160"><b>Livrare la</b></td>
<td align="center" width="230"><b>Colisaj</b></td>
<td align="center" width="100"><b>Total</b></td>
<td align="center" width="60"><b>LOT</b></td>
</tr>
<?php
$tval=0;
$res=mysql_query("SELECT * FROM plan WHERE pid=".$_GET["id"]." ORDER BY dord DESC") or die(mysql_error());
while ($row=mysql_fetch_row($res)) {
   echo "<tr valign='middle'>";
   echo "<td align='left' width='160' height='40'>".$row[2]."</td>";
   echo "<td align='center' width='30'>".$row[8]."</td>";
   echo "<td align='center' width='40'>".$row[14]."</td>";
   if (strstr($row[3], "Teava")) 
      echo "<td align='left' width='220' class='bfill'><b>".$row[3]."</b></td>";
   else
      echo "<td align='left' width='220'>".$row[3]."</td>";
   echo "<td align='center' width='40'><b>".$row[4]."</b></td>";
   echo "<td align='left' width='160' height='40'>".$row[13]."</td>";
   echo "<td align='center' width='30'>".$row[5]."</td>";
   echo "<td align='left' width='160'>".$row[6]."</td>";
   echo "<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>\r\n";
}
echo "</table>\r\n";
?>
<p style="margin-left : 2cm; margin-top: 2mm; font-family: Arial; font-size: 10pt; font-weight: bold;"><br />
<b> Produsele au fost verificate vizual inainte de incarcare  |_|<br>
<b>Echipa Incarcare : ___________________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Responsabil Logistica : ___________________________<br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   : ___________________________________________ </br></br></br>
<b> Repartizare Transport<br>
<b>________% : ___________________________________________<br>
<b>________% : ___________________________________________<br>
<b>________% : ___________________________________________<br>
<b>________% : ___________________________________________<br>
<b>________% : ___________________________________________<br>
<b>________% : ___________________________________________<br>
 </p>
 
</body></html>

