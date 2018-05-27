<?php 

// SLASS OVERRIDE
if (isset($_SESSION['user']) && $_SESSION['user'] == 'slass') {
     echo '<center><span style="background-color: yellow; color: magenta; font-size: 60pt; font-weight: bold;">YOU SUCK!!!<br/></span></center>';
}


$nbrPayedUsers = mysqli_fetch_assoc(mysqli_query($opendb, "SELECT COUNT(*) as total FROM users WHERE betalt = '1';"))['total'];
$nbrUsers = mysqli_fetch_assoc(mysqli_query($opendb, "SELECT COUNT(*) as total FROM users;"))['total'];
$totalPrice = $nbrPayedUsers * $price;
if(!$cupStarted) { 	
?>

<div class="container">
	<p>
		<span class="header">Det &aumlr nu <span class="megaHeader"><?= daysLeft() ?></span> dagar kvar tills VM 2018 b&oumlrjar!<br/></span>
		Sista datum f&oumlr tippning &aumlr <?= $last_bet_day ?>, sedan st&aumlnger vi slussen - inga konstigheter! :)<br/> 
	</p>
</div>

<?php } ?>
<center>
<p>
	<span class="header2">
		F&oumlr tillf&aumlllet &aumlr det <b><?= $totalPrice ?> SEK</b> i potten.<br/>
	</span>
</p>
</center>
<?php if (isset($_SESSION['betalt']) && $_SESSION['betalt'] != 1 && date('Y-m-d') <= $last_pay_day) { ?>
<div class="container">
   <p>
     <span style="color: red;">
        <b>Varning!<br/></b>
        Du har &aumlnnu inte betalat. Detta &aringret g&oumlr vi ett undantag, vilket inneb&aumlr att du f&aringr tippa fram tills <?= $last_bet_day ?> &aumlven om du inte betalt. Dock m&aringste betalning vara gjord innan <?= $last_pay_day ?>, annars kommer ditt konto att tas bort.<br/>
Se "<a href='index.php?sida=regler'>Regler</a>" f&oumlr mer information.
     </span>
   </p>
</div>
<?php 
}

// ------------------ N&AumlSTA MATCH -------------------------
$date = date('Y-m-d');
$time = date('H:i');
$nextGames = mysqli_query($opendb, "SELECT * FROM matcher WHERE datum >= '".$date."' ORDER BY datum ASC, tid ASC;") or die(mysqli_error($opendb));
$game = mysqli_fetch_array($nextGames, MYSQLI_ASSOC);
while($game['tid'] < $time && $game['datum'] == $date) {
	$game = mysqli_fetch_array($nextGames, MYSQLI_ASSOC);
}
$hemma = mysqli_fetch_array(mysqli_query($opendb,"SELECT * FROM lag WHERE lag = '".$game['hemma']."';"), MYSQLI_ASSOC);
$borta = mysqli_fetch_array(mysqli_query($opendb, "SELECT * FROM lag WHERE lag = '".$game['borta']."';"), MYSQLI_ASSOC);
$ods['1'] = 0;
$ods['X'] = 0;
$ods['2'] = 0;
$odsRes = mysqli_query($opendb, "SELECT m".$game['ID']." FROM tippning WHERE m".$game['ID']." != '' AND id != -1;") or die(mysqli_error($opendb));
$nbrUsrs = mysqli_num_rows($odsRes);
while($tmp = mysqli_fetch_array($odsRes, MYSQLI_ASSOC)) {
	switch($tmp['m'.$game['ID']]) {
		case '1': $ods['1']++; break;
		case 'X': $ods['X']++; break;
		case '2': $ods['2']++; break;
	}
}

$arena = mysqli_fetch_array(mysqli_query($opendb, "SELECT arena.* FROM arena,matcher WHERE matcher.plats = arena.id && matcher.plats = '".$game['plats']."';"), MYSQLI_ASSOC);
// Need some users to get some nice odds...
if ($nbrUsrs >= $usersbeforeshowingodds) {
?>
<div class="container">
	<span class="header2">N&AumlSTA MATCH<br/></span>
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
				<td align="center"><?=round(100*$ods['1']/($nbrUsrs),2)?>%</td>
				<td align="center"><?=round(100*$ods['X']/($nbrUsrs),2)?>%</td>
				<td align="center"><?=round(100*$ods['2']/($nbrUsrs),2)?>%</td>
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
<?php
}
?>
<div class="container">
	<span class="header2">Tidigare &aringrs vinnare av Tippningen EM & VM<br/></span>
	<center>
		<table>
			<tr class="header">
				<td>Cup</td>
				<td>Vinnare</td>
			</tr>
			<tr>
				<td>VM 2010</td>
				<td>Martin Sundstr&oumlm</td>
			</tr>
			<tr>
				<td>EM 2012</td>
				<td>Martin Sundstr&oumlm</td>
			</tr>
			<tr>
				<td>VM 2014</td>
				<td>Johan Thufvesson</td>
			</tr>

		</table>
	</center>
</div>
