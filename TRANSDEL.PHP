<?php
   session_start();
   mysql_connect("localhost","root","");
   mysql_select_db("Logistica");

   mysql_query("DELETE FROM trasport WHERE id=".$_GET["id"]) or die(mysql_error());
   header("Location: transp.php");
   exit;
?>

