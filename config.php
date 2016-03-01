<?php
// mysql -u root -p < tippning_2014.sql
// drop database tippning;
// Database host URL
$dbhost = "localhost";
// Database username
$dbuser = "root";
// Database password
$dbpass = "Josefine1";
// Database name
$dbname = "tippning";

// Date of first game
$firstGameStartY = 2016;
$firstGameStartM = 6;
$firstGameStartD = 10;
$firstGameDate = "2016-06-10";
// Last day to place bet
$last_bet_day = "2016-06-09";
// Last day to pay
$last_pay_day = "2016-06-10";
// Price in SEK
$price = 100;
// Boolean - Has cup started?
$cupStarted = date('Y-m-d') >= $firstGameDate;

$contactName = "";
$contactBankAccount = "";
$contactBankName = "";
$contactPhone = "";
$contactEmail = "";

$grundspel_max = 48; // 1-48
$eights_max = $grundspel_max + 8; // 49 - 56
$quarter_max = $eights_max + 4; // 57 - 60
$semi_max = $quarter_max + 2; // 61 - 62
$secondFinalId = $semi_max + 1; // 63
$finalId = $secondFinalId + 1; // 64
$slutspel_max = $finalId; // 64

$grundspel = Array('A','B','C','D','E','F','G','H');

function daysLeft() {
	$now = mktime();
//	$cupStart = mktime(0, 0, 0, $firstGameStartM, $firstGameStartD, $firstGameStartY);
	$cupStart = mktime(0, 0, 0, 06, 10, 2016);
	return floor(($cupStart - $now) / (60 * 60 * 24)) + 1;	
}

$procent_ett=70;
$procent_tva=20;
$procent_tre=10;
define("$WORLD_CUP", "0");
?>
