<?php
   $dbConn = new mysqli("localhost", "root", "", "WSUBook");
   if($dbConn->connect_error) {
      die("Failed to connect to database " . $dbConn->connect_error);
   }
?>