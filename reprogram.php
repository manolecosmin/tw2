<?php
	mysql_connect($_SERVER['SERVER_ADDR'],"root","");
    mysql_select_db("Logistica");
	if(isset($_POST['isRepr'])){
		$dt=substr($_POST['dataRepr'], 6, 4)."-".substr($_POST['dataRepr'], 3, 2)."-".substr($_POST['dataRepr'], 0, 2);
		mysql_query("INSERT INTO reprogram_data (id_inreg, changed_on, data_veche, data_noua, motiv, observatii) VALUES ('".$_POST['isRepr']."', CURRENT_TIMESTAMP(), (SELECT data FROM plan_hdr WHERE id='".$_POST['isRepr']."' LIMIT 1), '".$dt."', '".$_POST['motivRepr']."', '".$_POST['obsRepr']."'");
		mysql_query("UPDATE plan_hdr SET data='".$dt."' WHERE id='".$_POST['isRepr']."'");
		header("Location: planuri.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Reprogramare Data Plan incarcare intern</title>
<link rel="stylesheet" type="text/css" href="master.css">
<script language="JavaScript" type="text/javascript" src="/js_lib/dtpick.js"></script>
</head>
<body>
<h2>Reprogramare Plan de Incarcare Intern # <?php echo $_GET["id"];?> din data </h2>
<hr class="dRed" />
<form name='reprForm' method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<table border="1" cellspacing="0" cellpadding="2" style="border-collapse: collapse; margin: auto;">
<tr><td align="right"><b>Data noua: </b></td><td><input type="text" required name="dataRepr" >&nbsp;<a href="#" OnClick="javascript:show_calendar('document.reprForm.dataRepr', document.reprForm.dataRepr.value);"><img src="/js_lib/cal.gif" width="16" height="16" border="0" alt='Selecteaza data' /></a></td></tr>
<tr><td align="right"><b>Motiv: </b></td><td><select name="motivRepr" style="width: 100%;">
<option value="1">Transportator</option>
<option value="2">Productie</option>
<option value="3">Aprovizionare</option>
<option value="4">Stocuri</option>
<option value="5">Financiar - Contabilitate</option>
<option value="6">Camion Incomplet</option>
</select></td></tr>
<tr><td align="right"><b>Observatii: </b></td><td><textarea required class="FormElement" name="obsRepr" id="obsRepr" cols="40" rows="4"></textarea></td></tr>
</table>
<hr class="dRed" />
<p style="text-align: center;"><button type="submit" value="<?php echo $_GET['id'];?>" name="isRepr">Reprogrameaza</button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" onclick="window.history.back()">Anuleaza</button></p>
</form>
</body>
</html>