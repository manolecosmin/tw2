<?php
mysql_connect("localhost","root","");
mysql_select_db("Logistica");

if (isset($_POST["GO"])) {
   $sel=$_POST["selected"];
   for ($i = 0; $i < count($sel); $i++) {
      $sql = "SELECT * FROM livrari WHERE id=".$sel[$i];
      $res=mysql_query($sql) or die($sql."<br />".mysql_error());
      $rw=mysql_fetch_row($res);
      $qpr="INSERT INTO plan_ext VALUES('',".$_POST["PID"].", '".$rw[1]."', '".$rw[2]."', ".$rw[3].", '".$rw[4]."', '".$rw[5]."', ".$rw[6].")";
      mysql_query($qpr) or die($qpr."<br />".mysql_error());
      mysql_query("FLUSH TABLE plan_ext");
   }
   header("Location:pl_ext.php?id=".$_POST["PID"]);
   exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<title>Livrari Externe</title>
<link rel="stylesheet" type="text/css" href="master.css" />
</head>
<body>
<center>
<form name="TDD" method="POST">
<p align="center"><font size='4' color='#A00000'><b>Adaugare Livrari</b></font>
<?php
echo "<b> Client : </b><select name='cli' size='1'>\r\n";
$res=mysql_query("SELECT DISTINCT client FROM livrari") or die(mysql_error());
while ($row=mysql_fetch_row($res)) {
   echo "<option value='".$row[0]."'>".$row[0]."</option>\r\n";
}
?>
</select>&nbsp;<input type='submit' name='FILT' Value='Filtreaza' /></p>
<?php
$res=mysql_query("SELECT * FROM plan_hdr_ext WHERE id=".$_GET["id"]) or die(mysql_error());
$row=mysql_fetch_row($res);
echo "<p><b>Data : </b>".strftime("%d.%m.%Y", strtotime($row[1]))." <b>Transportator : </b>";
$result = mysql_query("SELECT * FROM trasport WHERE id=".$row[2]) or die(mysql_error());
$rw=mysql_fetch_row($result);
echo $rw[3]."<br /><b> Auto nr. </b>".$row[3]." <b>Sofer : </b>".$row[4]." <b>Tel. </b>".$row[5]."</p><hr />";
mysql_free_result($result);
mysql_free_result($res);
?>
<table border='1' cellpadding='2' cellspacing='0'>
<tr bgcolor="#F0F0F0">
<td align="center" width="20"><b>sel</b></td>
<td align="center" width="160"><b>Client : </b></td>
<td align="center" width="220"><b>Produs</b></td>
<td align="center" width="70"><b>Cantitate</b></td>
<td align="center" width="70"><b>Data cmd.</b></td>
<td align="center" width="70"><b>Data livrarii</b></td>
<td align="center" width="70"><b>P.U.</b></td>
</tr>
<?php
echo "<input type='hidden' name='PID' value='".$_GET["id"]."' />";
if (isset($_POST["FILT"])) {
   $qpr="SELECT * FROM livrari_ext WHERE client='".$_POST["cli"]."'";
} else {
   $qpr="SELECT * FROM livrari_ext";
}
$res=mysql_query($qpr) or die(mysql_error());
$tab=1;
while ($row = mysql_fetch_row($res)) {
   echo "<tr><td align='center' width=20'><input type='checkbox' name='selected[]' value='".$row[0]."' tabindex=".$tab." /></td>";
   echo "<td align='left' width='160'>".$row[1]."</td>";
   echo "<td align='left' width='220'>".$row[2]."</td>";
   echo "<td align='right' width='70'>".$row[3]."</td>";
   echo "<td align='center' width='70'>".strftime("%d.%m.%Y", strtotime($row[4]))."</td>";
   echo "<td align='center' width='70'>";
   if ($row[5] != '0000-00-00') {
      echo strftime("%d.%m.%Y", strtotime($row[5]));
   } else {
      echo "&nbsp;";
   }
   echo "</td>";
   echo "<td align='right' width='70'>".sprintf("%10.2f", $row[6])."</td>";
   echo "</tr>\r\n";
}
?>
</table>
<p align="center"><input type="submit" name="GO" value="Importa" /></p>
</form>
</center>
</body></html>
