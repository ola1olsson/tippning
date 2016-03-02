<?php

// ansluter till MySQL

$opendb = mysql_connect($dbhost, $dbuser, $dbpass)
or die("Kunde inte ansluta till MySQL:<br />" . mysql_error());

// ansluter till min valda databas.

mysql_select_db($dbname)
or die("Kunde inte ansluta till databasen:<br />" . mysql_error());

?> 
