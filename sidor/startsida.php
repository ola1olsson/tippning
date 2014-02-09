<?php 
// SLASS OVERRIDE
if ($_SESSION['user'] == 'slass') {
     echo '<center><span style="background-color: yellow; color: magenta; font-size: 60pt; font-weight: bold;">YOU SUCK!!!<br/></span></center>';
}




$nbrPayedUsers = mysql_result(mysql_query("SELECT COUNT(*) FROM users WHERE betalt = '1';"), 0);
$nbrUsers = mysql_result(mysql_query("SELECT COUNT(*) FROM users;"), 0);
$totalPrice = $nbrPayedUsers * $price;
if(!$cupStarted) { 	
?>

<div class="container">
	<p>
		<span class="header">Det är nu <span class="megaHeader"><?= daysLeft() ?></span> dagar kvar tills VM 2014 börjar!<br/></span>
		Sista datum för tippning är <?= $last_bet_day ?>, sedan stänger vi slussen - inga konstigheter! :)<br/> 
	</p>
</div>

<?php } ?>
<center>
<p>
	<span class="header2">
		För tillfället är det <b><?= $totalPrice ?> SEK</b> i potten.<br/>
		Vem kammar hem vinsten i år?!<br/>
	</span>
</p>
</center>
<? if ($_SESSION['betalt'] != 1 && date('Y-m-d') <= $last_pay_day) { ?>
<div class="container">
   <p>
     <span style="color: red;">
        <b>Varning!<br/></b>
        Du har ännu inte betalat. Detta året gör vi ett undantag, vilket innebär att du får tippa fram tills <?= $last_bet_day ?> även om du inte betalt. Dock måste betalning vara gjord innan <?= $last_pay_day ?>, annars kommer ditt konto att tas bort.<br/>
Se "<a href='index.php?sida=regler'>Regler</a>" för mer information.
     </span>
   </p>
</div>
<?php 
}

// ------------------ NÄSTA MATCH -------------------------
$date = date('Y-m-d');
$time = date('H:i');
$nextGames = mysql_query("SELECT * FROM matcher WHERE datum >= '".$date."' ORDER BY datum ASC, tid ASC;") or die(mysql_error());
$game = mysql_fetch_array($nextGames, MYSQL_ASSOC);
while($game['tid'] < $time && $game['datum'] == $date) {
	$game = mysql_fetch_array($nextGames, MYSQL_ASSOC);
}
$hemma = mysql_fetch_array(mysql_query("SELECT * FROM lag WHERE lag = '".$game['hemma']."';"), MYSQL_ASSOC);
$borta = mysql_fetch_array(mysql_query("SELECT * FROM lag WHERE lag = '".$game['borta']."';"), MYSQL_ASSOC);
$ods['1'] = 0;
$ods['X'] = 0;
$ods['2'] = 0;
$odsRes = mysql_query("SELECT m".$game['ID']." FROM tippning WHERE m".$game['ID']." != '' AND id != -1;") or die(mysql_error());
$nbrUsrs = mysql_num_rows($odsRes);
while($tmp = mysql_fetch_array($odsRes, MYSQL_ASSOC)) {
	switch($tmp['m'.$game['ID']]) {
		case '1': $ods['1']++; break;
		case 'X': $ods['X']++; break;
		case '2': $ods['2']++; break;
	}
}

$arena = mysql_fetch_array(mysql_query("SELECT arena.* FROM arena,matcher WHERE matcher.plats = arena.id && matcher.plats = '".$game['plats']."';"), MYSQL_ASSOC);
?>
<div class="container">
	<span class="header2">NÄSTA MATCH<br/></span>
	<center>
		<table border="0" cellspacing="0" cellpadding="2" width="250">
			<tr>
				<td></td>
				<td valign="center" align="right">
					<?=$hemma['countryName_sv'] ?>&nbsp;<img src="./pic/flaggor/<?=$hemma['flagImage'] ?>" align="absmiddle">
				</td>
				<td valign="center" align="center">
					 - 
				</td>
				<td valign="center" align="left">
					<img src="./pic/flaggor/<?=$borta['flagImage'] ?>" align="absmiddle">&nbsp;<?=$borta['countryName_sv'] ?>
				</td>
			</tr>
			<tr>
				<td></td>
				<td align="center" style="width:50%;"><b>1<br></b></td>
				<td align="center"><b>X<br></b></td>
				<td align="center" style="width:50%;"><b>2<br></b></td>
			</tr>
			<tr>
				<td align="right"><b>Odds:<br></b></td>
				<td align="center"><?=round(($ods['1']/$nbrUsrs*100),2)?>%</td>
				<td align="center"><?=round(($ods['X']/$nbrUsrs*100),2)?>%</td>
				<td align="center"><?=round(($ods['2']/$nbrUsrs*100),2)?>%</td>
			</tr>
		</table>
		<table border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td>Datum:</td>
				<td><?=$game['datum']?></td>
			</tr>
			<tr>
				<td>Tid:</td>
				<td><?=$game['tid']?></td>
			</tr>
			<tr>
				<td>Plats:</td>
				<td><?=$arena['arena'];?>, <?=$arena['location'];?></td>
			</tr>
			<tr>
				<td>Matchnr:</td>
				<td><?=$game['ID']?></td>
			</tr>	
		</table>
	</center>
</div>

<div class="container">
	<span class="header2">Tidigare års vinnare av Tippningen EM & VM<br/></span>
	<center>
		<table>
			<tr class="header">
				<td>Cup</td>
				<td>Vinnare</td>
				<td>Vinstsumma</td>
			</tr>
			<tr>
				<td>VM 2010</td>
				<td>Martin Sundstrom</td>
				<td>X:-</td>
			</tr>
			<tr>
				<td>EM 2012</td>
				<td>Martin Sundstrom</td>
				<td>X:-</td>
			</tr>
		</table>
	</center>
</div>
