<?php
mysql_connect("localhost","root","");
mysql_select_db("Logistica");
if (isset($_POST["ANL"])) {
   header("Location: plan.php?id=".$_POST["PID"]);
   exit;
}
if (isset($_POST["SAL"])) {
   $cdt1=substr($_POST["DT1"], 6, 4)."-".substr($_POST["DT1"], 3, 2)."-".substr($_POST["DT1"], 0, 2);
   $cdt2=substr($_POST["DT2"], 6, 4)."-".substr($_POST["DT2"], 3, 2)."-".substr($_POST["DT2"], 0, 2);
   $qpr="UPDATE plan SET cant=".$_POST["CANT"].", locat='".$_POST["LOC"]."', dord=".$_POST["ORD"].", data_l='".$cdt1."', data_c='".$cdt2."', factura='".$_POST["DOC"]."', colisaj='".$_POST["COL"]."' WHERE pid=".$_POST["PID"]." AND id=".$_POST["ID"];
   mysql_query($qpr) or die(mysql_error());
   header("Location: plan.php?id=".$_POST["PID"]);
   exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<title>Plan incarcare intern</title>
<link rel="stylesheet" type="text/css" href="master.css">
<script language="JavaScript" type="text/javascript" src="/js_lib/dtpick.js"></script>
<script tyle="text/javascript">

function ConfDel(vid, vpid) {
if (confirm("Stergeti inregistrarea curenta ?")) {
   self.location="plan_del.php?id="+vid+"&pid="+vpid;
   return true;
} else 
   return false;
}
</script>

</head>
<body background="paper_bg.jpg">
<h2>Plan de incarcare intern</h2>
<hr style="border-top: 1px dashed #c00000; border-bottom: none" />
<center>
<form name='PLED' method='post'>
<?php
echo "<input type='hidden' name='PID' value='".$_GET["pid"]."' />";
echo "<input type='hidden' name='ID' value='".$_GET["id"]."' />";
$res=mysql_query("SELECT * FROM plan_hdr WHERE id=".$_GET["pid"]) or die(mysql_error());
$row=mysql_fetch_row($res);
echo "<p><b>Data : </b>".$row[1]." <b>Transportator : </b>";
$result = mysql_query("SELECT * FROM trasport WHERE id=".$row[2]) or die(mysql_error());
$rw=mysql_fetch_row($result);
echo $rw[3]."<br /><b> Auto nr. </b>".$row[3]." <b>Sofer : </b>".$row[4]." <b>Tel. </b>".$row[5]."</p><hr/>";
mysql_free_result($result);
mysql_free_result($res);
//
$result = mysql_query("SELECT * FROM plan WHERE pid=".$_GET["pid"]." AND id=".$_GET["id"]) or die(mysql_error());
$rw=mysql_fetch_row($result);
?>
<p align="left" style="margin-left: 50px;"><b>Client :</b> <?php echo utf8_encode($rw[2]);?> &nbsp; 
<b>Produs : </b><?php echo utf8_encode($rw[3]);?><br />
<b>Localitatea : </b><input type="text" name="LOC" size="30" />
<b>Cantitate : </b><input type="text" name="CANT" size="10" /><br />
<b>Data livrari : </b><input type="text" name="DT1" size="10" /> <b>Data comenzii : </b><input type="text" name="DT2" size="10" /><br />
<b>Ordinea descarcarii : </b><select name="ORD" size="1" />
<option selected value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
</select>
<b>Document : </b><input type="text" name="DOC" size="24" /><br />
<b>Colisaj livrare : </b><input type="text" name="COL" size="80" /><br />
</p>
<p style="text-align: center"><input type='submit' name='SAL' value='Salvez' />&nbsp;&nbsp;<input type='submit' name='ANL' value='Anulez' /></p>
</form>
</center>
<script type="text/javascript">
<?php
echo "document.PLED.CANT.value='".$rw[4]."';\r\n";
echo "document.PLED.LOC.value='".$rw[6]."';\r\n";
echo "document.PLED.DT1.value='".strftime("%d.%m.%Y", strtotime($rw[7]))."';\r\n";
echo "document.PLED.DT2.value='".strftime("%d.%m.%Y", strtotime($rw[9]))."';\r\n";
echo "document.PLED.ORD.value='".$rw[5]."';\r\n";
echo "document.PLED.DOC.value='".$rw[12]."';\r\n";
?>
</script>
</body></html>

