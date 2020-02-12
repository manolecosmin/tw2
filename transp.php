<?php
session_start();
if (!isset($_SESSION["TTIP"])) {
   $_SESSION["TTIP"]=0;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html><head>
<title>Transportatori</title>
<link rel="stylesheet" type="text/css" href="master.css">

<script type="text/javascript">

function ConfDel(vid) {
if (confirm("Stergeti inregistrarea curenta ?")) {
   self.location = "transdel.php?id="+vid;
   return true;
} else 
   return false;
}

function TaskNou() {
self.location = "trans_edit.php?id=0";
}

</script>
</head>
<body>
<center>
<form method="post" name="TRANS">
<p style="margin:4px; color:#a00000; font-size: 14pt; font-weight: bold; text-align: center"><b>Transportatori</b></font></p>
<hr style="margin: 2px; border-top: 1px dashed #A00000; border-bottom: none" />
<p style="text-align: center">
&nbsp;<b>Tip : </b>
<select name='PR' size='1'><option value='0' selected>Intern</option><option value='1'>Extern</option></select>
&nbsp;<input type='submit' name='FLT' value='Filtreaza' >&nbsp;&nbsp;<input type='button' name='B1' value='Adauga' onclick='TaskNou();'></p>
<?php
if (isset($_POST["FLT"])) {
   $_SESSION["TTIP"]=$_POST["PR"];
   unset($_POST["PR"]);
   unset($_POST["FLT"]);
}
?>
</form>
<script type="text/javascript">document.TRANS.PR.value="<?php echo $_SESSION["TTIP"];?>";</script>
<table border='1' cellspacing='0'>
<tr bgcolor='#F0F0F0'><td width='50' align='center'><b>Punctaj</b></td>
<td width='200' align='center'><b>Denumire</b></td>
<td width='380' align='center'><b>Date contact/Mod plata</b></td>
<td width='30' align='center'><b>Del</b></td>
<td width='60' align='center'><b>Cmd</b></td></tr>
<?php
mysql_connect("localhost","root","");
mysql_select_db("Logistica");
$result = mysql_query("SELECT * FROM trasport WHERE tip=".$_SESSION["TTIP"]." ORDER BY clasa DESC") or die(mysql_error());
$count=mysql_num_rows($result);
//echo "<p align='center'><b>".$count."</b> transportatori ...</p>";
while($row = mysql_fetch_row($result)) { 
      echo "<tr><td width='50' align='center'><b>";
      echo $row[16]+$row[17]+$row[18]+$row[19]+$row[20]+$row[21];
      echo "</b></td>";
      echo "<td width='200' align='center'><b><a href='trans_edit.php?id=".$row[0]."' clas='sml'>".$row[3]."</A><br />Localitatea : ".$row[11]."</b></td>";
      echo "<td width='380' align='left'>Persoana de contact : ".$row[6].", Tel.".$row[7].", Fax : ".$row[8].", Mobil : ".$row[9].", e@mail : ".$row[10]."<br /><font color='#FF0000'><b>".$row[26]."</b></font><div style='border: 1px solid #0000FF'><p>".$row[14]."</p></div></td>";
      echo "<td width='30' align='center'><a href='#' OnClick='ConfDel(".$row[0].");' class='sml'>x</a></td>";
      echo "<td width='60' align='center'>";
      if ($row[1] == 0) {
         echo "<a href='cmd0.php?id=".$row[0]."' class='sml'>Comanda</a><br />";
         echo "<a href='trans_a.php?id=".$row[0]."' class='sml'>Auto</a><br />";
         echo "<a href='trans_s.php?id=".$row[0]."' class='sml'>Soferi</a><br />";
      } else
         echo "<a href='cmd1.php?id=".$row[0]."' class='sml'>Comanda</a>";
      echo "</td></tr>\r\n";
}
?>
</table>
</center></body></html>
