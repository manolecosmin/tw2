<?php
mysql_connect("localhost","root","");
mysql_select_db("logistica");
$lr="";
if (isset($_POST["ANL"])) {
   header("Location: planuri.php");
   exit;
}
if (isset($_POST["SAL"])) 
	if ($_POST["IDR"]<>0){
		  $qpr="UPDATE repartizari SET proc1='".$_POST["PR1"]."', proc2='".$_POST["PR2"]."', proc3='".$_POST["PR3"]."', proc4='".$_POST["PR4"]."', proc5='".$_POST["PR5"]."', proc6='".$_POST["PR6"]."', grupa1='".$_POST["GR1"]."', grupa2='".$_POST["GR2"]."', grupa3='".$_POST["GR3"]."', grupa4='".$_POST["GR4"]."', grupa5='".$_POST["GR5"]."', grupa6='".$_POST["GR6"]."' WHERE idfi=".$_POST["ID"];
		   mysql_query($qpr) or die(mysql_error());
		   mysql_query("UPDATE plan_hdr set repart=1 where id=".$_POST["ID"]) or die(mysql_error());
		   header("Location: planuri.php");
         exit;
		 }
        else {
	       $qpr="INSERT INTO repartizari (idfi,PROC1,PROC2,PROC3,PROC4,PROC5,PROC6,GRUPA1,GRUPA2,GRUPA3,GRUPA4,GRUPA5,GRUPA6) value ('".$_POST["ID"]."','".$_POST["PR1"]."','".$_POST["PR2"]."','".$_POST["PR3"]."','".$_POST["PR4"]."','".$_POST["PR5"]."','".$_POST["PR6"]."','".$_POST["GR1"]."','".$_POST["GR2"]."','".$_POST["GR3"]."','".$_POST["GR4"]."','".$_POST["GR5"]."','".$_POST["GR6"]."')"; 
		  echo $qpr;"\r\n";
		  mysql_query($qpr) or die(mysql_error());
		  mysql_query("UPDATE plan_hdr set repart=1 where id=".$_POST["ID"]) or die(mysql_error());
		   header("Location: planuri.php");
		   exit;
             }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<title>Repartizare Transport</title>
<link rel="stylesheet" type="text/css" href="master.css">
<script language="JavaScript" type="text/javascript" src="/js_lib/dtpick.js"></script>
</head>

<body background="paper_bg.jpg">
<h2>Repartizare transport pe grupe de marfa</h2>
<hr style="border-top: 1px dashed #c00000; border-bottom: none" />
<center>
<form name='PLED' method='post'>
<?php
echo "<input type='hidden' name='ID' value='".$_GET["id"]."' />";
echo "<input type='hidden' name='IDR' value=0 />";
$res=mysql_query("SELECT * FROM plan_hdr WHERE id=".$_GET["id"]) or die(mysql_error());
$row=mysql_fetch_row($res);
echo "<p><b>Data : </b>".$row[1]." <b>Transportator : </b>";
$result = mysql_query("SELECT * FROM trasport WHERE id=".$row[2]) or die(mysql_error());
$rw=mysql_fetch_row($result);
echo $rw[3]."<br /><b> Auto nr. </b>".$row[3]." <b>Sofer : </b>".$row[4]." <b>Tel. </b>".$row[5]."</p><hr/>";
mysql_free_result($result);
mysql_free_result($res);
//
$resgr = mysql_query("SELECT DISTINCT codgrupa,grupe.denumire from plan pp LEFT JOIN grupe ON grupe.simbol=pp.codgrupa WHERE pid=".$_GET["id"]) or die(mysql_error());

$result = mysql_query("SELECT * from repartizari WHERE idfi=".$_GET["id"]) or die(mysql_error());
echo "SELECT * from repartizari WHERE idfi=".$_GET["id"],"\r\n";
$lr=mysql_fetch_row($result);

//echo "cod inregistrare:". count($lr),"\r\n";
//echo "cod inregistrare:",$lr[0],"\r\n";
//echo "cod inregistrare:",$lr[1],"\r\n";
//echo "cod inregistrare:",$lr[8],"\r\n";

?>

<table width="520" cellpadding="10" cellspacing="2">
<tr valign="middle" align="CENTER">
<td width="150"><b>Grupe de Marfa</b></td>
</tr>
<?php
while ($lg=mysql_fetch_row($resgr)) {
echo "<tr valign='top' align='LEFT'>";
echo "<td width='150'><b>".$lg[1]."</b></td>";
echo "</tr>";
}
?>
</table>

<br /><br />
<b>ALOCARE PROCENTE VOLUM TRANSPORT:</b><br /><br />

<b>Procent : </b><input type="number" name="PR1" size="6" min="0" max="100"/><b> % / Grupa Marfa : </b> <input type="text" name="GR1" size="50" /><br />
<b>Procent : </b><input type="number" name="PR2" size="6" min="0" max="100"/><b> % / Grupa Marfa : </b> <input type="text" name="GR2" size="50" /><br />
<b>Procent : </b><input type="number" name="PR3" size="6" min="0" max="100"/><b> % / Grupa Marfa : </b> <input type="text" name="GR3" size="50" /><br />
<b>Procent : </b><input type="number" name="PR4" size="6" min="0" max="100"/><b> % / Grupa Marfa : </b> <input type="text" name="GR4" size="50" /><br />
<b>Procent : </b><input type="number" name="PR5" size="6" min="0" max="100"/><b> % / Grupa Marfa : </b> <input type="text" name="GR5" size="50" /><br />
<b>Procent : </b><input type="number" name="PR6" size="6" min="0" max="100"/><b> % / Grupa Marfa : </b> <input type="text" name="GR6" size="50" /><br />

<p style="text-align: CENTER"><input type='submit' name='SAL' value='Salvez' />&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' name='ANL' value='Anulez' /></p>
</form>
</center>
<script type="text/javascript">
<?php
if (count($lr)==1){
		echo "document.PLED.PR1.value='0';\r\n";
		echo "document.PLED.PR2.value='0';\r\n";
		echo "document.PLED.PR3.value='0';\r\n";
		echo "document.PLED.PR4.value='0';\r\n";
		echo "document.PLED.PR5.value='0';\r\n";
		echo "document.PLED.PR6.value='0';\r\n";
		echo "document.PLED.IDR.value='0';\r\n";
}
else{
		echo "document.PLED.PR1.value='".$lr[1]."';\r\n";
		echo "document.PLED.PR2.value='".$lr[2]."';\r\n";
		echo "document.PLED.PR3.value='".$lr[3]."';\r\n";
		echo "document.PLED.PR4.value='".$lr[4]."';\r\n";
		echo "document.PLED.PR5.value='".$lr[5]."';\r\n";
		echo "document.PLED.PR6.value='".$lr[6]."';\r\n";
}
	
echo "document.PLED.GR1.value='".$lr[8]."';\r\n";
echo "document.PLED.GR2.value='".$lr[9]."';\r\n";
echo "document.PLED.GR3.value='".$lr[10]."';\r\n";
echo "document.PLED.GR4.value='".$lr[11]."';\r\n";
echo "document.PLED.GR5.value='".$lr[12]."';\r\n";
echo "document.PLED.GR6.value='".$lr[13]."';\r\n";
echo "document.PLED.IDR.value='".$lr[0]."';\r\n";
?>
</script>
</body></html>

