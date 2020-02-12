<html><head>
<title>trasportatori</title>
<link rel="stylesheet" type="text/css" href="master.css" />

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
<body background="../sami_bkw.jpg">
<form method="post">
<center>
<p style="margin:4px;">&nbsp;<FONT SIZE='4' COLOR='#a00000'><STRONG>Transportatori</STRONG></FONT><HR>&nbsp;<b>Tip : </b>
<select name='PR' size='1'><option value='0' selected>Intern</option><option value='1'>Externe</option></select>
&nbsp;<input type='submit' name='BS' value='Filtreaza' class="input_butt">
&nbsp;&nbsp;<input type='button' name='B1' value='Adauga' class="input_butt" onclick='TaskNou();'>
<hr>
<?php
if (isset($_POST["BS"])) {
   echo "<table border='1' cellspacing='1'>";
   echo "<tr bgcolor='#F0F0F0'><td width='60' align='center'><b>Clasa</b></td>";
   echo "<td width='240' align='center'><b>Denumire</b></td>";
   echo "<td width='340' align='center'><b>Date contact</b></td>";
   echo "<td width='40' align='center'><b>X</b></td></tr>";
   mysql_connect("localhost","root","");
   mysql_select_db("Logistica");
   $result = mysql_query("SELECT * FROM trasport WHERE tip=".$_POST["PR"]." ORDER BY clasa") or die(mysql_error());
   while($row = mysql_fetch_row($result)) { 
      echo "<tr><td width='60' align='center'><b>";
      echo $row[16]+$row[17]+$row[18]+$row[19]+$row[20];
      echo "</b></td>";
      echo "<td width='320' align='center'><b><a href='trans_edit.php?id=".$row[0]."' clas='sml'>".$row[3]."</A><br />Localitatea : ".$row[11]."</b></td>";
      echo "<td width='320' align='left'>Persoana de contact : ".$row[6]."<br />Tel.".$row[7].", Fax : ".$row[8].", Mobil : ".$row[9]."<br />e@mail : ".$row[10]."</td>";
      echo "<td width='40' align='center'><a href='#' OnClick='ConfDel(".$row[0].");' class='sml'>del</a></td></tr>";
   }
   echo "</table>";
}
?>
</center></form></body></html>
