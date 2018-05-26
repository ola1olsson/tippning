<?php
// mysql -u root -p < tippning_2014.sql
// mysql> update users set admin=1 where username='ola';
// drop database tippning;
// Database host URL
$dbhost = "localhost";
// Database username
$dbuser = "root";
// Database password
$dbpass = "ziptac135";
// Database name
$dbname = "tippning";

// Date of first game
$firstGameStartY = 2018;
$firstGameStartM = 6;
$firstGameStartD = 14;
$firstGameDate = "2018-06-14";
// Last day to place bet
$last_bet_day = "2018-06-14";
// Last day to pay
$last_pay_day = "2088-06-14";
// Price in SEK
$price = 100;
// Boolean - Has cup started?
$cupStarted = date('Y-m-d') >= $firstGameDate;

$contactName = "Ola";
$contactBankAccount = "Swish";
$contactBankName = "";
$contactPhone = "0727095780";
$contactEmail = "ola.olsson@acconeer.com";

$WORLD_CUP =1;
if (defined($WORLD_CUP)) {
	$grundspel_max = 48;
	$grundspel = Array('A','B','C','D','E','F','G','H');
} else {
	$grundspel_max = 36;
	$grundspel = Array('A','B','C','D','E','F');
}
$eights_max = $grundspel_max + 8;
$quarter_max = $eights_max + 4;
$semi_max = $quarter_max + 2;
$secondFinalId = $semi_max + 1;
$finalId = $secondFinalId + 1;
$finalId = $semi_max + 1;
$slutspel_max = $finalId;


function daysLeft() {
	$now = mktime();
	$cupStart = mktime(0, 0, 0, 06, 14, 2014);
	return floor(($cupStart - $now) / (60 * 60 * 24)) + 1;	
}

$procent_ett=70;
$procent_tva=20;
$procent_tre=10;
?>
