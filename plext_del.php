<?php
   session_start();
   mysql_connect("localhost","root","");
   mysql_select_db("Logistica");
   mysql_query("DELETE FROM plan_hdr_ext WHERE id=".$_GET["id"]) or die(mysql_error());
   mysql_query("DELETE FROM plan_ext WHERE pid=".$_GET["id"]) or die(mysql_error());
   header("Location: planext.php");
   exit;
?>

