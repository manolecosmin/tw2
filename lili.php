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

</style>
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
<center>
<p style="margin: 2px; padding: 2px;"><font size='4' color='#a00000' face='Verdana'><center><b>Validare plan de incarcare # <?php echo $_GET["id"];?></b></center></font></p> 
<hr style="margin: 1px 1px 1px 1px;" />
<?php


$allowlist = array(
    '192.168.1.248'
);


if(!in_array($_SERVER['REMOTE_ADDR'],$allowlist)){
    die('Nu ai voie');
	
$id = htmlspecialchars($_GET["id"]);
mysql_connect("localhost","root","");
mysql_select_db("Logistica");
echo "<input type='hidden' name='ID' value='".$_GET["id"]."' />";
$res=mysql_query("SELECT * FROM plan_hdr WHERE id=".$_GET["id"]) or die(mysql_error());
$row=mysql_fetch_row($res);
?>
<p style="margin: 2px; padding: 2px;"><center><b>Data : </b><span class="tMark"><?php echo $row[1];?></span> <b>&bull; Transportator : </center></b>
<?php

$result = mysql_query("SELECT * FROM trasport WHERE id=".$row[2]) or die(mysql_error());
$row=mysql_fetch_row($result);
echo "<b><i>".$rw[3]."</i> &bull; Auto nr. </b>".$row[3]." <b>&bull; Sofer : </b>".$row[4]." <b>&bull; Tel. </b>".$row[5]."<br />";
if ($row[6]!=0){
      $valtr=round($row[7]/$row[6],2);} 
else{
     $valtr=0;}	 
	 
$cursv=$row[8];

if($cursv <= 1)
	$cursv=4.84;
if ($row[10]==0){
$prvaltr=$row[7]*1;}
else {
$prvaltr=$row[7]*$cursv;}	

echo "<b>Total Km : </b>".$row[6]." --- <b>Valoare Transport : </b>".$prvaltr." RON "." --- <b>Lei/ Km <b>";
echo $valtr." RON"." --- <b>Curs Valutar : </b>".$cursv." RON</p><hr/>";
mysql_free_result($result);
mysql_free_result($res);
?>
<table border="1" cellspacing="0" cellpadding="2" width="1100">
<tr bgcolor="#F0F0F0">
<td align="center" width="180"><b>Client : </b></td>
<td align="center" width="30"><b>MON</b></td>
<td align="center" width="50"><b>Serie/Nr</b></td>
<td align="center" width="64"><b>Data cmd.</b></td>
<td align="center" width="220"><b>Produs</b></td>
<td align="center" width="60"><b>Cantitate</b></td>
<td align="center" width="30"><b>Desc.</b></td>
<td align="center" width="160"><b>Livrare la</b></td>
<td align="center" width="64"><b>Data livrarii</b></td>
<td align="center" width="64"><b>P.U.</b></td>
<td align="center" width="64"><b>Val.RON</b></td>
<td align="center" width="80"><b>Doc.</b></td>
<td align="center" width="24"><b>Del</b></td>
</tr>
<?php
$tval=0;
$res=mysql_query("SELECT * FROM plan WHERE pid=".($_GET["id"] ? $_GET['id'] : '0')." ORDER BY dord DESC") or die(mysql_error());
while ($row=mysql_fetch_row($res)) {
   echo "<tr valign='top'>";
   echo "<td align='left' width='180'><a href='plan_edit.php?pid=".$_GET["id"]."&id=".$row[0]."' class='sml'>".$row[2]."</a></td>";
   echo "<td align='center' width='30'>".$row[8]."</td>";   
   echo "<td align='center' width='50'>".$row[14]."</td>";   
   echo "<td align='center' width='64'>".strftime("%d.%m.%Y", strtotime($row[9]))."</td>";   
   echo "<td align='left' width='220'>".$row[3]."</td>";
   echo "<td align='right' width='60'>".$row[4]."</td>";
   echo "<td align='center' width='30'>".$row[5]."</td>";
   echo "<td align='left' width='160'>".$row[6]."</td>";
   echo "<td align='center' width='64'>".strftime("%d.%m.%Y", strtotime($row[7]))."</td>";
   echo "<td align='right' width='64'>".$row[10]."</td>";
   if ($row[8] == "EUR" || $row[8] == "EUN" || $row[8] == "E5%" || $row[8] == "EVA") {
      $val=$row[4] * $row[10] * $cursv;
   } else {
	   if($row[8]=="OFL"){
		   $val=$row[4] * $row[10] * 4.8;
	   }  
	   if($row[8]=="OFR"){
					$val=$row[4] * $row[10] * 5;
	   }   
	   if($row[8]=="LEI"){
					$val=$row[4] * $row[10];
	   }
   }
   $tval+=$val;
   echo "<td align='right' width='64'>".round($val, 2)."</td>";
   echo "<td align='right' width='80'>".$row[12]."</td>";
   echo "<td align='center' width='24'><a href='#' onclick='javascript:ConfDel(".$row[0].", ".$row[1].");' class='sml'> x </a></td>";
   echo "</tr>\r\n";
}
echo "</table>\r\n";

echo "&nbsp;&nbsp;&nbsp;<a href='planuri.php'class='btn' target='_blank'>Revenire</a>"


	
	$message = mysql_query("SELECT * FROM denial_reason WHERE id_transport = ".$_GET['id']." LIMIT 1");
while($row = mysql_fetch_assoc($message)){

	echo $row['mesaj']."<br>";
}



}
?>

</center>
</body></html>

