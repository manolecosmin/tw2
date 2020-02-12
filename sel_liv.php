<?php
mysql_connect("localhost", "root", "");
mysql_select_db("Logistica");
//
if (isset($_POST["GO"])) {
   $sel=$_POST["selected"];
   for ($i = 0; $i < count($sel); $i++) {
      $sql = "SELECT * FROM livrari WHERE id=".$sel[$i];
      $res=mysql_query($sql) or die($sql."<br>".mysql_error());
      $rw=mysql_fetch_row($res);
      $qpr="INSERT INTO plan VALUES('',".$_POST["PID"].", '".$rw[1]."', '".$rw[2]."', ".$rw[3].", 1, '".$rw[5]." - ".$rw[6]."', '".$rw[7]."', '".$rw[8]."', '".$rw[4]."', ".$rw[9].", 0, '', '','".$rw[12]."','".$rw[15]."','".$rw[16]."','".$rw[17]."','".$rw[18]."')";
      mysql_query($qpr) or die($qpr."<br />".mysql_error());
      mysql_query("FLUSH TABLE plan_ext");
   }
   header("Location:plan.php?id=".$_POST["PID"]);
   exit;
}
?>
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?xml version="1.0" encoding="UTF-8"?>
<head>
<meta charset="UTF-8">
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>Plan incarcare intern</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="master.css" />
<script language="JavaScript" type="text/javascript" src="/js_lib/dtpick.js"></script>
<style>
@media print{
	.noprint{
		display: none;
	}
}
</style>
</head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<body>
<a href="#Top" class="noprint" style="position: fixed; bottom: 10px; right: 10px; background: 0px;"><img src="img/go_top.png" style="width: 30px; height: 30px;"></a>
<center>
<form name="TDD" method="POST" action="#">
<p align="center"><font size='4' color='#A00000'><b>
<?php
if ($_GET["id"] != 0 )
  echo "Adaugare ";
?>
 Livrari</b></font><br />
<b> Client : </b><select name="cli" size="1">
<?php
$res=mysql_query("SELECT DISTINCT client FROM livrari ORDER BY client ASC") or die(mysql_error());
while ($row=mysql_fetch_row($res)) {
   echo "<option value='".utf8_encode($row[0])."'>".utf8_encode($row[0])."</option>\r\n";
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
<b>Zona : </b><select name="zona" size="1" />
<option value="0">Viorel</option>
<option value="1">Rodyca</option>
<option value="2">Magda</option>
</select> <input type='submit' name='FZ' Value='Filtreaza' /> <b>Produs :</b> <input type="text" name="ART" size="25" /> <input type='submit' name='FA' Value='Filtreaza' />
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
<table border='1' cellspacing="0" cellpadding='4' style="border: 1px solid #000000">
<tr bgcolor="#F0F0F0">
<td align="center" width="20"><b>sel</b></td>
<td align="center" width="160"><b>Client : </b></td>
<td align="center" width="40"><b>Moneda</b></td>
<td align="center" width="70"><b>SR/NR cmd.</b></td>
<td align="center" width="70"><b>Data cmd.</b></td>
<td align="center" width="220"><b>Produs</b></td>
<td align="center" width="70"><b>Cantitate</b></td>
<td align="center" width="160"><b>Livrare la</b></td>
<td align="center" width="70"><b>Data livrarii</b></td>
<td align="center" width="70"><b>P.U.</b></td>
<td align="center" width="70"><b>Stoc</b></td>
<td align="center" width="160"><b>Obs.</b></td>
<td align="center" width="50"><b>Confirmat</b></td>
</tr>
<?php
if (isset($_POST["FILT"]) || isset($_POST["FJ"]) || isset($_POST["FS"]) || isset($_POST["FA"]) || isset($_POST["FZ"])) {
	$qpr="SELECT livrari.*, stoc.stoc FROM livrari LEFT JOIN stoc ON stoc.articol=livrari.produs";
}	else 	{
	$qpr="SELECT livrari.*, stoc.stoc FROM livrari LEFT JOIN stoc ON stoc.articol=livrari.produs ORDER BY client";
}

if (isset($_POST["FILT"])) {
   $qpr.=" WHERE livrari.client='".utf8_decode($_POST["cli"])."'";
}
if (isset($_POST["FJ"])) {
   $qpr.=" WHERE livrari.judet='".$_POST["jud"]."'";
}
if (isset($_POST["FS"])) {
   $qpr.=" WHERE stoc.stoc<=0 OR ISNULL(stoc.stoc)";
}
if (isset($_POST["FA"])) {
   $qpr.=" WHERE livrari.produs LIKE '%".$_POST["ART"]."%' ORDER BY produs";
}

if (isset($_POST["FZ"])) {
   switch ($_POST["zona"]) {
   case "0":
      $qpr.=" WHERE livrari.client LIKE '%Suceava' OR livrari.client LIKE '%Neamt' OR livrari.client LIKE '%Harghita' OR livrari.client LIKE '%Brasov' OR livrari.client LIKE '%Covasna' OR livrari.client LIKE '%Vrancea' OR livrari.client LIKE '%Buzau'";
      break;
   case "1":
      $qpr.=" WHERE livrari.client LIKE '%Botosani' OR livrari.client LIKE '%Iasi' OR livrari.client LIKE '%Vaslui' OR livrari.client LIKE '%Galati' OR livrari.client LIKE '%Braila' OR livrari.client LIKE '%Tulcea' OR livrari.client LIKE '%Constanta' OR livrari.client LIKE '%Ialomita' OR livrari.client LIKE '%Calarasi' OR livrari.client LIKE '%Ilfov' OR livrari.client LIKE '%Bucuresti' OR livrari.client LIKE '%Prahova' OR livrari.client LIKE '%Dambovita' OR livrari.client LIKE '%Arges' OR livrari.client LIKE '%Giurgiu' OR livrari.client LIKE '%Teleorman' OR livrari.client LIKE '%Olt' OR livrari.client LIKE '%Vilcea' OR livrari.client LIKE '%Dolj' OR livrari.client LIKE '%Mehedinti' OR livrari.client LIKE '%..'";
      break;
   case "2":
         $qpr.=" WHERE livrari.client LIKE 'Dedeman%' OR livrari.client LIKE '%Gorj' OR livrari.client LIKE '%Buzau' OR livrari.client LIKE '%Iasi' OR livrari.client LIKE '%Galati' OR livrari.client LIKE '%Braila' OR livrari.client LIKE '%Tulcea' OR livrari.client LIKE '%Constanta' OR livrari.client LIKE '%Ialomita' OR livrari.client LIKE '%Calarasi' OR livrari.client LIKE '%Ilfov' OR livrari.client LIKE '%Bucuresti' OR livrari.client LIKE '%Prahova' OR livrari.client LIKE '%Dambovita' OR livrari.client LIKE '%Arges' OR livrari.client LIKE '%Giurgiu' OR livrari.client LIKE '%Teleorman' OR livrari.client LIKE '%Olt' OR livrari.client LIKE '%Vilcea' OR livrari.client LIKE '%Dolj' OR livrari.client LIKE '%Mehedinti' OR livrari.client LIKE '%..'";
     // $qpr.=" WHERE livrari.client LIKE '%Bistrita Nasaud' OR livrari.client LIKE '%Maramures' OR livrari.client LIKE '%Mures' OR livrari.client LIKE '%Satu Mare' OR livrari.client LIKE '%Gorj' OR livrari.client LIKE '%Timis' OR livrari.client LIKE '%Hunedoara' OR livrari.client LIKE '%Sibiu' OR livrari.client LIKE '%Alba' OR livrari.client LIKE '%Cluj' OR livrari.client LIKE '%Salaj' OR livrari.client LIKE '%Arad' OR livrari.client LIKE '%Caras Severin' OR livrari.client LIKE '%Bihor'";
      break;
   }
}
if (isset($_POST["FILT"]) || isset($_POST["FJ"]) || isset($_POST["FS"]) || isset($_POST["FA"]) || isset($_POST["FZ"]))
	$qpr.=" ORDER BY livrari.data_cmd";
$res=mysql_query($qpr) or die(mysql_error()."<br />".$qpr);
$tab=1;
while ($row = mysql_fetch_row($res)) {
   echo "<tr><td align='center'>";
   if ($_GET["id"] != 0 )
      echo "<input type='checkbox' name='selected[]' value='".$row[0]."' tabindex='".$tab++."' /></td>";
   echo "<td align='left'>".utf8_encode($row[1])."</td>";
   echo "<td align='center'>".$row[8]."</td>";
   echo "<td align='right'>".$row[12]."</td>";
   echo "<td align='center'>".strftime("%d.%m.%Y", strtotime($row[4]))."</td>";
   echo "<td align='left'>".utf8_encode($row[2])."</td>";
   echo "<td align='right'>".$row[3]."</td>";
   echo "<td align='left'>".utf8_encode($row[5])." - ".utf8_encode($row[6])."</td>";
   if ($row[14] != '0000-00-00'){
       	echo "<td align='center'>".strftime("%d.%m.%Y", strtotime($row[14]))."</td>";
		} 
	else {
		echo "<td align='center'>".strftime("%d.%m.%Y", strtotime($row[7]))."</td>";
		}
   echo "<td align='right'>".$row[9]."</td>";
   echo "<td align='right'>".$row[13]."</td>";
   echo "<td width='160'>".utf8_encode($row[10])."</td>";
   echo "<td align='center'>".$row[11]."</td>";
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
