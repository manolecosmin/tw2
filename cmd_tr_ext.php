<?php
if (isset($_POST["BA"])) {
   echo "<script type='text/javascript'>window.close();</script>";
   exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD>
	<META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=windows-1252">
	<TITLE>Comanda Transport Extern</TITLE>
	<META NAME="AUTHOR" CONTENT="CrissR">

<STYLE>
	<!--
		@page { size: 21.00cm 29.70cm; margin-left: 0.1cm; margin-right: 0.5cm; margin-top: 0.40cm; margin-bottom: 1.4cm }
		P { margin-bottom: 0.1cm; direction: ltr; color: #000000; widows: 2; orphans: 2 }
    TR,TD {border-top: 1pt solid #000000;}
	-->
	</STYLE>
</HEAD>
<BODY LANG="ro-RO" TEXT="#000000" DIR="LTR" background="antet_samiplastic.jpg" style="margin-left: 2cm; margin-top:2.5cm; margin-right: 1.5cm">
<P ALIGN=CENTER><br /><FONT FACE="Verdana, Arial" SIZE=5><b>COMANDA / CONTRACT<br />
DE TRANSPORT INTERNA&#354;IONAL DE MARF&#258;</b></font><br /><br /></p>
<?php
mysql_connect("localhost","root","");
mysql_select_db("Logistica");
$result = mysql_query("SELECT * FROM trasport WHERE id=".$_POST["TRID"]) or die(mysql_error());
$row=mysql_fetch_row($result);
echo "<p style='margin-left: 40%'><b>Catre :</b>".$row[3]." - ".$row[6]."<br /><b>Fax : </b>".$row[8]."<br /></p>\r\n";
echo "<p align='justify'>&nbsp;&nbsp;&nbsp;".$_POST["ANT"]."<br /></p>";
?>
<TABLE WIDTH=633 CELLPADDING=7 CELLSPACING=0 style="border-top: 1px solid #000000; border-bottom: 1px solid #000000">
<?php
echo "<tr valign='top'>";
echo "<td width='279'><b>1. Locul incarcarii</b></td><td width='326'><b>";

if ($_POST["DEST1"] != 0) {
   $rz=mysql_query("SELECT * FROM locatii WHERE id=".$_POST["DEST1"]) or die(mysql_error());
   $rw=mysql_fetch_row($rz);
   echo $rw[1]."<br />".$rw[2]."<hr />";
}
if ($_POST["DEST2"] != 0) {
   $rz=mysql_query("SELECT * FROM locatii WHERE id=".$_POST["DEST2"]) or die(mysql_error());
   $rw=mysql_fetch_row($rz);
   echo $rw[1]."<br />".$rw[2]."<hr />";
}
if ($_POST["DEST3"] != 0) {
   $rz=mysql_query("SELECT * FROM locatii WHERE id=".$_POST["DEST3"]) or die(mysql_error());
   $rw=mysql_fetch_row($rz);
   echo $rw[1]."<br />".$rw[2]."<hr />";
}
if ($_POST["DEST4"] != 0) {
   $rz=mysql_query("SELECT * FROM locatii WHERE id=".$_POST["DEST4"]) or die(mysql_error());
   $rw=mysql_fetch_row($rz);
   echo $rw[1]."<br />".$rw[2]."<hr />";
}
echo "</td></tr>";
echo "<tr valign='top'><td width='279'><b>2. Data/Ora incarcarii</b></td>";
echo "<td width='326'><b>".$_POST["DT"].", ".$_POST["OT"]."</b></td></tr>";
echo "<tr valign='top'><td width='279'><b>3. Marfa </b></td>";
echo "<td width='326'><b>".$_POST["MARFA"]."</b></td></tr>";
echo "<tr valign='top'><td width='279'><b>4. Locul descarcarii</b></td>";
echo "<td width='326'><b>Suceava,<br />Str.Aurel Vlaicu nr.62</b></td></tr>";
echo "<tr valign='top'><td width='279'><b>5. Vamuriea </b></td>";
echo "<td width='326'><B>Suceava &ndash; Romtrans</b></td></tr>";
echo "<tr valign='top'><td width='279'><b>6. Tarif</b></td>";
echo "<TD WIDTH='326'><b>".$_POST["TR"]."</b> Euro</td></tr>";
echo "<tr valign='top'><td width='279'><b>7. Modalitate de plata</b></td>";
echo "<td width='326'><b>".$_POST["MP"]."</b></td></tr>";
echo "<tr valign='top'><td width='279'><b>8.Mentiuni</b></td>";
echo "<td width='326'><b>Nr.camion : ".$_POST["CM"]."</b></td></tr>";
?>
<TR VALIGN=TOP>
   <TD WIDTH=279 HEIGHT=61>
   <P><b>9. Observatii</b></P>
   </TD>
   <TD WIDTH=326>
   <P><B>Marfa va avea facturi externe si CMR- certificate de origine EUR 1 (care va fi obtinut
				de soferul dvs. si va fi responsabilitatea lui).</B></P>
   </TD>
</TR>
</TABLE>
<P ALIGN="JUSTIFY"><b>10.</b> Transportul se va executa pe r&#259;spunderea (asigurarea)
dumneavoastr&#259; conform conven&#355;iei  interna&#355;ionale CMR.<br />
<b>11.</b> Rug&#259;m confirma&#355;i primirea, executarea &#351;i num&#259;rul
camionului la tel/fax: 0230/525045,  525016, fax direct: 0230/533142<br />
<b>12.</b> In caz de neonorare in termen a prezentei comenzi, se percep
penalitati de 150 Euro pentru fiecare zi de intarziere.<br />
<b>13.</b> In cazul in care camionul nu poate sosi la ora specificata pentru incarcare, va rugam sa ne contactati.<br />
</P>
<P LANG="ro-RO" align="left" style="margin-left: 60px;"><B>Resp. Logistica</B><br /><br />
..........................</P>
</BODY></HTML>
