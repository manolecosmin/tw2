<?php
mysql_connect("localhost", "root", "");
mysql_select_db("Logistica");

if (isset($_POST["GO"])) {
   $sel=$_POST["selected"];
   for ($i = 0; $i < count($sel); $i++) {
      $sql = "SELECT * FROM livrari WHERE id=".$sel[$i];
      $res=mysql_query($sql) or die($sql."<br>".mysql_error());
      $rw=mysql_fetch_row($res);
      $qpr="INSERT INTO plan VALUES('',".$_POST["PID"].", '".$rw[1]."', '".$rw[2]."', ".$rw[3].", 0, '".$rw[5]." - ".$rw[6]."', '".$rw[7]."', '".$rw[8]."', '".$rw[4]."', ".$rw[9].", 0, '', '')";
      mysql_query($qpr) or die($qpr."<br />".mysql_error());
      mysql_query("FLUSH TABLE plan");
   }
   header("Location:plan.php?id=".$_POST["PID"]);
   exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<title>Plan incarcare intern</title>
<link rel="stylesheet" type="text/css" href="master.css" />
<script language="JavaScript" type="text/javascript" src="/js_lib/dtpick.js"></script>
</head>
<body>
<center>
<form name="TDD" method="POST" action="#">
<p align="center"><font size='4' color='#A00000'><b>Adaugare Livrari</b></font><br />
<b> Client : </b><select name="cli" size="1">
<?php
$res=mysql_query("SELECT DISTINCT client FROM livrari") or die(mysql_error());
while ($row=mysql_fetch_row($res)) {
   echo "<option value='".htmlspecialchars($row[0], ENT_QUOTES)."'>".$row[0]."</option>\r\n";
}
?>
</select>&nbsp;<input type='submit' name='FILT' Value='Filtreaza' /> &nbsp;
<b> Judet : </b><select name="jud" size="1">
<?php
$res=mysql_query("SELECT DISTINCT judet FROM livrari") or die(mysql_error());
while ($row=mysql_fetch_row($res)) {
   echo "<option value='".htmlspecialchars($row[0], ENT_QUOTES)."'>".$row[0]."</option>\r\n";
}
?>
</select>&nbsp;<input type='submit' name='FJ' Value='Filtreaza' /> <input type='submit' name='FS' Value='Stoc=0' /><br />
<b>Produs :</b> <input type="text" name="ART" size="25" /> <input type='submit' name='FA' Value='Filtreaza' />
</p>
<?php
if ($_GET["id"] != 0 ) {
   $res=mysql_query("SELECT * FROM plan_hdr WHERE id=".$_GET["id"]) or die(mysql_error());
   $row=mysql_fetch_row($res);
   echo "<p><b>Data : </b>".$row[1]." <b>Transportator : </b>";
   $result = mysql_query("SELECT * FROM trasport WHERE id=".$row[2]) or die(mysql_error());
   $rw=mysql_fetch_row($result);
   echo $rw[3]."<br /><b> Auto nr. </b>".$row[3]." <b>Sofer : </b>".$row[4]." <b>Tel. </b>".$row[5]."</p><hr/>";
   mysql_free_result($result);
   mysql_free_result($res);
}
?>
<input type="hidden" name="PID" value="<?php echo $_GET["id"];?>" />
<table border='1' cellspacing="0" cellpadding='4'>
<tr bgcolor="#F0F0F0">
<td align="center" width="20"><b>sel</b></td>
<td align="center" width="160"><b>Client : </b></td>
<td align="center" width="220"><b>Produs</b></td>
<td align="center" width="70"><b>Cantitate</b></td>
<td align="center" width="160"><b>Livrare la</b></td>
<td align="center" width="70"><b>Data cmd.</b></td>
<td align="center" width="70"><b>Data livrarii</b></td>
<td align="center" width="40"><b>Moneda</b></td>
<td align="center" width="70"><b>P.U.</b></td>
<td align="center" width="70"><b>Stoc</b></td>
<td align="center" width="70"><b>Confirmat</b></td>
</tr>
<?php
$qpr="SELECT livrari.*, stoc.stoc FROM livrari LEFT JOIN stoc ON stoc.articol=livrari.produs";
if (isset($_POST["FILT"])) {
   $qpr.=" WHERE livrari.client='".$_POST["cli"]."'";
}
if (isset($_POST["FJ"])) {
   $qpr.=" WHERE livrari.judet='".$_POST["jud"]."'";
}
if (isset($_POST["FS"])) {
   $qpr.=" WHERE stoc.stoc<=0 OR ISNULL(stoc.stoc)";
}
if (isset($_POST["FA"])) {
   $qpr.=" WHERE livrari.produs LIKE '%".$_POST["ART"]."%'";
}
$res=mysql_query($qpr) or die(mysql_error());
$tab=1;
while ($row = mysql_fetch_row($res)) {
   echo "<tr><td align='center' width='20'>";
   if ($_GET["id"] != 0 )
      echo "<input type='checkbox' name='selected[]' value='".$row[0]."' tabindex='".$tab++."' /></td>";
   echo "<td align='left' width='160'>".$row[1]."</td>";
   echo "<td align='left' width='220'>".$row[2]."</td>";
   echo "<td align='right' width='70'>".$row[3]."</td>";
   echo "<td align='left' width='160'>".$row[5]." - ".$row[6]."</td>";
   echo "<td align='center' width='70'>".strftime("%d.%m.%Y", strtotime($row[4]))."</td>";
   echo "<td align='center' width='70'>".strftime("%d.%m.%Y", strtotime($row[7]))."</td>";
   echo "<td align='center' width='40'>".$row[8]."</td>";
   echo "<td align='right' width='70'>".$row[9]."</td>";
   echo "<td align='right' width='70'>".$row[11]."</td>";
   echo "<td align='right' width='70'>".$row[10]."</td>";
   echo "</tr>\r\n";
}
?>
</table>
<?php
if ($_GET["id"] != 0 )
   echo "<input type=\"submit\" name=\"GO\" value=\"Importa\" />";
?>
</form>
</center>
</body></html>
