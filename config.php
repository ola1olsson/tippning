<?php
// Database host URL
$dbhost = "localhost";
// Database username
$dbuser = "root";
// Database password
$dbpass = "ziptac135";
// Database name
$dbname = "thoka_se";

// Date of first game
$firstGameStartY = 2014;
$firstGameStartM = 6;
$firstGameStartD = 12;
$firstGameDate = "2014-06-12";
// Last day to place bet
$last_bet_day = "2014-06-12";
// Last day to pay
$last_pay_day = "2014-06-13";
// Price in SEK
$price = 100;
// Boolean - Has cup started?
$cupStarted = date('Y-m-d') >= $firstGameDate;

$contactName = "Tobias Lundgren";
$contactBankAccount = "111222333";
$contactBankName = "Swedbank";
$contactPhone = "07066666666";
$contactEmail = "ola1olsson@gmail.com";

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
	$cupStart = mktime(0, 0, 0, 06, 12, 2014);
	return floor(($cupStart - $now) / (60 * 60 * 24)) + 1;	
}
?>
