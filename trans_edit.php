<?php
session_start();
if (isset($_POST["BS"])) {
   mysql_connect("localhost","root","");
   mysql_select_db("logistica");

   $da=substr($_POST["t1"], 6, 4)."-".substr($_POST["t1"], 3, 2)."-".substr($_POST["t1"], 0, 2);
   
   if ($_POST["VID"] == 0)
      $qpr="INSERT INTO trasport SET tip=".$_POST["d0"].", data_a='".$da."', den='".strtoupper($_POST["t2"])."', cui='".$_POST["t5"]."', reg_com='".$_POST["t6"]."', pers_c='".$_POST["t7"]."', tel='".$_POST["t8"]."', fax='".$_POST["t9"]."', mobil='".$_POST["t10"]."', e_mail='".$_POST["t11"]."', local='".$_POST["t3"]."', judet='".$_POST["t4"]."', adresa='".$_POST["s1"]."', obs='".$_POST["s2"]."', pret_km=".$_POST["t12"].",c1=".$_POST["d1"].",c2=".$_POST["d2"].",c3=".$_POST["d3"].",c4=".$_POST["d4"].", c5=".$_POST["d5"].", c6=".$_POST["d6"].", mod_plata='".$_POST["mp"]."', clasa=".($_POST["d1"]+$_POST["d2"]+$_POST["d3"]+$_POST["d4"]+$_POST["d5"]+$_POST["d6"]);
   else
      $qpr="UPDATE trasport SET tip=".$_POST["d0"].", data_a='".$da."', den='".strtoupper($_POST["t2"])."', cui='".$_POST["t5"]."', reg_com='".$_POST["t6"]."', pers_c='".$_POST["t7"]."', tel='".$_POST["t8"]."', fax='".$_POST["t9"]."', mobil='".$_POST["t10"]."', e_mail='".$_POST["t11"]."', local='".$_POST["t3"]."', judet='".$_POST["t4"]."', adresa='".$_POST["s1"]."', obs='".$_POST["s2"]."', pret_km=".$_POST["t12"].",c1=".$_POST["d1"].",c2=".$_POST["d2"].",c3=".$_POST["d3"].",c4=".$_POST["D4"].", c5=".$_POST["D5"].", c6=".$_POST["d6"].", mod_plata='".$_POST["mp"]."', clasa=".($_POST["d1"]+$_POST["d2"]+$_POST["d3"]+$_POST["d4"]+$_POST["d5"]+$_POST["d6"])." WHERE id=".$_POST["VID"];
   mysql_query($qpr) or die(mysql_error());
   header("Location: transp.php");
   exit;
}
if (isset($_POST["BA"])) {
   header("Location: transp.php");
   exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html><head>
<meta http-equiv="content-type" content="text/html; charset=windows-1252" />
<link rel="stylesheet" type="text/css" ref="master.css" />
<title>Transportator</title>
</head>
<body>
<form name='FTR' method="post">
<?php
mysql_connect("localhost","root","");
mysql_select_db("logistica");
?>
<input type="hidden" name="VID" value="<?php echo $_GET["id"];?>" />
<p style="margin-left: 10px; color:#A00000; font-family: verdana, arial, sans-serif; font-size: 12pt; font-weight:bold"><b>Transportator</b></p>
<hr />
<p style="margin-left: 10px;" >
<b>Tip : </b>
<select name='d0'>
<option value='0' selected>Intern</option>
<option value='1'>Extern</option>
</select>
<b>Data ultimei actualizari :</b> <input type="text" name='t1' size="12" /><br />
<B>Denumire : </b><input type="text" name='t2' size="40" /><br />
<B>Localitatea : </b><input type="text" name='t3' size="20" />
<B>Judetul :</b> <input type="text" name='t4' size="20" /><br />
<B>C.U.I. : </b><input type="text" name='t5' size="20" />
<B>Nr.reg.com. :</b> <input type="text" name='t6' size="20" /><br />
<B>Persoana de contact :</b> <input type="text" name='t7' size="40" /><br />
<B>Tel.</b> <input type="text" name='t8' size="12" />
<B>Fax : </b><input type="text" name='t9' size="12" />
<B>Mobil : </b><input type="text" name='t10' size="12" /><br />
<B>e-mail : </b><input type="text" name='t11' size="32" /><br />
<b>Adresa :</b> <textarea name='s1' rows='2' cols='40'></textarea><br />
<b>Obs.</b> <textarea name='s2' rows='2' cols='60'></textarea><br />
<b>Pret/Km :</b> <input type='text' name='t12' size='10' value='0' /><br />

<b>Punctaje : --------------------------------------------------------------------------------</b><br />
<b>Pret/km :</b> <select name='d1'>
<option value='1'>1</option>
<option value='2'>2</option>
<option value='3'>3</option>
<option value='4'>4</option>
<option value='5'>5</option>
<option value='6'>6</option>
<option value='7'>7</option>
<option value='8'>8</option>
<option value='9'>9</option>
<option value='10'>10</option>
</select>

<b>Punctualitate :</b> <select name='d2'>
<option value='1'>1</option>
<option value='2'>2</option>
<option value='3'>3</option>
<option value='4'>4</option>
<option value='5'>5</option>
<option value='6'>6</option>
<option value='7'>7</option>
<option value='8'>8</option>
<option value='9'>9</option>
<option value='10'>10</option>
</select>

<b>Dotari :</b> <select name='d3'>
<option value='1'>1</option>
<option value='2'>2</option>
<option value='3'>3</option>
<option value='4'>4</option>
<option value='5'>5</option>
<option value='6'>6</option>
<option value='7'>7</option>
<option value='8'>8</option>
<option value='9'>9</option>
<option value='10'>10</option>
</select>

<b>Disponibilitate livrari multiple :</b> <select name='d4'>
<option value='1'>1</option>
<option value='2'>2</option>
<option value='3'>3</option>
<option value='4'>4</option>
<option value='5'>5</option>
<option value='6'>6</option>
<option value='7'>7</option>
<option value='8'>8</option>
<option value='9'>9</option>
<option value='10'>10</option>
</select>

<b>Promptitudine : </b> <select name='d5'>
<option value='1'>1</option>
<option value='2'>2</option>
<option value='3'>3</option>
<option value='4'>4</option>
<option value='5'>5</option>
<option value='6'>6</option>
<option value='7'>7</option>
<option value='8'>8</option>
<option value='9'>9</option>
<option value='10'>10</option>
</select>

<b>Mod plata : </b> <select name='d6'>
<option value='1'>1</option>
<option value='2'>2</option>
<option value='3'>3</option>
<option value='4'>4</option>
<option value='5'>5</option>
<option value='6'>6</option>
<option value='7'>7</option>
<option value='8'>8</option>
<option value='9'>9</option>
<option value='10'>10</option>
</select><br />
<b>Modalitate de plata : </b><input type='text' name='mp' size='40' />
<?php
if ($_GET["id"] != 0) {
   $qr=mysql_query("SELECT * FROM trasport WHERE id=".$_GET["id"]) or die(mysql_error());
   $row=mysql_fetch_row($qr);
   echo "<script language='javascript' type='text/javascript'>\r\n";
   echo "document.FTR.d0.value='".$row[1]."';\r\n";
   echo "document.FTR.t1.value='".strftime("%d.%m.%y", strtotime($row[2]))."';\r\n";
   echo "document.FTR.t2.value='".$row[3]."';\r\n";
   echo "document.FTR.t3.value='".$row[11]."';\r\n";
   echo "document.FTR.t4.value='".$row[12]."';\r\n";
   echo "document.FTR.t5.value='".$row[4]."';\r\n";
   echo "document.FTR.t6.value='".$row[5]."';\r\n";
   echo "document.FTR.t7.value='".$row[6]."';\r\n";
   echo "document.FTR.t8.value='".$row[7]."';\r\n";
   echo "document.FTR.t9.value='".$row[8]."';\r\n";
   echo "document.FTR.t10.value='".$row[9]."';\r\n";
   echo "document.FTR.t11.value='".$row[10]."';\r\n";
   echo "document.FTR.s1.value='".$row[13]."';\r\n";
   echo "document.FTR.s2.value='".$row[14]."';\r\n";
   echo "document.FTR.t12.value='".$row[15]."';\r\n";

   echo "document.FTR.d1.value='".$row[16]."';\r\n";
   echo "document.FTR.d2.value='".$row[17]."';\r\n";
   echo "document.FTR.d3.value='".$row[18]."';\r\n";
   echo "document.FTR.d4.value='".$row[19]."';\r\n";
   echo "document.FTR.d5.value='".$row[20]."';\r\n";
   echo "document.FTR.d6.value='".$row[21]."';\r\n";
   echo "document.FTR.mp.value='".$row[26]."';\r\n";

   echo "</script>\r\n";
} else {
   echo "<script type='text/javascript' language='javascript'>\r\n";
   echo "document.FTR.t1.value='".date("d.m.y")."';\r\n";
   echo "</script>\r\n";
}
?>
<hr />
<p align="center"><input type="submit" name="BS" value="Salvare">&nbsp;&nbsp;<input type="submit" name="BA" value="Anulare"></p>
</form>
</body></html>
