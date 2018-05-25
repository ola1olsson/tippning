<?php
// ansluter till MySQL

$opendb = mysqli_connect($dbhost, $dbuser, $dbpass)
or die("Kunde inte ansluta till MySQL:<br />" . mysqli_connect_error());

// ansluter till min valda databas.

mysqli_select_db($opendb, $dbname)
or die("Kunde inte ansluta till databasen:<br />" . mysqli_error($opendb));

?>
