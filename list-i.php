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
</head>
<body>
<center>
<p style="margin: 2px; padding: 2px;"><font size='4' color='#a00000' face='Verdana'><b>Lista incarcari</b></font></p>
<form name="LI" method="post" action="#">
<p align="center"><b>Perioada : </b>
<input type='text' name='DT1' size='10' /><a href="#" onclick="javascript:show_calendar('document.LI.DT1', document.LI.DT1.value);"><img src="/js_lib/cal.gif" width="16" height="16" border="0" alt='Selecteaza data' /></a>&nbsp;&divide; <input type='text' name='DT2' size='10' /><a href="#" onclick="javascript:show_calendar('document.LI.DT2', document.LI.DT2.value);"><img src="/js_lib/cal.gif" width="16" height="16" border="0" alt='Selecteaza data' /></a>&nbsp;<input type='submit' name='F3' value='Filtreaza' />
<p>
<script type="text/javascript">document.LI.DT1.value="<?php echo date("d.m.Y");?>";document.LI.DT2.value="<?php echo date("d.m.Y");?>";</script>
</form>
<hr />
<table border="1" cellspacing="0" cellpadding="2">
<tr bgcolor="#F0F0e0">
<td align="center" width="80"><b>Data</b></td>
<td align="center" width="220"><b>Transportator</b></td>
<td align="center" width="100"><b>Status</b></td>
<td align="center" width="160"><b>Ruta</b></td>
<td align="center" width="40"><b>Programat ora</b></td>
<td align="center" width="40"><b>Ora sosire</b></td>
<td align="center" width="40"><b>Ora plecare</b></td>
</tr>
<?php
if (isset($_POST["F3"])) {
   $dt_1=substr($_POST["DT1"], 6, 4)."-".substr($_POST["DT1"], 3, 2)."-".substr($_POST["DT1"], 0, 2);
   $dt_2=substr($_POST["DT2"], 6, 4)."-".substr($_POST["DT2"], 3, 2)."-".substr($_POST["DT2"], 0, 2);

   mysql_connect("localhost","root","");
   mysql_select_db("Logistica");
   $res=mysql_query("SELECT plan_hdr.id, DATE_FORMAT(plan_hdr.data, '%d.%m.%Y'), trasport.den, plan_hdr.inchis, plan_hdr.ora_prog, plan_hdr.ora_sos, plan_hdr.ora_plec FROM plan_hdr LEFT JOIN trasport ON trasport.id=plan_hdr.tr_id WHERE plan_hdr.data >= '".$dt_1."' AND plan_hdr.data <= '".$dt_2."' ORDER BY plan_hdr.data") or die(mysql_error());
   while ($row=mysql_fetch_row($res)) {
      echo "<tr>\n";
      echo "<td>".$row[1]."</td>";
      echo "<td>".$row[2]."</td>";
      switch ($row[3]) {
      case '0': $vstare="Procesare"; break;
      case '1': $vstare="Incarcare"; break;
      case '2': $vstare="Livrare"; break;
      case '3': $vstare="Livrat"; break;
      case '9': $vstare="Finalizata"; break;
      }
      echo "<td>".$vstare."</td>";
      //
      $rz=mysql_query("SELECT * FROM plan WHERE pid = ".$row[0]." ORDER BY dord DESC") or die(mysql_error());
      $rw=mysql_fetch_row($rz);
      echo "<td align='left'>".$rw[6]."</td>";
      //
      echo "<td>".$row[4]."</td>";
      echo "<td>".$row[5]."</td>";
      echo "<td>".$row[6]."</td>";
      echo "</tr>\n";
   }
   echo "</table>\r\n";
   echo "<script type='text/javascript'>document.LI.DT1.value='".$_POST["DT1"]."';document.LI.DT2.value='".$_POST["DT2"]."';</script>\r\n";
}
?>
</center>
</body></html>

