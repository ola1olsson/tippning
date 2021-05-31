<?php
// mysql -u root -p < tippning_2014.sql
// mysql> update users set admin=1 where username='ola';
// drop database tippning;
// Database host URL
$dbhost = "localhost";
// Database username
$dbuser = "ola1_setippning";
// Database password
$dbpass = "passwd";
// Database name
$dbname = "ola1_setippning";

// Date of first game
$firstGameDate = '2021-06-11';
// Last day to place bet
$last_bet_day = "2021-06-10";

// Last day to pay
$last_pay_day = $last_bet_day;

// Price in SEK
$price = 100;


$championship_string = "EM 2021";

// Boolean - Has cup started?
$cupStarted = date('Y-m-d') >= $firstGameDate;

$contactName = "Ola";
$contactBankAccount = "Swish xxxx";
$contactBankName = $contactBankAccount;
$contactPhone = "0727xxxxx";
$contactEmail = "ola1olsson@gmail.com";

// World cup
//$grundspel_max = 48;
//$grundspel = Array('A','B','C','D','E','F','G','H');

// European Championship
$grundspel_max = 36;
$grundspel = Array('A','B','C','D','E','F');

$eights_max = $grundspel_max + 8;
$quarter_max = $eights_max + 4;
$semi_max = $quarter_max + 2;
$bronze = $semi_max + 1;

# Om det spelas match om tredjepris
#$finalId = $bronze + 1;
$finalId = $semi_max + 1;
$slutspel_max = $finalId;

function daysLeft() {
	$now = mktime();
	$cupStart = mktime(0, 0, 0, 6, 11, 2021);
	return floor(($cupStart - $now) / (60 * 60 * 24)) + 1;
}

# Procent for the winner, runner up and third place.
$procent_ett=70;
$procent_tva=20;
$procent_tre=10;

# Hur många personer ska ha oddsat innan vi visar procentuell fördelning på förstasidan
$usersbeforeshowingodds=3;

# Ska föregående VM/EM-tipp-vinnare visas?
$showprevwinner=1;
$tif=0;
$acconeer=1;

$useforum=1;
?>
