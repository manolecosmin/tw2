<?php
mysql_connect("localhost","root","");
mysql_select_db("logistica");

mysql_query("DELETE FROM trans_a WHERE id=".$_GET["id"]) or die(mysql_error());
header("Location: trans_a.php?id=".$_GET["trid"]);
exit;
?>

