<?php
// Database host URL
$dbhost = "thoka.se.mysql";
// Database username
$dbuser = "thoka_se";
// Database password
$dbpass = "thoka10513578";
// Database name
$dbname = "thoka_se";

// Date of first game
$firstGameStartY = 2010;
$firstGameStartM = 6;
$firstGameStartD = 11;
$firstGameDate = "2010-06-11";
// Last day to place bet
$last_bet_day = "2010-06-11";
// Last day to pay
$last_pay_day = "2010-06-14";
// Price in SEK
$price = 50;
// Boolean - Has cup started?
$cupStarted = date('Y-m-d') >= $firstGameDate;

$contactName = "Thobias Karlsson";
$contactBankAccount = "7478-1709.672";
$contactBankName = "Swedbank";
$contactPhone = "0761-45 29 60";
$contactEmail = "thobias.karlsson@gmail.com";

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
	$cupStart = mktime(0, 0, 0, 06, 11, 2010);
	return floor(($cupStart - $now) / (60 * 60 * 24)) + 1;	
}
?>