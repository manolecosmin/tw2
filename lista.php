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
<!-- <script language="JavaScript" type="text/javascript" src="/js_lib/dtpick.js"></script> -->
</head>
<body>
<a class="noprint" href="#Top" style="position: fixed; bottom: 10px; right: 10px; background: 0px;"><img src="img/go_top.png" style="width: 30px; height: 30px;"></a>
<center>
<p style="margin: 2px; padding: 2px; font-family: verdana, arial, sans-serif;font-size: 14pt; color: #a00000"><b>Planuri de incarcare</b></p>
<table border="1" cellspacing="0" cellpadding="2">
<tr bgcolor="#F0F0e0">
<td align="center" width="80"><b>Data</b></td>
<td align="center" width="220"><b>Transportator</b></td>
<td align="center" width="100"><b>Auto</b></td>
<td align="center" width="180"><b>Sofer</b></td>
<td align="center" width="100"><b>Tel.</b></td>
<td align="center" width="40"><b>Stare</b></td>
<td align="center" width="40"><b>ID</b></td>
<td align="center" width="190"><b>Tip Transport</b></td>
</tr>
<?php
mysql_connect("localhost","root","");
mysql_select_db("Logistica");
$vdata= date("Y-m-d", time()-(30 * 24 * 3600));
$res=mysql_query("SELECT plan_hdr.id, DATE_FORMAT(plan_hdr.data, '%d.%m.%Y'), trasport.den, plan_hdr.auto, plan_hdr.sofer, plan_hdr.tel, plan_hdr.inchis,plan_hdr.tmod 
FROM plan_hdr LEFT JOIN trasport ON trasport.id=plan_hdr.tr_id WHERE inchis <> 9 AND data>='".$vdata."' ORDER BY data DESC") or die(mysql_error());

while ($row=mysql_fetch_row($res)) {
   echo "<tr bgcolor='#c0c0ff'>\n";
   echo "<td>".$row[1]."</td>";
   echo "<td>".$row[2]."</td>";
   echo "<td>".$row[3]."</td>";
   echo "<td>".$row[4]."</td>";
   echo "<td>".$row[5]."</td>";
   switch ($row[6]) {
   case '0': $vstare="Procesare"; break;
   case '1': $vstare="Incarcare"; break;
   case '2': $vstare="Livrare"; break;
   case '3': $vstare="Livrat"; break;
   case '9': $vstare="Finalizata"; break;
   }
   echo "<td>".$vstare."</td><td>".$row[0]."</td>";
      if ($row[7] == 0)
   echo "<td align='center' width='60'><img src='img/truck.jpg' style='height: 30px; width: 40px; margin: 0;' alt='TIR'></td>";
  if ($row[7] == 1)
   echo "<td align='center' width='60'><img src='img/export.png' style='height: 30px; width: 40px; margin: 0;' alt='EXPORT'></td>";
if ($row[7] == 2)
   echo "<td align='center' width='60'><img src='img/camion.png' style='height: 30px; width: 30px; margin: 0;' alt='CAMION'></td>";
  if ($row[7] == 3)
   echo "<td align='center' width='60'><img src='img/client.png' style='height: 30px; width: 40px; margin: 0;' alt='CLIENT'></td>";
  if ($row[7] == 4)
   echo "<td align='center' width='60'><img src='img/schenker.png' style='height: 30px; width: 40px; margin: 0;' alt='GRUPAJ'></td>";
  if ($row[7] == 5)
   echo "<td align='center' width='60'><img src='img/fan_courier.png' style='height: 30px; width: 40px; margin: 0;' alt='CURIER'></td>";
 if ($row[7] == 6)
   echo "<td align='center' width='60'><img src='img/import.png' style='height: 30px; width: 40px; margin: 0;' alt='CURIER'></td>";
   echo "</tr>\n";
   $rz=mysql_query("SELECT * FROM plan WHERE pid = ".$row[0]." ORDER BY dord") or die(mysql_error());
   while ($rw=mysql_fetch_row($rz)) {   
	// get last word from the string
	$lastWord = substr($rw[2], strrpos($rw[2], ' ') + 1);

   $result=mysql_query("SELECT * FROM judete");
	$result_array = array();
error_reporting(0);
	while($row = mysql_fetch_assoc($result))	{
		$result_array[] = $row['judet'];
		foreach ($result_array as $test)	{
			while ($lastWord == $test)	{
				$agent1 = $row['agent1'];
				$email1 = $row['email1'];
				$agent2 = $row['agent2'];
				$email2 = $row['email2'];

				$lastWord = "$agent1 $email1 <br><br> $agent2 $email2";
			}
		}
	}

    echo "<tr>\n<td align='center'> - </td><td>".$rw[2]."</td><td colspan='2' align='left'>".$rw[3]." - ".$rw[4]."</td><td colspan='2' align='left'>".$rw[6]."</td><td></td><td colspan='2' align='left'>".$lastWord."</td></tr> \n";
   }
}
echo "</table>\r\n";
?>
</center>
</body></html>

